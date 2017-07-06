<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpell extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|string|unique:spells,name,NULL,id,deleted_at,NULL|max:255',
			'level' => 'required|string|in:' . implode(',', array_keys(\App\Classes\SpellHelper::getSpellLevels())),
			'school' => 'required|string|in:' . implode(',', array_keys(\App\Classes\SpellHelper::getSpellSchools())),
			'class' => 'required|array|in:' . implode(',', array_keys(\App\Classes\SpellHelper::getSpellClasses())),
			'casting_time' => 'required|string',
			'range' => 'required|string',
			'duration' => 'required|string',
			'components' => 'required|array|in:' . implode(',', array_keys(\App\Classes\SpellHelper::getSpellComponents())),
			'material' => 'string',
			'description' => 'required|string',
			'higher_level' => 'string',
			'concentration' => 'boolean',
			'ritual' => 'boolean',
			'private' => 'numeric|max:1',
		];
	}
}
