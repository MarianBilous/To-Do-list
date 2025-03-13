<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|in:to-do,in-progress,done',
            'priority' => 'nullable|in:low,medium,high',
            'deadline_from' => 'nullable|date',
            'deadline_to' => 'nullable|date',
            'sort_by' => 'nullable|in:deadline,priority',
        ];
    }
}
