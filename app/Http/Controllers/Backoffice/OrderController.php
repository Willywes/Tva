<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $route = 'backoffice.pedidos.';
    protected $view_folder = 'backoffice.orders.';

    public function __construct()
    {

        // para la plantilla
        view()->share('view_title', 'Pedidos');
        view()->share('view_index', 'Todos los pedidos');
        view()->share('view_create', 'Crear Pedido');
        view()->share('view_edit', 'Modificar Pedido');
        view()->share('view_show', 'Detalle del Pedido');
        view()->share('btn_new', 'Crear Nuevo Pedido');
        view()->share('btn_save', 'Guardar Pedido');
        view()->share('btn_update', 'Actualizar Pedido');
        view()->share('route', $this->route);
        view()->share('actions', true);
        view()->share('active', false);
        view()->share('visible', true);
        view()->share('editable', false);
        view()->share('removable', false);

        view()->share('order', 'Ordenar');
    }

    public function index()
    {
        $orders = Order::with(['customer','items.product'])->orderBy('id', 'desc')->get();
        return view($this->view_folder . 'index', compact('orders'));

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
            $object = Order::find($request->order_id);

            if ($object) {

                $object->status = $object->status == 1 ? 0 : 1;
                $object->save();

                session()->flash('success', 'Estado del pedido actualizado.');
                return redirect()->route($this->route .'index');

            } else {
                session()->flash('warning', 'Pedido no encontrado');
                return redirect()->route($this->route . 'index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cambiar el estado del pedido.');
            return redirect()->route($this->route . 'index');
        }
    }
}
