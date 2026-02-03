<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getUserCourses(Request $request): JsonResponse
    {
        $orders = $request->user()->orders;

        return response()->json([
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function cancel(Order $order): JsonResponse
    {
        if ($order->status === StatusEnum::SUCCESS) {
            return response()->json([
                'status' => 'was payed',
            ], 418);
        }

        $order->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
