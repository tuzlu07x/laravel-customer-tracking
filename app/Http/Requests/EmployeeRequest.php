<?php

namespace App\Http\Requests;

class EmployeeRequest extends BaseRequest
{
    public function storeRules()
    {
        //
    }

    public function updateRules()
    {
        //
    }

    public function commonRules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'social_security_number' => 'required|string',
            'citizen_number' => 'required|string',
        ];
    }
}
