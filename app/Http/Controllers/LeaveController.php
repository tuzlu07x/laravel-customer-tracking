<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequest;
use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\LeaveResource;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        $leaves = $employee->leaves()->paginate();

        return LeaveResource::collection($leaves);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $leave = $employee->leaves()->create($data);

        return LeaveResource::make($leave);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(LeaveRequest $request, Employee $employee, Leave $leave)
    {
        $data = $request->validated();
        $leave->update($data);

        return LeaveResource::make($leave);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Leave $leave)
    {
        $leave->delete();

        return response()->json(null, 204);
    }
}
