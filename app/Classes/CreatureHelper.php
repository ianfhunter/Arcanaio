<?php

namespace App\Classes;

class CreatureHelper {

	public static function getSkills() {
		return [
			'acrobatics' => 'Acrobatics',
			'animal_handling' => 'Animal Handling',
			'arcana' => 'Arcana',
			'athletics' => 'Athletics',
			'deception' => 'Deception',
			'history' => 'History',
			'insight' => 'Insight',
			'intimidation' => 'Intimidation',
			'investigation' => 'Investigation',
			'medicine' => 'Medicine',
			'nature' => 'Nature',
			'perception' => 'Perception',
			'performance' => 'Performance',
			'persuasion' => 'Persuasion',
			'religion' => 'Religion',
			'sleight_of_hand' => 'Sleight of Hand',
			'stealth' => 'Stealth',
			'survival' => 'Survival',
		];
	}

	public static function getSkillMods() {
		return [
			'acrobatics' => 'dexterity',
			'animal_handling' => 'wisdom',
			'arcana' => 'intelligence',
			'athletics' => 'strength',
			'deception' => 'charisma',
			'history' => 'intelligence',
			'insight' => 'wisdom',
			'intimidation' => 'charisma',
			'investigation' => 'intelligence',
			'medicine' => 'wisdom',
			'nature' => 'intelligence',
			'perception' => 'wisdom',
			'performance' => 'charisma',
			'persuasion' => 'charisma',
			'religion' => 'intelligence',
			'sleight_of_hand' => 'dexterity',
			'stealth' => 'dexterity',
			'survival' => 'wisdom',
		];
	}

	public static function getCR() {
		return [
			'0.125' => '1/8',
			'0.25' => '1/4',
			'0.5' => '1/2',
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
		];
	}

	public static function getTypes() {
		return [
			'Aberration' => 'Aberration',
			'Beast' => 'Beast',
			'Celestial' => 'Celestial',
			'Construct' => 'Construct',
			'Dragon' => 'Dragon',
			'Elemental' => 'Elemental',
			'Fey' => 'Fey',
			'Fiend' => 'Fiend',
			'Giant' => 'Giant',
			'Humanoid' => 'Humanoid',
			'Monstrosity' => 'Monstrosity',
			'Ooze' => 'Ooze',
			'Plant' => 'Plant',
			'Undead' => 'Undead',
		];
	}

	public static function getSizes() {
		return [
			'Tiny' => 'Tiny (2½ by 2½ ft)',
			'Small' => 'Small (5 by 5 ft)',
			'Medium' => 'Medium (5 by 5 ft)',
			'Large' => 'Large (10 by 10 ft)',
			'Huge' => 'Huge (15 by 15 ft)',
			'Gargantuan' => 'Gargantuan (20 by 20 ft or larger)',
		];
	}

	public static function getAlignments() {
		return [
			'any alignment' => 'Any Alignment',
			'chaotic good' => 'Chaotic Good',
			'chaotic neutral' => 'Chaotic Neutral',
			'chaotic evil' => 'Chaotic Evil',
			'neutral good' => 'Neutral Good',
			'true neutral' => 'True Neutral',
			'neutral evil' => 'Neutral Evil',
			'lawful good' => 'Lawful Good',
			'lawful neutral' => 'Lawful Neutral',
			'lawful evil' => 'Lawful Evil',
			'unaligned' => 'Unaligned',
			'any good alignment' => 'Any Good',
			'any non-good alignment' => 'Any Non-good',
			'any evil alignment' => 'Any Evil',
			'unaligned' => 'Unaligned',
		];
	}

	public static function getMonsterRedditMarkdown($monster) {
		$output = "###[" . $monster->name . "](" . url('monster', $monster->id) . ")&#010;
		**Size** " . $monster->size . "&#010;
		**Type** " . ucfirst($monster->type) . "&#010;
		**Alignment** " . ucfirst($monster->alignment) . "&#010;
		___&#010;
		**Armor Class** " . $monster->AC . "  &#010;&#010;
		**Hit Points** " . $monster->HP . " (" . $monster->hit_dice_amount . "d" . $monster->hit_dice_size . " " . \Common::signNum(\Common::modUnsigned($monster->constitution) * $monster->hit_dice_amount) . ")  &#010;&#010;
		**Speed** ";

		$output .= $monster->speed != 0 ? "Base " . $monster->speed . " ft " : '';
		$output .= $monster->climb_speed != 0 ? "Climb " . $monster->climb_speed . " ft " : '';
		$output .= $monster->fly_speed != 0 ? "Fly " . $monster->fly_speed . " ft " : '';
		$output .= $monster->swim_speed != 0 ? "Swim " . $monster->swim_speed . " ft " : '';
		$output .= $monster->burrow_speed != 0 ? "Burrow " . $monster->burrow_speed . " ft " : '';

		$output .= "&#010;&#010;
		___&#010;
		STR | DEX | CON | INT | WIS | CHA&#013;
		:-:|:-:|:-:|:-:|:-:|:-:&#013;
		" . $monster->strength . " (" . \Common::mod($monster->strength) . ")|" . $monster->dexterity . " (" . \Common::mod($monster->dexterity) . ")|" . $monster->constitution . " (" . \Common::mod($monster->constitution) . ")|" . $monster->intelligence . " (" . \Common::mod($monster->intelligence) . ")|" . $monster->wisdom . " (" . \Common::mod($monster->wisdom) . ")|" . $monster->charisma . " (" . \Common::mod($monster->charisma) . ")&#013;
		___&#010; **Senses** ";

		$output .= $monster->darkvision != 0 ? "Darkvision " . $monster->darkvision . " ft " : '';
		$output .= $monster->truesight != 0 ? "Truesight" . $monster->truesight . " ft " : '';
		$output .= $monster->blindsight != 0 ? "Blindsight " . $monster->blindsight . " ft " : '';
		$output .= $monster->tremorsense != 0 ? "Tremorsense " . $monster->tremorsense . " ft " : '';

		$output .= "&#010;&#010;
		**Saving Throws** ";

		foreach (\GeneralHelper::getSavingThrows() as $key => $value) {
			if ($monster->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $monster->$key) . " ";
			}
		}

		$output .= "&#010;&#010;
		**Skills** ";

		foreach (\CreatureHelper::getSkills() as $key => $value) {
			if ($monster->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $monster->$key) . " ";
			}
		}

		$output .= "&#010;&#010;";

		$output .= !empty($monster->damage_immunities) ? "**Damage Immunities** " . ucfirst($monster->damage_immunities) . "&#010;&#010;" : '';
		$output .= !empty($monster->damage_vulnerabilities) ? "**Damage Vulnerabilities** " . ucfirst($monster->damage_vulnerabilities) . "&#010;&#010;" : '';
		$output .= !empty($monster->damage_resistances) ? "**Damage Resistances** " . ucfirst($monster->damage_resistances) . "&#010;&#010;" : '';
		$output .= !empty($monster->condition_immunities) ? "**Condition Immunities** " . ucfirst($monster->condition_immunities) . "&#010;&#010;" : '';

		$output .= "**Languages** " . $monster->languages . "&#010;&#010;
		**Challenge** " . \Common::decimalToFraction($monster->CR) . "&#010;&#010;";

		$output .= $monster->environment ? "**Environment** " . ucfirst($monster->environment) : '';

		$output .= "&#010; ___ &#010;";

		foreach ($monster->abilities as $ability) {
			$output .= "***" . $ability->name . "*** &#010;&#010;
			" . $ability->description . " &#010;&#010;";
		}

		$output .= "###Actions &#010;
		___ &#010;";

		foreach ($monster->actions as $action) {
			if ($action->legendary == 0) {
				$output .= "***" . $action->name . "***&#010;&#010;
				" . $action->description . "&#010;&#010;";
			}
		}

		if ($monster->actions->contains('legendary', '1')) {
			$output .= "###Legendary Actions&#010;
			___&#010;
			***Legendary Actions***&#010;
			The " . $monster->name . " can take 3 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The " . $monster->name . " regains spent legendary actions at the start of its turn. &#010;&#010;";

			foreach ($monster->actions as $action) {
				if ($action->legendary == 1) {
					$output .= "***" . $action->name . "***&#010;&#010;
					" . $action->description . "&#010;&#010;";
				}
			}
		}

		$output .= "&#010; ___ &#010;";

		$output .= Common::redditDescription($monster->description);

		return str_replace("\t", '', $output);
	}

	public static function getMonsterHomebreweryMarkdown($monster) {
		$output = "___
		> ## [" . $monster->name . "](" . url('monster', $monster->id) . ")
		> *" . $monster->size . " " . ucfirst($monster->type) . " " . ucfirst($monster->alignment) . "*
		> ___
		> - **Armor Class** " . $monster->AC . "
		> - **Hit Points** " . $monster->HP . " (" . $monster->hit_dice_amount . "d" . $monster->hit_dice_size . " " . \Common::signNum(\Common::modUnsigned($monster->constitution) * $monster->hit_dice_amount) . ")
		> - **Speed** ";

		$output .= $monster->speed != 0 ? "Base " . $monster->speed . " ft " : '';
		$output .= $monster->climb_speed != 0 ? "Climb " . $monster->climb_speed . " ft " : '';
		$output .= $monster->fly_speed != 0 ? "Fly " . $monster->fly_speed . " ft " : '';
		$output .= $monster->swim_speed != 0 ? "Swim " . $monster->swim_speed . " ft " : '';
		$output .= $monster->burrow_speed != 0 ? "Burrow " . $monster->burrow_speed . " ft " : '';

		$output .= "
		___
		STR | DEX | CON | INT | WIS | CHA&#013;
		:-:|:-:|:-:|:-:|:-:|:-:&#013;
		" . $monster->strength . " (" . \Common::mod($monster->strength) . ")|" . $monster->dexterity . " (" . \Common::mod($monster->dexterity) . ")|" . $monster->constitution . " (" . \Common::mod($monster->constitution) . ")|" . $monster->intelligence . " (" . \Common::mod($monster->intelligence) . ")|" . $monster->wisdom . " (" . \Common::mod($monster->wisdom) . ")|" . $monster->charisma . " (" . \Common::mod($monster->charisma) . ")&#013;
		___
		> - **Senses** ";

		$output .= $monster->darkvision != 0 ? "Darkvision " . $monster->darkvision . " ft " : '';
		$output .= $monster->truesight != 0 ? "Truesight" . $monster->truesight . " ft " : '';
		$output .= $monster->blindsight != 0 ? "Blindsight " . $monster->blindsight . " ft " : '';
		$output .= $monster->tremorsense != 0 ? "Tremorsense " . $monster->tremorsense . " ft " : '';

		$output .= "
		> - **Saving Throws** ";

		foreach (\GeneralHelper::getSavingThrows() as $key => $value) {
			if ($monster->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $monster->$key) . " ";
			}
		}

		$output .= "
		> - **Skills** ";

		foreach (\CreatureHelper::getSkills() as $key => $value) {
			if ($monster->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $monster->$key) . " ";
			}
		}

		$output .= "\r\n";

		$output .= !empty($monster->damage_immunities) ? "> - **Damage Immunities** " . ucfirst($monster->damage_immunities) . "\r\n" : '';
		$output .= !empty($monster->damage_vulnerabilities) ? "> - **Damage Vulnerabilities** " . ucfirst($monster->damage_vulnerabilities) . "\r\n" : '';
		$output .= !empty($monster->damage_resistances) ? "> - **Damage Resistances** " . ucfirst($monster->damage_resistances) . "\r\n" : '';
		$output .= !empty($monster->condition_immunities) ? "> - **Condition Immunities** " . ucfirst($monster->condition_immunities) . "\r\n" : '';

		$output .= "> - **Languages** " . $monster->languages . "
		> - **Challenge** " . \Common::decimalToFraction($monster->CR) . "\r\n";

		$output .= $monster->environment ? "> - **Environment** " . ucfirst($monster->environment) . "" : '';

		$output .= "
		> ___ \r\n";

		foreach ($monster->abilities as $ability) {
			$output .= "> ***" . $ability->name . "***
			" . $ability->description . " \r\n\r\n";
		}

		$output .= "
		> ### Actions
		";

		foreach ($monster->actions as $action) {
			if ($action->legendary == 0) {
				$output .= "> ***" . $action->name . "***
				" . $action->description . "\r\n\r\n";
			}
		}

		if ($monster->actions->contains('legendary', '1')) {
			$output .= "
			> ### Legendary Actions
			> ***Legendary Actions***
			The " . $monster->name . " can take 3 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The " . $monster->name . " regains spent legendary actions at the start of its turn. \r\n\r\n";

			foreach ($monster->actions as $action) {
				if ($action->legendary == 1) {
					$output .= "> ***" . $action->name . "***
					" . $action->description . "\r\n\r\n";
				}
			}
		}

		$output .= "
		> ___
		";

		$output .= Common::redditDescription($monster->description);

		return str_replace("\t", '', $output);

	}

	public static function getNpcRedditMarkdown($npc) {
		$output = "###[" . $npc->name . "](" . url('npc', $npc->id) . ")&#010;
			**Size** " . $npc->size . "&#010;
			**Profession/Title** " . ucfirst($npc->profession) . "&#010;
			**Alignment** " . ucfirst($npc->alignment) . "&#010;
			___&#010;" . "
			**Ideal** " . $npc->ideal . "  &#010;&#010;
			**Bond** " . $npc->bond . "  &#010;&#010;
			**Flaw** " . $npc->flaw . "  &#010;&#010;
			" . "
			___&#010;
			**Armor Class** " . $npc->AC . "  &#010;&#010;
			**Hit Points** " . $npc->HP . " (" . $npc->hit_dice_amount . "d" . $npc->hit_dice_size . " " . \Common::signNum(\Common::modUnsigned($npc->constitution) * $npc->hit_dice_amount) . ")  &#010;&#010;
			**Speed** ";

		$output .= $npc->speed != 0 ? "Base " . $npc->speed . " ft " : '';
		$output .= $npc->climb_speed != 0 ? "Climb " . $npc->climb_speed . " ft " : '';
		$output .= $npc->fly_speed != 0 ? "Fly " . $npc->fly_speed . " ft " : '';
		$output .= $npc->swim_speed != 0 ? "Swim " . $npc->swim_speed . " ft " : '';
		$output .= $npc->burrow_speed != 0 ? "Burrow " . $npc->burrow_speed . " ft " : '';

		$output .= "&#010;&#010;
			___&#010;
			STR | DEX | CON | INT | WIS | CHA&#013;
			:-:|:-:|:-:|:-:|:-:|:-:&#013;
			" . $npc->strength . " (" . \Common::mod($npc->strength) . ")|" . $npc->dexterity . " (" . \Common::mod($npc->dexterity) . ")|" . $npc->constitution . " (" . \Common::mod($npc->constitution) . ")|" . $npc->intelligence . " (" . \Common::mod($npc->intelligence) . ")|" . $npc->wisdom . " (" . \Common::mod($npc->wisdom) . ")|" . $npc->charisma . " (" . \Common::mod($npc->charisma) . ")&#013;
			___&#010; **Senses** ";

		$output .= $npc->darkvision != 0 ? "Darkvision " . $npc->darkvision . " ft " : '';
		$output .= $npc->truesight != 0 ? "Truesight" . $npc->truesight . " ft " : '';
		$output .= $npc->blindsight != 0 ? "Blindsight " . $npc->blindsight . " ft " : '';
		$output .= $npc->tremorsense != 0 ? "Tremorsense " . $npc->tremorsense . " ft " : '';

		$output .= "&#010;&#010;
			**Saving Throws** ";

		foreach (\GeneralHelper::getSavingThrows() as $key => $value) {
			if ($npc->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $npc->$key) . " ";
			}
		}

		$output .= "&#010;&#010;
			**Skills** ";

		foreach (\CreatureHelper::getSkills() as $key => $value) {
			if ($npc->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $npc->$key) . " ";
			}
		}

		$output .= "&#010;&#010;";

		$output .= !empty($npc->damage_immunities) ? "**Damage Immunities** " . ucfirst($npc->damage_immunities) . "&#010;&#010;" : '';
		$output .= !empty($npc->damage_vulnerabilities) ? "**Damage Vulnerabilities** " . ucfirst($npc->damage_vulnerabilities) . "&#010;&#010;" : '';
		$output .= !empty($npc->damage_resistances) ? "**Damage Resistances** " . ucfirst($npc->damage_resistances) . "&#010;&#010;" : '';
		$output .= !empty($npc->condition_immunities) ? "**Condition Immunities** " . ucfirst($npc->condition_immunities) . "&#010;&#010;" : '';

		$output .= "**Languages** " . $npc->languages . "&#010;&#010;
			**Challenge** " . \Common::decimalToFraction($npc->CR) . "&#010;&#010;";

		$output .= $npc->environment ? "**Environment** " . ucfirst($npc->environment) : '';

		$output .= "&#010; ___ &#010;";

		foreach ($npc->abilities as $ability) {
			$output .= "***" . $ability->name . "*** &#010;&#010;
				" . $ability->description . " &#010;&#010;";
		}

		$output .= "###Actions &#010;
			___ &#010;";

		foreach ($npc->actions as $action) {
			if ($action->legendary == 0) {
				$output .= "***" . $action->name . "***&#010;&#010;
					" . $action->description . "&#010;&#010;";
			}
		}

		if ($npc->actions->contains('legendary', '1')) {
			$output .= "###Legendary Actions&#010;
				___&#010;
				***Legendary Actions***&#010;
				The " . $npc->name . " can take 3 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The " . $npc->name . " regains spent legendary actions at the start of its turn. &#010;&#010;";

			foreach ($npc->actions as $action) {
				if ($action->legendary == 1) {
					$output .= "***" . $action->name . "***&#010;&#010;
						" . $action->description . "&#010;&#010;";
				}
			}
		}

		$output .= "&#010; ___ &#010;";

		$output .= Common::redditDescription($npc->description);

		return str_replace("\t", '', $output);
	}

	public static function getNpcHomebreweryMarkdown($npc) {
		$output = "___
			> ## [" . $npc->name . "](" . url('npc', $npc->id) . ")
			> *" . $npc->size . " " . ucfirst($npc->profession) . " " . ucfirst($npc->alignment) . "*
			> ___
			> - **Armor Class** " . $npc->AC . "
			> - **Hit Points** " . $npc->HP . " (" . $npc->hit_dice_amount . "d" . $npc->hit_dice_size . " " . \Common::signNum(\Common::modUnsigned($npc->constitution) * $npc->hit_dice_amount) . ")
			> - **Speed** ";

		$output .= $npc->speed != 0 ? "Base " . $npc->speed . " ft " : '';
		$output .= $npc->climb_speed != 0 ? "Climb " . $npc->climb_speed . " ft " : '';
		$output .= $npc->fly_speed != 0 ? "Fly " . $npc->fly_speed . " ft " : '';
		$output .= $npc->swim_speed != 0 ? "Swim " . $npc->swim_speed . " ft " : '';
		$output .= $npc->burrow_speed != 0 ? "Burrow " . $npc->burrow_speed . " ft " : '';

		$output .= "
			___
			STR | DEX | CON | INT | WIS | CHA&#013;
			:-:|:-:|:-:|:-:|:-:|:-:&#013;
			" . $npc->strength . " (" . \Common::mod($npc->strength) . ")|" . $npc->dexterity . " (" . \Common::mod($npc->dexterity) . ")|" . $npc->constitution . " (" . \Common::mod($npc->constitution) . ")|" . $npc->intelligence . " (" . \Common::mod($npc->intelligence) . ")|" . $npc->wisdom . " (" . \Common::mod($npc->wisdom) . ")|" . $npc->charisma . " (" . \Common::mod($npc->charisma) . ")&#013;
			___
			> - **Senses** ";

		$output .= $npc->darkvision != 0 ? "Darkvision " . $npc->darkvision . " ft " : '';
		$output .= $npc->truesight != 0 ? "Truesight" . $npc->truesight . " ft " : '';
		$output .= $npc->blindsight != 0 ? "Blindsight " . $npc->blindsight . " ft " : '';
		$output .= $npc->tremorsense != 0 ? "Tremorsense " . $npc->tremorsense . " ft " : '';

		$output .= "
			> - **Saving Throws** ";

		foreach (\GeneralHelper::getSavingThrows() as $key => $value) {
			if ($npc->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $npc->$key) . " ";
			}
		}

		$output .= "
			> - **Skills** ";

		foreach (\CreatureHelper::getSkills() as $key => $value) {
			if ($npc->$key != 0) {
				$output .= $value . " " . sprintf('%+d', $npc->$key) . " ";
			}
		}

		$output .= "\r\n";

		$output .= !empty($npc->damage_immunities) ? "> - **Damage Immunities** " . ucfirst($npc->damage_immunities) . "\r\n" : '';
		$output .= !empty($npc->damage_vulnerabilities) ? "> - **Damage Vulnerabilities** " . ucfirst($npc->damage_vulnerabilities) . "\r\n" : '';
		$output .= !empty($npc->damage_resistances) ? "> - **Damage Resistances** " . ucfirst($npc->damage_resistances) . "\r\n" : '';
		$output .= !empty($npc->condition_immunities) ? "> - **Condition Immunities** " . ucfirst($npc->condition_immunities) . "\r\n" : '';

		$output .= "> - **Languages** " . $npc->languages . "
			> - **Challenge** " . \Common::decimalToFraction($npc->CR) . "\r\n";

		$output .= $npc->environment ? "> - **Environment** " . ucfirst($npc->environment) . "" : '';

		$output .= "
			> ___ \r\n";

		foreach ($npc->abilities as $ability) {
			$output .= "> ***" . $ability->name . "***
				" . $ability->description . " \r\n\r\n";
		}

		$output .= "
			> ### Actions
			";

		foreach ($npc->actions as $action) {
			if ($action->legendary == 0) {
				$output .= "> ***" . $action->name . "***
					" . $action->description . "\r\n\r\n";
			}
		}

		if ($npc->actions->contains('legendary', '1')) {
			$output .= "
				> ### Legendary Actions
				> ***Legendary Actions***
				The " . $npc->name . " can take 3 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The " . $npc->name . " regains spent legendary actions at the start of its turn. \r\n\r\n";

			foreach ($npc->actions as $action) {
				if ($action->legendary == 1) {
					$output .= "> ***" . $action->name . "***
						" . $action->description . "\r\n\r\n";
				}
			}
		}

		$output .= "
			> ___
			";

		$output .= Common::redditDescription($npc->description);

		$output .= "
		> ___
		> - **Ideal** " . $npc->ideal . "
		> - **Bond** " . $npc->bond . "
		> - **Flaw** " . $npc->flaw;

		return str_replace("\t", '', $output);

	}

}