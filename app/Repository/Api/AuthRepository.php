<?php


namespace App\Repository\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\UserApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthRepositoryInterface
{
    use ApiResponseTrait;
    public function login($request){
       
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
      
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null, $validator->errors()->toJson(), 404);

         }
        $user = UserApi::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password),'guard'=>'api']
                ));
       
        return $this->apiResponse($user, 'User successfully registered', 200);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
       
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    
  
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        Auth::login(auth()->user());

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
        // dd(auth()->user());
    }
}