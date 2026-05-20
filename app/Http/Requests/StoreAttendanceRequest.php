<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'attendance_date' => [
                'required',
                'date',
                Rule::unique('attendances')->where(fn ($query) => $query
                    ->where('employee_id', $this->input('employee_id'))
                    ->where('attendance_date', $this->input('attendance_date'))),
            ],
            'check_in_time' => ['nullable', 'date_format:H:i'],
            'check_out_time' => ['nullable', 'date_format:H:i', 'after_or_equal:check_in_time'],
            'attendance_status' => ['required', Rule::in(Attendance::STATUSES)],
        ];
    }
}
