<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function index() : JsonResponse
    {
        $employee = $this->employee->with('company')->paginate(10);
        return response()->json([
             $employee,
        ]);

    }


    public function store(EmployeeRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $company = $this->employee->create($data);
            return response()->json([
                'message' => 'Successfully Registered Employee',
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
            $company = $this->employee->findOrFail($id);
            return response()->json([
                'data' => $company,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }

    public function update(Request $request,int $id) : JsonResponse
    {
        try {
            $company = $this->employee->findOrFail($id);
            $data = $request->all();
            $company->update($data);
            return response()->json([
                'data' => 'Successfully Updated Employee',
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
            $company = $this->employee->findOrFail($id);
            $company->delete();
            return response()->json([
                'data' => 'Successfully Deleted Employee',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }
    }
}
