<?php


namespace App\Repository\Api;

 use App\Models\UserApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthRepositoryInterface
{
   
    public function login($request){
       
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        //  if (auth()->attempt($validator->validated())) {
        //     return response()->json($validator->errors(), 422);
        // }
        //dd($validator->validated() );
        
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
      //dd($token);
    //   $user =UserApi::first();
    //     Auth::login( $user);
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
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = UserApi::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password),'guard'=>'api']
                ));
        // Auth::login( $user);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
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