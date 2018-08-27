<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Issue;
use App\Track;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create($id)
    {
        $issues = Issue::with('project.client', 'project', 'tracks')->where('id', $id)->first();
        
		if(is_null($issues)) {
            abort(404);
        }

		$data = [
            'email'		=> $issues->project->client->email,
            'name'		=> $issues->project->client->name,
            'address'	=> $issues->project->client->address,
            'city'		=> $issues->project->client->city,
            'country'	=> $issues->project->client->country,
            'telephone'	=> $issues->project->client->phone,
			'issue_id'	=> $issues->id,
			'title'		=> $issues->project->title
		];

        $order = Order::create($data);

		foreach($issues->getDescendants() as $descendant) {
			
			$used_time = 0;
			foreach($descendant->tracks as $track)
			{
				$used_time = $used_time + $track['used_time'];	
			}

            OrderItem::create([
                'order_id'		=> $order->id,
                'title'			=> $descendant->title,
                'qty'			=> $used_time,
                'unit_price'	=> 1,
            ]);
		}

		$mollie_data = [
			'amount' => [
				'currency' => 'EUR',
				'value' => (string) $order->total(), // You must send the correct number of decimals, thus we enforce the use of strings
		    ],
            'description' => $order->title,
            'redirectUrl' => route('issue.order.return-from-payment', [$order->id]),
    	];
		
		$payment = \Mollie::api()->payments()->create($mollie_data);
		$attributes['payment_id'] = $payment->id;
        $order->update($attributes);

        return redirect()->to($payment->getCheckoutUrl());
    }

    public function returnFromPayment(Request $request, $id)
    {
        $order = Order::find($id);
        $payment = \Mollie::api()->payments()->get($order->payment_id);

        return view('pages.payment-status', ['payment' => $payment]);
    }
}