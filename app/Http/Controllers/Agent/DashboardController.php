<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use DB;

use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\OrderMeta;

use App\Models\Agent;

use App\Models\Notification;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon; // Import the Carbon library to work with dates


class DashboardController extends Controller
{
   public function index()
   {
       
        $agent_id =  Session::get('AGENT_ID');
        
        $notification = Notification::where('agent_id',$agent_id)->orderByDesc('id')->get();
                
       // $orders = Order::where('agent_code', '=', $agent_id)->paginate(10);
       
        // Order count start for Total Orders box
        $TotalOrders = Order::where('agent_code', '=', $agent_id)
                   ->orderBy('created_at', 'desc')
                   ->get();
        // Order count end for Total Orders box
        
        // Fetch the top 10 latest orders for the agent with the provided ID
        $orders = Order::where('agent_code', '=', $agent_id)
               ->orderBy('created_at', 'desc')
               ->take(10)
               ->get();

        $orderIds = $orders->pluck('id');
        
        $orderMeta = OrderMeta::whereIn('order_id', $orderIds)->get();
        
        // Fetch agent data
        $agent = Agent::where('id', '=', $agent_id)->first();
        
        // Get Earning This Month & Orders This Month for dashboard 4 boxes 
        // Get the current month's first day and last day
            $currentMonthFirstDay = Carbon::now()->startOfMonth();
            $currentMonthLastDay = Carbon::now()->endOfMonth();
            
            // Fetch the orders for the current month using date range
            $topOrdersThisMonth = Order::where('agent_code', '=', $agent_id)
                           ->whereBetween('created_at', [$currentMonthFirstDay, $currentMonthLastDay])
                           ->get();
            
            // Total order count for the current month
            $totalOrdersThisMonth = $topOrdersThisMonth->count();
            
            $topOrderIds = $topOrdersThisMonth->pluck('id');

            $topOrderMeta = OrderMeta::whereIn('order_id', $topOrderIds)->get();
            
            // Fetch agent data for the current agent
            $currentAgent = Agent::where('id', '=', $agent_id)->first();
            
            // Calculate the total earning for the current month
            $earningThisMonth = 0;
            
            foreach ($topOrdersThisMonth as $order) {
                $relatedOrderMeta = $topOrderMeta->where('order_id', $order->id);
            
                foreach ($relatedOrderMeta as $orderMetaItem) {
                    $totalAmount = $order->total_amount; // Replace with your actual total amount
                    $percentage = $order->agent_commission; // Replace with the percentage you want to calculate
            
                    $calculatedPercentage = ($percentage / 100) * $totalAmount;
                    $earningThisMonth += $calculatedPercentage;
                }
            }
        /////////
        

        return view('agent-new.dashboard' ,['notification'=>$notification , 'TotalOrders' =>$TotalOrders , 'orders'=> $orders , 'order_meta' => $orderMeta, 'agent' => $agent ,'totalOrdersThisMonth' =>$totalOrdersThisMonth , 'earningThisMonth' => $earningThisMonth,]);

        //return view('agent.dashboard');
   }
}
