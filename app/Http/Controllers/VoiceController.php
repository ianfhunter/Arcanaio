<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Spell;
use App\Monster;
use App\Item;

class VoiceController extends Controller
{

    public function webhook(Request $request){

    	$question = json_decode($request->getContent(), true);
    	$answer = '';
    	$data = [];

    	if($question['result']['action'] == 'getCastTime'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                if($spell->casting_time){
                    $cast_time = $spell->casting_time;
                    $answer = "The cast time is ".$cast_time.".";
                    $data = ['cast_time' => $cast_time];
                }else{
                    $answer = "No cast time found.";
                }   
            } 		

    	}elseif($question['result']['action'] == 'getRange'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                if($spell->range){
                    $range = $spell->range;
                    $answer = "The range is ".$range.".";
                    $data = ['range' => $range];
                }else{
                    $answer = "No range found ".$question['result']['parameters']['spell'].".";
                }   
            } 		

    	}elseif($question['result']['action'] == 'getComponents'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                $components = $spell->components;

                if($components){
                    $answer = "The components are ".$components.".";
                }else{
                    $answer = "There are no components.";
                }

                $data = ['components' => $components];
            }

    	}elseif($question['result']['action'] == 'getConcentration'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                $concentration = $spell->concentration;

                if($spell->concentration == 1){
                    $answer = "Yes";
                }else{
                    $answer = "No";
                }    

                $data = ['concentration' => $concentration];
            }

    	}elseif($question['result']['action'] == 'getRitual'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                $ritual = $spell->ritual;

                if($ritual == 1){
                    $answer = "Yes";
                }else{
                    $answer = "No";
                }           

                $data = ['ritual' => $ritual];
            }

    	}elseif($question['result']['action'] == 'getMaterials'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                $materials = $spell->material;

                if($materials){
                    $answer = "The materials are ".$materials.".";
                }else{
                    $answer = "There are no materials.";
                }

                $data = ['materials' => $materials];
            }


    	}elseif($question['result']['action'] == 'getSpellDescription'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                $description = $spell->description;

                $answer = $description;

                $data = ['description' => $description];
            }


    	}elseif($question['result']['action'] == 'getCast'){
    		$spell = $question['result']['parameters']['spell'];

    		$spell = Spell::where('name', 'LIKE', "%$spell%")->first();

            if(!$spell){
                $answer = "Spell not found. Try again or make sure the spell exists.";
            }else{
                if($spell->casting_time){
                    $cast_time = $spell->casting_time;
                    $answer = "The cast time is ".$cast_time.".";
                    $data = ['cast_time' => $cast_time];
                }else{
                    $answer = "No cast time found for this spell.";
                }
            }

    	}elseif($question['result']['action'] == 'getMonsterAC'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                if($monster->AC){
                    $AC = $monster->AC;
                    $answer = "It's armor class is ".$AC.".";
                    $data = ['AC' => $AC];
                }else{
                    $answer = "No armor class found for this monster.";
                }
            }


        }elseif($question['result']['action'] == 'getMonsterHP'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                if($monster->HP){
                    $HP = $monster->HP;
                    $answer = "It has ".$HP." hit points.";
                    $data = ['HP' => $HP];
                }else{
                    $answer = "No hit points found for this monster.";
                }
            }

        }elseif($question['result']['action'] == 'getMonsterSize'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                if($monster->size){
                    $size = $monster->size;
                    $answer = "It's size is ".$size.".";
                    $data = ['size' => $size];
                }else{
                    $answer = "Size unknown.";
                }
            }

        }elseif($question['result']['action'] == 'getMonsterCR'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                $CR = $monster->CR_fraction;
                $answer = "It's CR is ".$CR.".";
                $data = ['CR' => $CR];
            }

        }elseif($question['result']['action'] == 'getMonsterDescription'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                $description = $monster->description;
                $answer = $description;
                $data = ['description' => $description];
            }

        }elseif($question['result']['action'] == 'getMonsterType'){
            $monster = $question['result']['parameters']['monster'];

            $monster = Monster::where('name', 'LIKE', "%$monster%")->first();

            if(!$monster){
                $answer = "Monster not found. Try again or make sure the monster exists.";
            }else{
                for($i = 1; $i < 6; $i++){
                    $subtype = "subtype".$i;
                    if($monster->$subtype){
                        $monster->type .= " & ".$monster->$subtype;                        
                    }
                }

                $type = $monster->type;
                $answer = "It's type is ".$type.".";
                $data = ['type' => $type];
            }


        }elseif($question['result']['action'] == 'getItemType'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
                if($item->subtype){
                    $type = $item->type." & ".$item->subtype;                        
                }else{
                    $type = $item->type;
                }

                $answer = "It's type is ".$type.".";
                $data = ['type' => $type];
            }

        }elseif($question['result']['action'] == 'getItemDescription'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
                if($item->description){
                    $description = $item->description;
                    $answer = $description;
                    $data = ['description' => $description];
                }else{
                    $answer = "No description available for this item.";
                }
            }

        }elseif($question['result']['action'] == 'getItemCost'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
                if($item->cost){
                    $cost = $item->cost;
                    $answer = "It's cost is ".$cost.".";
                    $data = ['cost' => $cost];
                }else{
                    $answer = "No cost found for ".$question['result']['parameters']['item'].".";
                }
            }

        }elseif($question['result']['action'] == 'getItemRarity'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
                if($item->rarity){
                    $rarity = $item->rarity;
                    $answer = "It's rarity is ".$rarity.".";
                    $data = ['rarity' => $rarity];
                }else{
                    $answer = "No rarity found.";
                }
            }

        }elseif($question['result']['action'] == 'getItemDamage'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
                if($item->weapon_damage){
                    $damage = $item->weapon_damage;
                    $answer = "It's damage is ".$damage.".";
                    $data = ['damage' => $damage];
                }else{
                    $answer = "No damage found.";
                }
            }

        }elseif($question['result']['action'] == 'getItemProperties'){
            $item = $question['result']['parameters']['item'];

            $item = Item::where('name', 'LIKE', "%$item%")->first();

            if(!$item){
                $answer = "Item not found. Try again or make sure the item exists.";
            }else{
              if($item->weapon_properties){
                  $properties = $item->weapon_properties;
                  $answer = "It's properties are ".$properties.".";
                  $data = ['properties' => $properties];
              }else{
                  $answer = "No properties found.";
              }  
            }
            
        }


        return response()->json([
            "speech" => $answer,
			"displayText" => $answer,
			"data" => $data,
			"contextOut" => [],
			"source" => "Arcana.io"
        ], 200);
    }

}
