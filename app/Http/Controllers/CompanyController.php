<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function index() : JsonResponse
    {
        $company = Company::paginate(10);

        return response()->json([
            'data' => $company,
        ]);
    }

    public function store(CompanyRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $company = $this->company->create($data);
            return response()->json([
                'message' => 'Successfully Registered Company',
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
            $company = $this->company->findOrFail($id);
            return response()->json([
                'data' => $company,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ],401);
        }

    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $company = $this->company->findOrFail($id);
            $company->update($request->all());
            return response()->json([
                'data' => 'Successfully Updated Company',
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
            $company = $this->company->findOrFail($id);
            $company->delete();
            return response()->json([
                'data' => 'Successfully Deleted Company',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],401);
        }
    }
}
