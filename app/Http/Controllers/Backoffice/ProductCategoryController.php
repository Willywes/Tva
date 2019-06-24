<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{

    protected $route = 'backoffice.catalogo.categorias.';
    protected $view_folder = 'backoffice.product-categories.';

    public function __construct()
    {

        // para la plantilla
        view()->share('view_title', 'Categorías de Producto');
        view()->share('view_index', 'Todas las categorías');
        view()->share('view_create', 'Crear Categoría');
        view()->share('view_edit', 'Modificar Categoría');
        view()->share('view_show', 'Detalle de la Categoría');
        view()->share('btn_new', 'Crear Nueva Categoría');
        view()->share('btn_save', 'Guardar Categoría');
        view()->share('btn_update', 'Actualizar Categoría');
        view()->share('route', $this->route);
        view()->share('actions', true);
        view()->share('active', true);
        view()->share('visible', false);
        view()->share('editable', true);
        view()->share('removable', true);

        view()->share('order', 'Ordenar');
    }

    public function index()
    {
        $product_categories = ProductCategory::shop()->positions()->withCount('products')->get();
        return view($this->view_folder . 'index', compact('product_categories'));
    }


    public function create()
    {
        $product_categories = ProductCategory::positions()->withCount('products')->get();
        return view($this->view_folder . 'create', compact('product_categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product_category = ProductCategory::create($request->all());
            if ($product_category) {
                session()->flash('success', 'Categoría de producto creada correctamente.');
                return redirect()->route($this->route . 'index');
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al crear la categoría de producto.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $product_category = ProductCategory::find(decrypt($id));
        if(!$product_category){
            session()->flash('warning', 'Categoría de producto no encontrado.');
            return back();
        }
        $product_categories = ProductCategory::positions()->withCount('products')->get();
        return view($this->view_folder . 'edit', compact('product_categories', 'product_category'));
    }

    public function update(Request $request, $id)
    {

        $product_category = ProductCategory::find(decrypt($id));

        if(!$product_category){
            session()->flash('warning', 'Categoría de producto no encontrado.');
            return back();
        }

        if(!$product_category->editable){
            session()->flash('warning', 'Categoría de producto no se puede editar.');
            return redirect()->route($this->route . 'index');
        }

        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product_category->update($request->all());
            if ($product_category) {
                session()->flash('success', 'Categoría de producto actulizada correctamente.');
                return redirect()->route($this->route . 'index');
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al crear la categoría de producto.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $product_category = ProductCategory::find(decrypt($id));

        if(!$product_category){
            session()->flash('warning', 'Categoría de producto no encontrado.');
            return back();
        }

        if(!$product_category->removable){
            session()->flash('warning', 'Categoría de producto no se puede eliminar.');
            return redirect()->route($this->route . 'index');
        }

        try{
            if($product_category->delete()){
                session()->flash('success', 'Categoría de producto eliminada correctamente.');
                return redirect()->route($this->route . 'index');
            }
        }catch(\Exception $exception){
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al intentar eliminar a categoría del producto.']);
        }
    }

    public function changeStatus(Request $request)
    {

        try {
            $object = ProductCategory::find(decrypt($request->id));
            if ($object) {

                $object->active = $request->active == 'true' ? 1 : 0;
                $object->save();

                return response()->json([
                    'status' => 'success',
                    'message' => $object->active == 1 ? 'categoría activada correctamente.' : 'categoría desactivada correctamente.',
                    'object' => $object
                ]);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'categoría no encontrada'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ha ocurrido un error inesperado, inténtelo denuevo más tarde.' . $e->getMessage()
            ]);
        }

    }
}
