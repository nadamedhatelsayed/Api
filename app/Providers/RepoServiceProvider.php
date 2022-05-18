<?php

namespace App\Providers;

 use App\Repository\Api\AuthRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\Api\CartRepository;
use App\Repository\Api\OrderRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Api\ProductsRepository;
use App\Repository\Admin\ProductRepositoryInterface;
use App\Repository\Api\AuthRepositoryInterface;
use App\Repository\Api\CartRepositoryInterface;
use App\Repository\Api\OrderRepositoryInterface;
use App\Repository\Api\ProductsRepositoryInterface;

class RepoServiceProvider extends ServiceProvider
{

    public function register()
    {
        
         $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
         $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
         $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
         $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
         $this->app->bind(ProductsRepositoryInterface::class, ProductsRepository::class);

    }


    public function boot()
    {
        //
    }
}