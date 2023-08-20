<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
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
            return redirect()->route('user.home');
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
            // try {
            //     foreach ($order->products as $product) {
            //         $product->decrement('quantity', $product->pivot->quantity);
            //     }
            // } catch (Throwable $e) {
            // }
            // $cart->empty();
            // $user = User::where('id', $order->user_id)->first();
            // $user->notify(new OrderCreatedNotification($order));
            event(new OrderCreated($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('user.home');
    }
}
