<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\Promotion as PromotionResource;
use App\Http\Resources\Promotions as PromotionCollection;
use Symfony\Component\HttpFoundation\Response;

class PromotionController extends Controller
{
    /**
    * @OA\Get(
    *   path="/api/promotions",
    *   summary="Get list of Promotions",
    *   description="Returns list of Promotions",
    *   operationId="index",
    *   tags={"Promotions"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Successful operation",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthenticated",
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Bad Request"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Not Found"
    *   ),
    * )
    */
    public function index()
    {
        $promotions = Promotion::paginate(20);

        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'result' => new PromotionCollection($promotions),
            'message' => 'All users pulled out successfully'
        ]);
    }

    /**
    * @OA\Get(
    *   path="/api/promotions/{id}",
    *   summary="Get Promotion detail",
    *   tags={"Promotions"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *      response=200,
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
    public function show(Promotion $promotion)
    {
        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'result' => new PromotionResource($promotion),
            'message' => 'Promotion detail pulled out successfully'
        ]);
    }

    /**
    * @OA\Post(
    *   path="/api/promotions",
    *   summary="Promotion Register",
    *   tags={"Promotions"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Parameter(
    *      name="title",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="price",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="address",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="latitude",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="longitude",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *     @OA\Response(
    *         response=201,
    *         description="Successfully created user!",
    *      @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="The given data was invalid."
    *     )
    * )
    */
    public function store(Request $request)
    {
        $promotion = Promotion::create($request->all());

        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'result' => new PromotionResource($promotion),
            'message' => 'Promotion created successfully'
        ]);
    }

    /**
    * @OA\Put(
    *     path="/api/promotions/{id}",
    *     summary="Promotion Update",
    *     tags={"Promotions"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *      name="title",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="price",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="address",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="latitude",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="longitude",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="number",
    *           format="float"
    *      )
    *   ),
    *   @OA\Response(
    *      response=200,
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
    */
    public function update(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());

        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'result' => new PromotionResource($promotion),
            'message' => 'Promotion updated successfully'
        ]);
    }

    /**
    * @OA\Delete(
    *     path="/api/promotions/{id}",
    *     summary="Promotion Delete",
    *     tags={"Promotions"},
    *   security={
    *       {"passport": {}},
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *     @OA\Response(
    *         response=200,
    *         description="Successfully logged out"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized"
    *     )
    * )
    */
    public function delete(Promotion $promotion)
    {
        $promotion->delete();

        return response()->json([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'message' => 'Promotion deleted successfully'
        ]);
    }
}
