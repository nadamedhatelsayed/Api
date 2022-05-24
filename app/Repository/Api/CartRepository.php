<?php


namespace App\Repository\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class  CartRepository implements CartRepositoryInterface
{
    use ApiResponseTrait;
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

                    return $this->apiResponse(null, 'product not found', 404);
                }
            }
            return $this->apiResponse(null, 'Add to cart sussessfully', 200);
        } else {
            return $this->apiResponse(null, 'you must login first', 500);
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
                return $this->apiResponse(null, 'product not found', 404);
            }
        } else {
            return $this->apiResponse(null, 'you must login first', 500);
        }
    }
}
