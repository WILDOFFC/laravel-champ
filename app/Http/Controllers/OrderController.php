<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function list(): View
    {
        $orders = Order::all();

        return view('orders.list', ['orders'=>$orders]);
    }
}
