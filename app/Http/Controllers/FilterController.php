<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Traits\Search;
use Carbon\Carbon;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $fullName = $request->fullName;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $leave = $request->leave;
        $notLeave = $request->notLeave;

        $query = Employee::query();

        if ($fullName) {
            $query->search($fullName);
        }
        if ($startDate && $endDate) {
            if ($leave) {
                dd($leave);
                $query->where('end_date', null)->whereHas('leaves', function ($query) use ($startDate, $endDate, $leave) {
                    $query->when($leave, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                            ->orWhereBetween('end_date', [$startDate, $endDate]);
                    });
                });
            }
            if ($notLeave) {
                $query->where('end_date', null)->whereDoesntHave('leaves', function ($query) use ($startDate, $endDate, $notLeave) {
                    $query->when($notLeave, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                            ->orWhereBetween('end_date', [$startDate, $endDate]);
                    });
                });
            }
        }

        $employees = $query->get();

        return EmployeeResource::collection($employees);
    }
}
