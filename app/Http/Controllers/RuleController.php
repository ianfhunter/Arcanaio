<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller {

	function nl2p($string) {
		$paragraphs = '';

		foreach (explode("\n", $string) as $line) {
			if (trim($line)) {
				$paragraphs .= '<p>' . $line . '</p>';
			}
		}

		return $paragraphs;
	}

	public static function format($line) {
		if (starts_with($line, '# ')) {
			$line = str_replace("# ", "<h1 class='ui header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h1>", $line);
			$name = str_replace("<h1 class='ui header'>", "", $line);
			$name = strtolower(str_replace("</h1>", "", $name));
		}

		if (starts_with($line, '## ')) {
			$line = str_replace("## ", "<h2 class='ui header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h2>", $line);
		}

		if (starts_with($line, '### ')) {
			$line = str_replace("### ", "<h3 class='ui header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h3>", $line);
		}

		if (starts_with($line, '#### ')) {
			$line = str_replace("#### ", "<h4 class='ui header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h4>", $line);
		}

		if (starts_with($line, '>#### ')) {
			$line = str_replace(">#### ", "<h4 class='ui sub header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h4>", $line);
		}

		if (starts_with($line, '> ')) {
			$line = str_replace("> ", "<br>", $line);
		}

		if (starts_with($line, '>')) {
			$line = str_replace(">", "<br>", $line);

		}

		$line = str_replace("** ", "</b> ", $line);
		$line = str_replace("**,", "</b>,", $line);
		$line = str_replace("**.", "</b>.", $line);
		$line = str_replace("**", "<b>", $line);
		$line = str_replace(" **", " <b>", $line);

		if (starts_with($line, '* ')) {

			$line = str_replace("* ", "<div class='item'><i class='circle thin mini icon'></i>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</div>", $line);

		}

		if (starts_with($line, '- ')) {

			$line = str_replace("- ", "<div class='item'><i class='circle thin mini icon'></i>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</div>", $line);

		}

		if (starts_with($line, '##')) {

			$line = str_replace("##", "<h5 class='ui header'>", $line);
			$line = str_replace(array("\n\r", "\n", "\r"), "</h5>", $line);

		}

		$line = str_replace(" \n", "<br>", $line);
		$line = str_replace('(*', "", $line);
		$line = str_replace('*)', ")", $line);
		$line = str_replace(' *', " <i>", $line);
		$line = str_replace('* ', "</i> ", $line);
		$line = str_replace('*,', "</i>,", $line);
		$line = str_replace('*.', "</i>.", $line);

		$line = str_replace("<table>", "<table class='ui striped compact table'>", $line);

		$line = str_replace('#', "", $line);

		return $line;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('rule.index', compact('string'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$files = glob(base_path('resources/rules/gamemaster/*.md'), GLOB_BRACE);

		foreach ($files as $file) {
			$string = "";
			$handle = fopen($file, "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false) {

					if (starts_with($line, '# ')) {
						$name = $line;
					}

					$string .= $this->format($line);
					/*
				ends_with('This is my name', 'name');
				starts_with('This is my name', 'This');
				str_finish('this/string', '/');
				str_contains('This is my name', ['my', 'foo']);
				str_slug('Laravel 5 Framework', '-');
				str_replace("%body%", "black", "<body text='%body%'>");*/
				}

				if (!isset($name)) {
					$name = str_random(5);
				}

				$rule = new Rule();
				$rule->name = $name;
				$rule->slug = str_slug($name);
				$rule->description = $string;
				$rule->summary = $string;
				$rule->parent = "Gamemaster";
				$rule->system = "5E";
				$rule->source = "5E SRD";
				$rule->save();

				fclose($handle);
			} else {
				return "Error.";
			}
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		$rule = Rule::where('slug', lcfirst($slug))->first();

		return view('rule.show', compact('rule'));
	}

	public function section($slug) {
		$rules = Rule::where('parent', $slug)->orderBy('name', 'asc')->get();
		$section = $slug;

		return view('rule.sections', compact('rules', 'section'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit() {
		$rules = Rule::all();

		foreach ($rules as $rule) {
			$rule->description = preg_replace('~<p>(.*?)</p>~is', '$1', $rule->description, 1);
			$rule->save();
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
