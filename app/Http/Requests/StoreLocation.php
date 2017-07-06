<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest {
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
			'name' => 'required|string|unique:locations,name,NULL,id,deleted_at,NULL|max:255',
			'description' => 'required|string',
			'history' => 'string',
			'demographics' => 'string',
			'government' => 'string',
			'menu' => 'string',
			'other_items' => 'string',
			'type' => 'string|required|in:' . implode(',', array_keys(\App\Classes\LocationHelper::getTypes())),
			'subtype' => 'string|in:' . implode(',', array_keys(\App\Classes\LocationHelper::getShopTypes())),
			'owner' => 'string',
			'price' => 'string',
			'private' => 'numeric|max:1',
			'parent' => 'integer|nullable',
		];
	}
}
