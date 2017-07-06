<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMonster extends FormRequest {
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
				Rule::unique('monsters')->whereNull('deleted_at')->ignore($this->monster, 'id'),
			],
			'CR' => 'required|numeric',
			'type' => 'required|array|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getTypes())),
			'size' => 'required|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getSizes())),
			'languages' => 'array|nullable|in:null,' . implode(',', array_keys(\App\Classes\GeneralHelper::getLanguages())),
			'description' => 'required|string',
			'alignment' => 'string|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getAlignments())),
			'environment' => 'string|in:' . implode(',', array_keys(\App\Classes\LocationHelper::getEnvironments())),
			'AC' => 'required|numeric',
			'hit_dice_amount' => 'required|numeric',
			'hit_dice_size' => 'required|alpha_num',
			'strength' => 'required|digits_between:0,30',
			'dexterity' => 'required|digits_between:0,30',
			'constitution' => 'required|digits_between:0,30',
			'intelligence' => 'required|digits_between:0,30',
			'wisdom' => 'required|digits_between:0,30',
			'charisma' => 'required|digits_between:0,30',
			'proficiency' => 'required|numeric',
			'base_movement' => 'numeric',
			'fly_movement' => 'numeric',
			'swim_movement' => 'numeric',
			'burrow_movement' => 'numeric',
			'climb_movement' => 'numeric',
			'sense_blindsight' => 'numeric',
			'sense_darkvision' => 'numeric',
			'sense_truesight' => 'numeric',
			'sense_tremorsense' => 'numeric',
			'saving_throws' => 'array|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getSavingThrows())),
			'spell_ability' => 'string|required_with:spells_one,spells_two,spells_three,spells_at_will|in:none,' . implode(',', array_keys(\App\Classes\SpellHelper::getSpellAbilities())),
			'spells_one' => 'array',
			'spells_two' => 'array',
			'spells_three' => 'array',
			'spells_at_will' => 'array',
			'skills' => 'array|in:' . implode(',', array_keys(\App\Classes\CreatureHelper::getSkills())),
			'damage_vulnerabilities.*' => 'alpha_dash|max:140|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getDamageTypes())),
			'damage_immunities.*' => 'alpha_dash|max:140|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getDamageTypes())),
			'damage_resistances.*' => 'alpha_dash|max:140|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getDamageTypes())),
			'condition_immunities.*' => 'alpha|max:140|in:' . implode(',', array_keys(\App\Classes\GeneralHelper::getConditions())),
			'ability.*.name' => 'string|max:200',
			'ability.*.description' => 'string|max:1000',
			'action.*.name' => 'string|max:140',
			'action.*.legendary' => 'numeric|max:1',
			'action.*.description' => 'string|max:1000',
			'action.*.damage_type' => 'alpha_dash|max:140|in:none,' . implode(',', array_keys(\App\Classes\GeneralHelper::getDamageTypes())),
			'action.*.type' => 'string|max:6|in:none,melee,ranged',
			'action.*.damage_dice' => 'string|max:10',
			'action.*.range' => 'string|max:140',
			'private' => 'numeric|max:1',
		];
	}
}
