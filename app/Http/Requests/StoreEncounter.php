<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncounter extends FormRequest
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
            'name' => 'required|unique:encounters|max:255',
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
