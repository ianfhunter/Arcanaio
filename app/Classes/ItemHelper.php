<?php

namespace App\Classes;

class ItemHelper {
	public static function getRarityColor($rarity) {
		if ($rarity == 'Legendary') {
			$color = 'orange';
		} elseif ($rarity == 'Very Rare') {
			$color = 'purple';
		} elseif ($rarity == 'Rare') {
			$color = 'blue';
		} elseif ($rarity == 'Uncommon') {
			$color = 'green';
		} else {
			$color = '';
		}

		return $color;
	}

	public static function getTypes() {
		return [
			'Gear' => 'Adventure Gear',
			'Armor' => 'Armor',
			'Gem' => 'Gem',
			'Instrument' => 'Instrument',
			'Mundane' => 'Mundane',
			'Potion' => 'Potion',
			'Ring' => 'Ring',
			'Rod' => 'Rod',
			'Scroll' => 'Scroll',
			'Staff' => 'Staff',
			'Tool' => 'Tool',
			'Vehicle' => 'Vehicle',
			'Wand' => 'Wand',
			'Weapon' => 'Weapon',
			'Wondrous' => 'Wondrous',
		];
	}

	public static function getRarity() {
		return [
			'Common' => 'Common',
			'Uncommon' => 'Uncommon',
			'Rare' => 'Rare',
			'Very Rare' => 'Very Rare',
			'Legendary' => 'Legendary',
		];
	}

	public static function getWeaponTypes() {
		return [
			'Simple' => 'Simple',
			'Martial' => 'Martial',
		];
	}

	public static function getArmorTypes() {
		return [
			'Light' => 'Light',
			'Medium' => 'Medium',
			'Heavy' => 'Heavy',
			'Shield' => 'Shield',
		];
	}

	public static function getRedditMarkdown($item) {
		$output = "#### [" . $item->name . "](" . url('item', $item->id) . ")
		*" . ucfirst($item->type) . "*, *" . $item->rarity . "* &#010;&#010;";

		if ($item->type == 'Weapon') {
			$output .=
			"**Type:** " . $item->subtype . "&#010;
			**Damage:** " . $item->weapon_damage . "&#010;
			**Range:** " . $item->weapon_range . "&#010;
			**Properties:** " . $item->weapon_properties . "&#010;&#010;";
		}
		if ($item->type == 'Armor') {
			$output .=
			"**Type:** " . $item->subtype . "&#010;
			**AC:** " . $item->ac . "&#010;
			**Str Req:** " . $item->armor_str_req . "&#010;
			**Stealth:** " . $item->armor_stealth . "&#010;&#010;";
		}

		$output .= Common::redditDescription($item->description);

		return str_replace("\t", '', $output);
	}

	public static function getHomebreweryMarkdown($item) {
		$output = "#### " . $item->name . "
		*" . ucfirst($item->type) . ", " . $item->rarity . "*";

		if ($item->type == 'Weapon') {
			$output .= "
			___
			- **Type:** " . $item->subtype . "
			- **Damage:** " . $item->weapon_damage . "
			- **Range:** " . $item->weapon_range . "
			- **Properties:** " . $item->weapon_properties . "\r\r\n";
		} else if ($item->type == 'Armor') {
			$output .= "
			___
			- **Type:** " . $item->subtype . "
			- **AC:** " . $item->ac . "
			- **Str Req:** " . $item->armor_str_req . "
			- **Stealth:** " . $item->armor_stealth;
		}

		$output .= Common::redditDescription($item->description);

		return str_replace("\t", '', $output);
	}

}