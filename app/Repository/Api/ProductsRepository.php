<?php


namespace App\Repository\Api;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ProductsRepository implements ProductsRepositoryInterface
{

    public function index()
    {

        $data[] = Product::with('details')->get();

        return response()->json([
            'message' => 'All products',
            'products' => $data
        ], 201);
    }

    public function store($request)
    {
        // store product
        try {

            $product = Product::create([
                'price' => $request->price
            ]);
            ProductDetails::create([
                'product_id' => $product->id,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'created product successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e,
            ], 500);
        }
    }


    public function update($request, $id)
    {
        //update product
        try {
            $product = Product::with('details')->where('id', $id)->first();

            $product->update([
                'price' => $request->price
            ]);
            $details = ProductDetails::where('product_id', $id)->first();
            $details->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'Update product successfully',
                'product' => $product
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e,
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            ProductDetails::where('product_id', $product->id)->delete();
            $product->delete();
            return response()->json([
                'message' => 'Delete product successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' =>  $e,
            ], 500);
        }
    }

    public function rating($request)
    {
        if (Auth::check()) {
            $rate = Rating::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
            if ($rate != null) {
                $rate->update([
                    'rating'     => $request->rate,
                ]);
                return response()->json([
                    'message' => 'update product rate successfully',
                ], 200);
            } else {
                Rating::create([
                    'user_id'    => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'rating'     => $request->rate,
                ]);
                return response()->json([
                    'message' => 'create product rate successfully',
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'you must login first',
            ], 500);
        }
    }
}
