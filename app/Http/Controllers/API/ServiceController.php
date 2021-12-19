<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function fetchAll()
    {
        return ResponseFormatter::success(Service::get(), 'Success get data');
    }

    public function status(Request $request)
    {
        if ($request->type === 'progress') {
            $status = Queue::where('queue_status_id', '1')
                ->where('service_id', $request->service_id)
                ->where('user_id', $request->user_id)
                ->count();
        }
        if ($request->type === 'past') {
            $status = Queue::where('queue_status_id', '2')
                ->where('service_id', $request->service_id)
                ->where('user_id', $request->user_id)
                ->count();
        }
        if ($request->type === 'canceled') {
            $status = Queue::where('queue_status_id', '3')
                ->where('service_id', $request->service_id)
                ->where('user_id', $request->user_id)
                ->count();
        }
        return ResponseFormatter::success($status, 'Success get data');
    }
}
