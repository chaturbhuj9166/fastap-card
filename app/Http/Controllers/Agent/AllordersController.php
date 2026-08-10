<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Order;
use App\Models\OrderMeta;

use App\Models\Agent;

use Illuminate\Support\Facades\Session;

class AllordersController extends Controller
{
    // public function index()
    // {
    //     $agent_id =  Session::get('AGENT_ID');
        
    //     $orders = Order::where('agent_code', '=', $agent_id)->orderBy('created_at', 'desc')->paginate(10);

    //     $orderIds = $orders->pluck('id');
        
    //     $orderMeta = OrderMeta::whereIn('order_id', $orderIds)->get();
        
    //     // Fetch agent data
    //     $agent = Agent::where('id', '=', $agent_id)->first();

    //     return view('agent.allorders' ,['orders'=> $orders , 'order_meta' => $orderMeta, 'agent' => $agent]);
    // }
    public function index()
{
    $agent_id = Session::get('AGENT_ID');

    // Get agent code (assuming it's stored in the Agent model)
    $agent = Agent::findOrFail($agent_id);
    $agent_code = $agent->agent_code;

    // Fetch order products where this agent_code was used
    $orderProducts = \DB::table('order_products')
        ->join('orders', 'order_products.order_id', '=', 'orders.id')
        ->join('order_metas', 'orders.id', '=', 'order_metas.order_id')
        ->join('products', 'order_products.product_id', '=', 'products.id')
        ->select(
            'orders.id as order_id',
            'orders.payment_status',
            'orders.payment_type',
            'orders.created_at',
            'order_metas.shipping_first_name',
            'order_metas.shipping_last_name',
            'order_metas.shipping_phone',
            'products.pro_name as product_name',
            'order_products.commission',
            'order_products.price',
            'order_products.quantity'
        )
        ->where('order_products.agent_code', $agent_code)
        ->orderBy('orders.created_at', 'desc')
        ->paginate(10);

    return view('agent-new.allorders', [
        'orders' => $orderProducts,
        'agent' => $agent,
    ]);
}


    public function vieworder($id)
    {

        // $order_meta = Order_meta::where('order_no',$id)->first();

        // $order = Order::where('order_number',$id)->first();


        // return view('admin.vieworder' , ['order_meta'=> $order_meta , 'order'=> $order , 'service'=> Service::all() ]);
    }
}
