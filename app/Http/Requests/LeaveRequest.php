<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends BaseRequest
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
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
