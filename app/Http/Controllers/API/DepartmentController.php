<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\DepartmentRepositoryInterface;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;

class DepartmentController extends Controller
{
    protected $departmentRepo;
    
    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    public function index()
    {
        $departments = $this->departmentRepo->allDepartments();
        return response()->json($departments, 200);
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentRepo->createDepartment($request);
        return response()->json($department, 201);
    }

    public function show($id)
    {
        $department = $this->departmentRepo->showDepartment($id);
        return response()->json($department, 200);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department = $this->departmentRepo->updateDepartment($request, $department);
        return response()->json($department, 200);
    }

    public function destroy(Department $department)
    {
        // $department = $this->departmentRepo->deleteDepartment($department);
        // return response()->json($department, 200);

        $users_in_the_department = User::where('department_id', $department->id)->get();

        if ($users_in_the_department == null) {
            return response()->json($department, 200);
        }
        return response()->json(['error' => 'Stop! Users are attached to this department'], 404);
    }
}
