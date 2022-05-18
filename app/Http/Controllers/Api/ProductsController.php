<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Repository\Api\ProductsRepositoryInterface;
 
class ProductsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(ProductsRepositoryInterface $product)
    {
         $this->product = $product;
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        return $this->product->index();
    }
    public function store(StoreProduct $request)
    {
        return $this->product->store($request);
    }

    public function update(Request $request,$id)
    {
          return $this->product->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         return $this->product->destroy($id);
    }

    public function rating(Request $request){
        return $this->product->rating($request);
    }
}
