<?php


namespace App\Repository\Api;

 
interface ProductsRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function rating($request);
}