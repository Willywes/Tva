<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
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
        //
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
