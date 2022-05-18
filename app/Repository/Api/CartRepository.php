<?php


namespace App\Repository\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class  CartRepository implements CartRepositoryInterface
{
    public function add($id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', 1)->where('product_id', $id)->first();

            if ($cart != null) {
                $cart->update([
                    'qty' => $cart->qty + 1
                ]);
            } else {
                $product = Product::find($id);
                if ($product != null) {
                    Cart::create([
                        'user_id'    => 1,
                        'product_id' =>  $id,
                        'qty'        =>  1,
                        'price'      => $product->price
                    ]);
                } else {
                    return response()->json([
                        'message' => 'product not found',
                    ], 500);
                }
            }

            return response()->json([
                'message' => 'Add to cart sussessfully',
            ], 201);
        } else {
            return response()->json([
                'message' => 'you must login first',
            ], 500);
        }
    }

    public function get()
    {
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', 1)->where('product_id', $id)->first();
            if ($cart != null) {
                $cart->delete();
                return response()->json([
                    'message' => 'delete sussessfully',
                ], 201);
            } else {
                return response()->json([
                    'message' => 'product not found',
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'you must login first',
            ], 500);
        }
    }
}
