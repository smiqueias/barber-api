<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function index() : JsonResponse
    {
        $schedule = $this->schedule->with(['employee','service'])->paginate(10);
        return response()->json([
            $schedule,
        ]);
    }
    public function store(Request $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $company = $this->schedule->create($data);
            return response()->json([
                'message' => 'Successfully Registered Schedule',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],401);
        }
    }
    public function show(int $id) : JsonResponse
    {
        try {
            $schedule = $this->schedule->findOrFail($id);
            return response()->json([
                'data' => $schedule,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }

    public function update(Request $request, int $id) : JsonResponse
    {
        try {
            $schedule = $this->schedule->findOrFail($id);
            $data = $request->all();
            $schedule->update($data);
            return response()->json([
                'data' => 'Successfully Updated Schedule',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],401);
        }
    }
    public function destroy(int $id) : JsonResponse
    {
        try {
            $schedule = $this->schedule->findOrFail($id);
            $schedule->delete();
            return response()->json([
                'data' => 'Successfully Deleted Schedule',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }
}
