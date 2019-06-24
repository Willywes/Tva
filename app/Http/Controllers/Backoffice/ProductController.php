<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $route = 'backoffice.catalogo.productos.';
    protected $view_folder = 'backoffice.products.';

    public function __construct()
    {

        // para la plantilla
        view()->share('view_title', 'Administración de Productos');
        view()->share('view_index', 'Todos los productos');
        view()->share('view_create', 'Crear Producto');
        view()->share('view_edit', 'Modificar Producto');
        view()->share('view_show', 'Detalle del Producto');
        view()->share('btn_new', 'Crear Nuevo Producto');
        view()->share('btn_save', 'Guardar Producto');
        view()->share('btn_update', 'Actualizar Producto');
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
        $products = Product::with('product_category')->orderBy('product_category_id')->orderBy('name')->get();
        return view($this->view_folder . 'index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find(decrypt($id));
        //return response()->json($product);
        if(!$product){
            session()->flash('warning', 'Categoría de producto no encontrado.');
            return back();
        }
        $product_category = ProductCategory::all();
        //return response()->json($product_category);
        return view($this->view_folder . 'edit', compact('product', 'product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request);
        $product = Product::find(decrypt($id));

        if(!$product){
            session()->flash('warning', 'Producto no encontrado.');
            return back();
        }

        if(!$product->editable){
            session()->flash('warning', 'Producto no se puede editar.');
            return redirect()->route($this->route . 'index');
        }

        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'product_category_id' => 'required',
            'offer_price' => 'nullable|numeric|min:1'
        ];

        $message = [
            'name.required' => 'Nombre del producto es requerido',
            'slug.required' => 'Slug del producto es requerido',
            'price.required' => 'El precio del producto es requerido',
            'price.numeric' => 'El precio del producto debe ser un valor númerico',
            'product_category_id.required' => 'Categoría de producto es requerida',
            'offer_price.numeric' => 'El precio oferta del producto debe ser un valor númerico',
            'offer_price.min' => 'El precio oferta del producto debe ser un mayor a 0'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->passes()) {
            $product->update($request->all());

            if ($product) {
                session()->flash('success', 'Producto actualizado correctamente.');
                return redirect()->route($this->route . 'index');
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al editar producto.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {

        try {
            $object = Product::find(decrypt($request->id));
            if ($object) {

                $object->active = $request->active == 'true' ? 1 : 0;
                $object->save();

                return response()->json([
                    'status' => 'success',
                    'message' => $object->active == 1 ? 'producto activado correctamente.' : 'producto desactivado correctamente.',
                    'object' => $object
                ]);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'producto no encontrado'
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
