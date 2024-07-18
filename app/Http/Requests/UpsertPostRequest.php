<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;

class UpsertPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function getBlog():Blog
    {
        return Blog::findOrFail($this->blog);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "blog" => ["required", "integer"],
            "name" => ["required", "string", "unique:posts"],
            "body" => ["required", "string"],
            "image" => ["nullable", "sometimes", "mimes:jpeg,png,jpg"]
        ];
    }
}
