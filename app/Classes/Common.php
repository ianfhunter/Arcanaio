<?php

namespace App\Classes;

class Common {

	public static function generateAlgoliaKey() {

		$client = new \AlgoliaSearch\Client(env('ALGOLIA_APP_ID'), env('ALGOLIA_SECRET'));

		if (\Auth::user()) {
			$public_key = $client->generateSecuredApiKey(env('ALGOLIA_APP_KEY'), array("filters" => 'user_' . \Auth::id() . ' OR public', "validUntil" => strtotime('+1 hour', time())));
		} else {
			$public_key = $client->generateSecuredApiKey(env('ALGOLIA_APP_KEY'), array("filters" => 'public', "validUntil" => strtotime('+1 hour', time())));
		}

		return $public_key;
	}

	public static function decimalToFraction($float) {

		$whole = floor($float);
		$decimal = $float - $whole;
		$leastCommonDenom = 48; // 16 * 3;
		$denominators = array(2, 3, 4, 8, 16, 24, 48);
		$roundedDecimal = round($decimal * $leastCommonDenom) / $leastCommonDenom;
		if ($roundedDecimal == 0) {
			return $whole;
		}

		if ($roundedDecimal == 1) {
			return $whole + 1;
		}

		foreach ($denominators as $d) {
			if ($roundedDecimal * $d == floor($roundedDecimal * $d)) {
				$denom = $d;
				break;
			}
		}
		return ($whole == 0 ? '' : $whole) . ($roundedDecimal * $denom) . "/" . $denom;

	}
	public static function getAvatar($url) {
		if ($url == null) {
			return "/img/avatar.jpg";
		} else {
			return $url;
		}
	}

	public static function colorCR($cr) {
		if ($cr >= 17 && $cr < 50) {
			return "red";
		} elseif ($cr >= 12 && $cr < 17) {
			return "orange";
		} elseif ($cr >= 7 && $cr < 12) {
			return "yellow";
		} elseif ($cr >= 2 && $cr < 7) {
			return "olive";
		} else {
			return "green";
		}
	}

	public static function colorSkillMod($mod) {
		if ($mod >= -20 && $mod < -2) {
			return "red";
		} elseif ($mod >= -2 && $mod < 0) {
			return "red";
		} elseif ($mod == 0) {
			return "basic";
		} elseif ($mod >= 1 && $mod < 4) {
			return "green";
		} else {
			return "green";
		}
	}

	public static function mod($ability_score) {
		$mod = floor(((int) $ability_score - 10) / 2);
		if ($mod < 0) {
			return $mod;
		} else {
			$mod = "+" . $mod;
			return $mod;
		}

	}

	public static function modUnsigned($ability_score) {
		$mod = floor(((int) $ability_score - 10) / 2);
		return $mod;
	}

	public static function signNum($num) {
		return sprintf("%+d", $num);
	}

	public static function spellLinks($spell_list) {
		$array = explode(',', $spell_list);
		$array = array_map('trim', $array);
		$spells = array();

		foreach ($array as $key => $value) {
			$html = (new \App\Http\Controllers\SpellController)->get($value);
			$spells += [$value => $html];
		}
		return $spells;
	}

	public static function redditDescription($string) {

		$description = str_replace('<p>', '', $string);
		$description = str_replace('</p>', '&#010;', $description);
		$description = str_replace('<b>', '**', $description);
		$description = str_replace('</b>', '**', $description);
		$description = str_replace('<i>', '*', $description);
		$description = str_replace('</i>', '*', $description);
		return $description;
	}

	public static function setActive($path) {
		return \Request::is($path) ? 'active' : '';
	}

}