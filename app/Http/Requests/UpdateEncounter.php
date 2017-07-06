<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEncounter extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                    'required',
                    'string',
                    'max:140',
                    Rule::unique('encounters')->whereNull('deleted_at')->ignore($this->encounter, 'id')
                ],
            'type' => 'required|string',
            'level' => 'required|string',
            'environment' => 'required|string',
            'hook' => 'required|string',
            'description' => 'required|string',
            'monster_notes' => 'string',
            'npc_notes' => 'string',
            'loot_notes' => 'string',
            'coins' => 'string',
            'private' => 'numeric|max:1'
        ];
    }
}
