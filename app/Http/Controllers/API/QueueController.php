<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Http\Request;
use Exception;


class QueueController extends Controller
{
    public function store(Request $request)
    {
        try {
            // validasi input 
            $attr = $request->validate([
                'user_id' => 'required',
                'service_id' => 'required',
                'queue_status_id' => 'required',
                'date' => 'required',
                'when' => 'required',
            ]);

            // checking apakah di jam dan tanggal tersebut sudah ada antrian
            $queue = Queue::where('service_id', $request->service_id)->where('date', $request->date)->where('when', $request->when)->first();

            // jika ada maka tampilkan pesan
            if ($queue) {
                return ResponseFormatter::error([
                    'message' => 'Jam tidak tersedia. Silahkan pilih jam lain.',
                ], 'Gagal mendaftar', 500);
            }

            // check apakah user sudah terdaftar di layanan yang sama pada hari yang sama
            $user_queue = Queue::where('user_id', $request->user_id)
                ->where('service_id', $request->service_id)
                ->where('date', $request->date)
                ->first();

            // jika user sudah terdaftar tampilkan pesan
            if ($user_queue) {
                return ResponseFormatter::error([
                    'message' => 'Pendataran hanya bisa dilakukan sekali dalam sehari.',
                    'data' => $user_queue
                ], 'Gagal mendaftar', 500);
            }

            Queue::create($attr);

            return ResponseFormatter::success($attr, 'Antrian berhasil ditambahkan');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Gagal mendaftar', 500);
        }
    }

    public function all(Request $request)
    {
        $queue = Queue::with(['queue_status', 'service'])
            ->where('user_id', $request->user_id)
            ->where('queue_status_id', $request->queue_status_id)
            ->latest()
            ->get();
        return ResponseFormatter::success($queue, 'Queue data taked');
    }
}
