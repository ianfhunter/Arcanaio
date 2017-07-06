<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItem extends FormRequest {
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
			'name' => [
				'required',
				'string',
				'max:140',
				Rule::unique('items')->whereNull('deleted_at')->ignore($this->item, 'id'),
			],
			'type' => 'required|string|in:' . implode(',', array_keys(\App\Classes\ItemHelper::getTypes())),
			'weapon_type' => 'nullable|string|in:' . implode(',', array_keys(\App\Classes\ItemHelper::getWeaponTypes())),
			'armor_type' => 'nullable|string|in:' . implode(',', array_keys(\App\Classes\ItemHelper::getArmorTypes())),
			'description' => 'required|string',
			'cost' => 'nullable|string',
			'weight' => 'nullable|string',
			'ac' => 'nullable|string',
			'armor_str_req' => 'nullable|numeric',
			'armor_stealth' => 'nullable|in:Disadvantage',
			'weapon_damage' => 'nullable|string',
			'weapon_range' => 'nullable|string',
			'weapon_properties' => 'nullable|string',
			'vehicle_speed' => 'nullable|string',
			'vehicle_capacity' => 'nullable|string',
			'rarity' => 'nullable|string|in:' . implode(',', array_keys(\App\Classes\ItemHelper::getRarity())),
			'attunement' => 'nullable|string|in:yes',
			'private' => 'numeric|max:1',
		];
	}
}
