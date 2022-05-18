<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repository\Api\AuthRepositoryInterface;
use App\Repository\Api\OrderRepositoryInterface;

class OrderController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(OrderRepositoryInterface $order)
    {
        $this->order = $order;
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        return $this->order->create();
    }

    public function Redirect(Request $request)
    {
        return $this->order->orderRedirect($request);
    }
    
}
