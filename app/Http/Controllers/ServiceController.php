<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $service = $this->service->with('employee')->paginate(10);
        return response()->json([
            $service,
        ]);
    }

    public function store(ServiceRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $company = $this->service->create($data);
            return response()->json([
                'message' => 'Successfully Registered Service',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }

    public function show(int $id) : JsonResponse
    {
        try {
            $service = $this->service->findOrFail($id);
            return response()->json([
                'data' => $service,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }



    public function update(Request $request, int $id)
    {
        try {
            $service = $this->service->findOrFail($id);
            $data = $request->all();
            $service->update($data);
            return response()->json([
                'data' => 'Successfully Updated Service',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }


    public function destroy(int $id) : JsonResponse
    {
        try {
            $service = $this->service->findOrFail($id);
            $service->delete();
            return response()->json([
                'data' => 'Successfully Deleted Service',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }
}
