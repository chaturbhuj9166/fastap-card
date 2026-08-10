<?php

namespace App\Http\Controllers;

use App\Trackoreder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TrackorderController extends Controller
{
    public function getOrder(Request $request)
    {
        $from = $request->input("From");
        $body = $request->input("Body");
        $order = Trackoreder::where("order_id", $body)->first();
        if (!$order) {
            $response = "Invalid Order Id sent!";
        } else {
            $response = "Heres the current details of your order #{$order->order_id}: \n
            Current location: {$order->current_location} \n
            Previous location: {$order->last_location} \n
            Status: {$order->status} \n
            Arrival date: " . Carbon::tomorrow();
            }
            return $this->sendMessage($response, $from);
    }

   
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipients,
            array('from' => $twilio_number, 'body' => $message));
    }
}
