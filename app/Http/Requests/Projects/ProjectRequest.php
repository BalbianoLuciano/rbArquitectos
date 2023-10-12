<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'direction' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,author_id',
            'roles' => 'array|min:1',
            'roles.*' => 'required|string',
            'companies' => 'nullable|array',
            'companies.*' => 'exists:companies,company_id',
            'company_descriptions.*' => 'nullable|string|max:255',
            'company_roles.*' => 'required|in:builder,construction manager,designer',
            'project_updates.*' => 'nullable|string|max:255',
            'company_starts.*' => 'nullable|date',
            'company_ends.*' => 'nullable|date|after_or_equal:company_starts.*',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'authors.required' => 'At least one author must be assigned to the project.',
            'authors.*.exists' => 'One or more of the provided authors do not exist.',
            'companies.*.exists' => 'One or more of the provided companies do not exist.',
            'end.after_or_equal' => 'The end date must be after or equal to the start date.',
        ];
    }
}
