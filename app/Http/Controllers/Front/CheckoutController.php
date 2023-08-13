<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    //
    public function create(CartRepository $cart)
    {
        $countries = Countries::getNames();
        return view('front.checkout', compact('cart', 'countries'));
    }

    public function store(Request $request, CartRepository $cart)
    {
        // dd($request->addr);
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }
        $request->validate([]);
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'payment_method' => 'cod',
            ]);

            foreach ($cart->get() as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }

            foreach ($request->addr as $type => $address) {
                $address['type'] = $type;
                $order->addresses()->create($address);
            }
            DB::commit();
            foreach ($order->products as $product) {
                $product->decrement('quantity', $product->pivot->quantity);
            }
            $cart->empty();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home');
    }
}
