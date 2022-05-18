<?php


namespace App\Repository\Api;

 
interface OrderRepositoryInterface
{
    public function create();

    public function orderRedirect($request);

 
}