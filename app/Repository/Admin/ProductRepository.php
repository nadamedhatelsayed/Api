<?php


namespace App\Repository\Admin;

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DataTables\ProductsDataTable;
use Yajra\DataTables\Facades\DataTables;

class ProductRepository implements ProductRepositoryInterface
{

    public function index()
    {
         
        $products = Product::get();
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('title', function ($products) {

                $title = ProductDetails::where('product_id', $products->id)->first();
                return $title->title;
            })
            ->addColumn('description', function ($products) {

                $desc = ProductDetails::where('product_id', $products->id)->first();
                return $desc->description;
            })
            ->addColumn('action', function ($products) {
                $pro = ProductDetails::where('product_id', $products->id)->first();
                $btn =  '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       controle
                    </button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item edit-btn" data-toggle="modal" data-target="#exampleModaledit" href="#" data-id="' . $products->id . '" data-price="' . $products->price . '" data-title="' . $pro->title . '" data-description="' . $pro->description . '"> edit </a>
                      <a class="dropdown-item delete-btn" href="#" data-id="' . $products->id . '"  > delete </a>
                    
                  </div>';

                return $btn;
            })
            ->rawColumns([
                'title',
                'description',
                'action',
            ])
            ->make(true);
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
            // log 
            Log::info('Create product successfully');
            return response()->json('SUCCESS');
        } catch (\Exception $e) {
            // log error happend
            Log::error("Failed to add product");
            return response()->json('ERROR');
        }
    }


    public function update($request)
    {
        //update product
        try {
            $product = Product::where('id', $request->id)->first();

            $product->update([
                'price' => $request->price
            ]);
            $details = ProductDetails::where('product_id', $request->id)->first();
            $details->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            Log::info('Update product successfully',['product_id' => $product->id]);

            return response()->json('SUCCESS');
        } catch (\Exception $e) {

            Log::error('failed to update product ',['product_id' => $product->id]);
            return response()->json('ERROR');
        }
    }

    public function destroy($request)
    {
        try {
            $product = Product::where('id', $request->id)->first();
            ProductDetails::where('product_id', $product->id)->delete();
            $product->delete();
            Log::info('Delete product successfully',['product_id' => $product->id]);
            return response()->json('SUCCESS');
        } catch (\Exception $e) {
            Log::error('Failed to delete product',['product_id' => $product->id]);
            return response()->json('ERROR');
        }
    }
}
