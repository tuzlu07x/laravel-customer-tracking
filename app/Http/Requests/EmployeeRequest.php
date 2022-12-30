<?php

namespace App\Http\Requests;

class EmployeeRequest extends BaseRequest
{
    public function storeRules()
    {
        return [
            'social_security_number' => 'required|string|unique:employees,social_security_number',
            'citizen_number' => 'required|string|unique:employees,citizen_number',
        ];
    }

    public function updateRules()
    {
        return [
            'social_security_number' => 'required|string|unique:employees,social_security_number,' . $this->route('employee')->id,
            'citizen_number' => 'required|string|unique:employees,citizen_number,' . $this->route('employee')->id,
        ];
    }

    public function commonRules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'nullable|date|after_or_equal:start_date',

        ];
    }
}
