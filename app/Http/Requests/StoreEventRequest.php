<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $required = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'description' => 'required|string',
            'terms' => 'required|string',
            'banner' => "{$required}|image|mimes:jpeg,png,jpg,webp|max:2048",
            'organiser_photo' => "{$required}|image|mimes:jpeg,png,jpg,webp|max:2048",
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.ticket_type' => 'required|string|max:255',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.stock' => 'required|integer|min:0',
        ];
    }
}
