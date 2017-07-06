<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayer extends FormRequest {
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
			'name' => 'required|string|max:140',
			'race' => 'string',
			'alignment' => 'string|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getAlignments())),
			'languages' => 'array|nullable|in:null,' . implode(',', array_keys(\App\Classes\GeneralHelper::getLanguages())),
			'description' => 'string|max:15000',
			'class' => 'required|array',
			'feats' => 'string|max:15000',
			'proficiencies' => 'string|max:15000',
			'AC' => 'numeric',
			'HP_max' => 'numeric',
			'HP_current' => 'numeric',
			'hit_dice' => 'string',
			'proficiency' => 'numeric',
			'speed' => 'numeric',
			'darkvision' => 'numeric',
			'PP' => 'numeric',
			'EP' => 'numeric',
			'GP' => 'numeric',
			'SP' => 'numeric',
			'CP' => 'numeric',
			'strength' => 'digits_between:0,30',
			'dexterity' => 'digits_between:0,30',
			'constitution' => 'digits_between:0,30',
			'intelligence' => 'digits_between:0,30',
			'wisdom' => 'digits_between:0,30',
			'charisma' => 'digits_between:0,30',
			'class.*.name' => 'string|max:200',
			'class.*.level' => 'numeric',
			'saving_throws' => 'array|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getSavingThrows())),
			'skills' => 'array|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getSkills())),
			'expertise' => 'array|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getSkills())),
		];
	}
}
