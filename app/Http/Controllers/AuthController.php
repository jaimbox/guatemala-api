<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
    * @OA\Post(
    *   path="/api/auth/login",
    *   summary="Login User",
    *   operationId="login",
    *   tags={"Auth"},
    *
    *   @OA\Parameter(
    *       name="email",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *      name="password",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Response(
    *      response=202,
    *       description="Success",
    *      @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Bad Request"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="not found"
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden"
    *   )
    *)
    **/
    /**
    * Login User api
    *
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        } else {
            $success['token'] = auth()->user()->createToken('authToken')->accessToken;
            $success['user'] = auth()->user();
            return response()->json(['success' => $success])->setStatusCode(Response::HTTP_ACCEPTED);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        $success['token'] = auth()->user()->createToken('authToken')->accessToken;
        $success['user'] = auth()->user();

        return response()->json(['success' => $success])->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
    * @OA\Post(
    *   path="/api/auth/signup",
    *   summary="Register User",
    *   tags={"Auth"},
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="email",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *       type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password_confirmation",
    *       in="query",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Success",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Bad Request"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="not found"
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden"
    *   )
    * )
    **/
    /**
    * Register User api
    *
    * @return \Illuminate\Http\Response
    */
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }

    /**
    * @OA\Get(
    *   path="/api/auth/logout",
    *   summary="Logout User",
    *   tags={"Auth"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Successfully logged out"
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthorized"
    *   )
    * )
    **/
    /**
    * Logout User api
    *
    * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out'], 200);
    }

    /**
    * @OA\Get(
    *   path="/api/auth/user",
    *   summary="Show Current User",
    *   tags={"Auth"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Success",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Bad Request"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="not found"
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden"
    *   )
    * )
    **/
    /**
    * Show User api
    *
    * @return \Illuminate\Http\Response
    */
    public function user(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'result' => new UserResource($request->user()),
            'message' => 'User detail pulled out successfully'
        ]);
    }
}
