<?php

namespace App\Http\Controllers;

use App\Jobs\BatchTestJob;
use App\Jobs\TestJob;
use Illuminate\Bus\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

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

    public function dispatchBatchJob(Request $request): JsonResponse
    {
        $jobs = [];
        for ($i = 1; $i <= 3; $i++) {
            $jobs[] = new BatchTestJob();
        }

        $batch = Bus::batch($jobs)
            ->name('Test Batch')
            ->dispatch();

        return response()->json([
            'status' => 'success',
            'message' => 'Batch jobs have been dispatched successfully',
            'batch_id' => $batch->id,
            'total_jobs' => 3,
            'dispatched_at' => now()->toDateTimeString()
        ]);
    }

    public function getBatchStatus(string $batchId): JsonResponse
    {
        $batch = Bus::findBatch($batchId);

        if (!$batch) {
            return response()->json([
                'error' => 'Batch not found'
            ], 404);
        }

        return response()->json($batch);
    }
}