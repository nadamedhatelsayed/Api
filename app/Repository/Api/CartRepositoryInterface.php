<?php


namespace App\Repository\Api;

 
interface CartRepositoryInterface
{
    public function add($id);

    public function get();
    public function destroy($id);
 
}