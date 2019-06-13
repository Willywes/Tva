<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Models\OpenHour;
use App\Models\Order;
use App\Models\Timetable;
use DateTime;
use Illuminate\Support\Facades\Mail;

class HelperFront
{
    public static function responseJson()
    {
        $nums = func_num_args();
        $args = func_get_args();

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Operación realizada con éxito',
            'data' => null
        ];

        switch ($nums) {
            case 1:
                $response['message'] = $args[0];
                break;
            case 2:
                $response['message'] = $args[0];
                $response['data'] = $args[1];
                break;
            case 3:
                $response['code'] = $args[0];
                $response['message'] = $args[1];
                $response['data'] = $args[2];
                if ($args[0] != 200) {
                    $response['status'] = 'error';
                }
                break;
        }

        return response()->json($response);
    }

    public static function responseJsonSuccess($message = null, $data = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'code' => $code,
            'message' => $message ? $message : 'Operación realizada con éxito',
            'data' => $data
        ]);
    }

    public static function responseJsonError($message = null, $data = null, $code = 404)
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message ? $message : 'Error en la operación ejecutada.',
            'data' => $data
        ]);
    }

    public static function refuteAction($title = null, $subtitle = null, $message = null)
    {
        return view('frontend.globals.refuted', compact('title', 'subtitle', 'message'));
    }

    public static function sendMailCustomer($order_id)
    {

        try {

            $order = Order::with(['items', 'customer', 'order_type', 'address'])->find($order_id);

            $to_name = $order->customer->fullname;
            $to_email = $order->customer->email;

            $data = ['order' => $order];

            Mail::send(['html' => 'emails.mail'], $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Resumen de pedido');
                $message->from('pedidohsushi@gmail.com', 'Pedidos TVA');
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public static function sendMailRecoveryCustomer($customer_id, $pass)
    {

        try {

            $customer =  Customer::find($customer_id);

            $to_name = $customer->fullname;
            $to_email = $customer->email;

            $data = ['customer' => $customer, 'pass' => $pass];

            Mail::send(['html' => 'emails.recovery'], $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Nueva Contraseña');
                $message->from('pedidohsushi@gmail.com', 'TVA');
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public static function validateHorary()
    {

        $date = new DateTime();
        $key_date = $date->format('w');
        $current = '2019-05-31 17:01:00';//$date->format('Y-m-d H:i:s');
        $day = $date->format('Y-m-d');

        $timetable = Timetable::with('open_hours')->find($key_date);

        $open_hours = OpenHour::where('timetable_id', $timetable->id)->get();

        foreach ($open_hours as $o) {
            $start = $day . ' ' . $o->start;
            $end = $day . ' ' . $o->end;

            if ($current >= $start and $current <= $end) {
                return $o;
            }
        }
    }
}