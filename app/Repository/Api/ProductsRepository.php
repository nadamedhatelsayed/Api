<?php


namespace App\Repository\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ProductsRepository implements ProductsRepositoryInterface
{
    use ApiResponseTrait;
    public function index()
    {

        $product = ProductResource::collection(Product::with('details')->get());

        return $this->apiResponse($product, 'ok', 200);
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


            return $this->apiResponse(new ProductResource($product), 'The post Save', 201);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'The post Not Save', 400);
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
            return $this->apiResponse(new ProductResource($product), 'Update product successfully', 201);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'The product Not Found', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::where('id', $id)->first();

            ProductDetails::where('product_id', $product->id)->delete();

            if ($product) {
                return $this->apiResponse(null, 'The product deleted', 200);
            } else {
                return $this->apiResponse(null, 'The post Not Found', 404);
            }
            $product->delete();
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'The product Not Found', 404);
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
               
                return $this->apiResponse(null, 'update product rate successfully', 200);

            } else {
                Rating::create([
                    'user_id'    => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'rating'     => $request->rate,
                ]);

                return $this->apiResponse(null, 'create product rate successfully', 200);
            }
        } else {
            return $this->apiResponse(null, 'you must login first', 500);
        }
    }
}
