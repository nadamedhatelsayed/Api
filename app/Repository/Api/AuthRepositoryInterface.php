<?php


namespace App\Repository\Api;

 
interface AuthRepositoryInterface
{
    public function login($request);

    public function register($request);

    public function logout();

 
}