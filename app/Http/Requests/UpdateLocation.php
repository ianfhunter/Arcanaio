<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocation extends FormRequest {
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
				Rule::unique('locations')->whereNull('deleted_at')->ignore($this->location, 'id'),
			],
			'description' => 'required|string',
			'history' => 'string',
			'demographics' => 'string',
			'government' => 'string',
			'menu' => 'string',
			'other_items' => 'string',
			'type' => 'string|in:' . implode(',', array_keys(\App\Classes\LocationHelper::getTypes())),
			'subtype' => 'string|in:' . implode(',', array_keys(\App\Classes\LocationHelper::getShopTypes())),
			'owner' => 'string',
			'price' => 'string',
			'private' => 'numeric|max:1',
			'parent' => 'nullable|integer',
		];
	}
}
