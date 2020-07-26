<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        try {
            return Promotion::all();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function show(Promotion $promotion)
    {
        return $promotion;
    }

    public function store(Request $request)
    {
        $promotion = Promotion::create($request->all());

        return response()->json($promotion, 201);
    }

    public function update(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());

        return response()->json($promotion, 200);
    }

    public function delete(Promotion $promotion)
    {
        $promotion->delete();

        return response()->json(null, 204);
    }
}
