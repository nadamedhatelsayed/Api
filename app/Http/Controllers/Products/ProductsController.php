<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;
use App\Repository\Admin\ProductRepositoryInterface;
 
class ProductsController extends Controller
{
    protected $Product;

    public function __construct(ProductRepositoryInterface $Product)
    {
        $this->Product = $Product;
    }

    public function index()
    {
        //dd(1);
        if (request()->ajax()) {
            return  $this->Product->index();
        }
        return view('admin.products.index');
    }


    public function store(StoreProduct $request)
    {
        return $this->Product->store($request);
    }

    public function update(StoreProduct $request)
    {
         return $this->Product->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         return $this->Product->destroy($request);
    }
}
