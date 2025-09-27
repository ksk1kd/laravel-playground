<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function dispatchTestJob(Request $request): JsonResponse
    {
        TestJob::dispatch();

        return response()->json([
            'status' => 'success',
            'message' => 'TestJob has been dispatched successfully',
            'dispatched_at' => now()->toDateTimeString()
        ]);
    }
}