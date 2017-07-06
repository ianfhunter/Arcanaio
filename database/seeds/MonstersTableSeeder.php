<?php

use Illuminate\Database\Seeder;
use App\Monster;
use App\MonsterAbility;
use App\MonsterAction;

class MonstersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //START 5E MONSTERS
        $jsondata = file_get_contents(base_path('database/data/monsters5e.json'));

        $data = json_decode($jsondata, true);

        $files = glob(base_path('database/data/monsters/*.json'));

        foreach ($data as $key) {

            $ma = isset($key['challenge_rating']) ? $key['challenge_rating'] : "0";
            $p = eval('return '.$ma.';');
            $newDesc = "";

            //$newDesc = Monster::where('name', $key['name'])->first();     

            $rows = array_map('str_getcsv', file(base_path('database/data/bestiary.csv')));
            $header = array_shift($rows);
            $csv = array();
            foreach ($rows as $row) {
              $csv[] = array_combine($header, $row);
            }


            foreach ($csv as $keytwo) {

                if($keytwo['Name'] == $key['name']){
                   $newDesc = isset($keytwo['Description']) ? $newDesc->description : "";
                   break;
                }

            }       

            foreach ($files as $file) {
                
                $jsondata = file_get_contents($file);

                $monsterArray = json_decode($jsondata, true);

                if($monsterArray['name'] === $key['name']){
                    $newDesc = isset($monsterArray['description']) ? $monsterArray['description'] : "";  
                    break;                  
                }
            }

            $hit_dice = explode("d", $key['hit_dice']);

            $senses = str_replace(' ft.','',$key['senses']);
            $senses = explode(',', $senses);
            $darkvision = 0;
            $tremorsense = 0;
            $blindsight = 0;
            $truesight = 0;

            foreach ($senses as $sense) {
                if (strpos($sense, 'darkvision') !== false) {
                    $darkvision = str_replace('darkvision ', '', $sense);
                }elseif (strpos($sense, 'tremorsense') !== false) {
                    $tremorsense = str_replace('tremorsense ', '', $sense);
                }elseif (strpos($sense, 'blindsight') !== false) {
                    $blindsight = str_replace('blindsight ', '', $sense);
                }elseif (strpos($sense, 'truesight') !== false) {
                    $truesight = str_replace('truesight ', '', $sense);
                }
             } 

            $speed = str_replace(' ft.','',$key['speed']);
            $speed = explode(',', $speed);
            $swim_speed = 0;
            $climb_speed = 0;
            $burrow_speed = 0;
            $fly_speed = 0;
            $base = 0;

            foreach ($speed as $sp) {
                if (strpos($sp, 'swim') !== false) {
                    $swim_speed = str_replace('swim', '', $sp);
                }elseif (strpos($sp, 'climb') !== false) {
                    $climb_speed = str_replace('climb ', '', $sp);
                }elseif (strpos($sp, 'burrow') !== false) {
                    $burrow_speed = str_replace('burrow ', '', $sp);
                }elseif (strpos($sp, 'fly') !== false) {
                    $fly_speed = str_replace('fly ', '', $sp);
                }else{
                    $base = $sp;
                }
             } 

            $monster5e = new Monster;

            $monster5e->name = isset($key['name']) ? $key['name'] : null;
            $monster5e->description = $newDesc;
            $monster5e->CR = $p;
            $monster5e->alignment = isset($key['alignment']) ? $key['alignment'] : null;
            $monster5e->size = isset($key['size']) ? $key['size'] : null;
            $monster5e->type = isset($key['type']) ? $key['type'] : null;
            $monster5e->subtype1 = isset($key['subtype']) ? $key['subtype'] : null;
            $monster5e->AC = isset($key['armor_class']) ? $key['armor_class'] : null;
            $monster5e->HP = isset($key['hit_points']) ? $key['hit_points'] : null;
            $monster5e->hit_dice_amount = isset($hit_dice[0]) ? $hit_dice[0] : null;
            $monster5e->hit_dice_size = isset($hit_dice[1]) ? $hit_dice[1] : null;
            $monster5e->str_save = isset($key['strength_save']) ? $key['strength_save'] : null;
            $monster5e->dex_save = isset($key['dexterity_save']) ? $key['dexterity_save'] : null;
            $monster5e->con_save = isset($key['constitution_save']) ? $key['constitution_save'] : null;
            $monster5e->int_save = isset($key['intelligence_save']) ? $key['intelligence_save'] : null;
            $monster5e->wis_save = isset($key['wisdom_save']) ? $key['wisdom_save'] : null;
            $monster5e->cha_save = isset($key['charisma_save']) ? $key['charisma_save'] : null;
            $monster5e->strength = isset($key['strength']) ? $key['strength'] : null;
            $monster5e->dexterity = isset($key['dexterity']) ? $key['dexterity'] : null;
            $monster5e->constitution = isset($key['constitution']) ? $key['constitution'] : null;
            $monster5e->intelligence = isset($key['intelligence']) ? $key['intelligence'] : null;
            $monster5e->wisdom = isset($key['wisdom']) ? $key['wisdom'] : null;
            $monster5e->charisma = isset($key['charisma']) ? $key['charisma'] : null;
            $monster5e->darkvision = isset($darkvision) ? trim($darkvision) : null;
            $monster5e->tremorsense = isset($tremorsense) ? trim($tremorsense) : null;
            $monster5e->truesight = isset($truesight) ? trim($truesight) : null;
            $monster5e->blindsight = isset($blindsight) ? trim($blindsight) : null;
            $monster5e->acrobatics = isset($key['acrobatics']) ? $key['acrobatics'] : null;
            $monster5e->animal_handling = isset($key['animal_handling']) ? $key['animal_handling'] : null;
            $monster5e->arcana = isset($key['arcana']) ? $key['arcana'] : null;
            $monster5e->athletics = isset($key['athletics']) ? $key['athletics'] : null;
            $monster5e->deception = isset($key['deception']) ? $key['deception'] : null;
            $monster5e->history = isset($key['history']) ? $key['history'] : null;
            $monster5e->insight = isset($key['insight']) ? $key['insight'] : null;
            $monster5e->intimidation = isset($key['intimidation']) ? $key['intimidation'] : null;
            $monster5e->investigation = isset($key['investigation']) ? $key['investigation'] : null;
            $monster5e->medicine = isset($key['medicine']) ? $key['medicine'] : null;
            $monster5e->nature = isset($key['nature']) ? $key['nature'] : null;
            $monster5e->perception = isset($key['perception']) ? $key['perception'] : null;
            $monster5e->performance = isset($key['performance']) ? $key['performance'] : null;
            $monster5e->persuasion = isset($key['persuasion']) ? $key['persuasion'] : null;
            $monster5e->religion = isset($key['religion']) ? $key['religion'] : null;
            $monster5e->stealth = isset($key['stealth']) ? $key['stealth'] : null;
            $monster5e->survival = isset($key['survival']) ? $key['survival'] : null;
            $monster5e->languages = isset($key['languages']) ? $key['languages'] : null;
            $monster5e->damage_vulnerabilities = isset($key['damage_vulnerabilities']) ? $key['damage_vulnerabilities'] : null;
            $monster5e->damage_resistances = isset($key['damage_resistances']) ? $key['damage_resistances'] : null;
            $monster5e->damage_immunities = isset($key['damage_immunities']) ? $key['damage_immunities'] : null;
            $monster5e->condition_immunities = isset($key['condition_immunities']) ? $key['condition_immunities'] : null;
            $monster5e->speed = isset($base) ? $base : null;
            $monster5e->climb_speed = isset($climb_speed) ? trim($climb_speed) : null;
            $monster5e->fly_speed = isset($fly_speed) ? trim($fly_speed) : null;
            $monster5e->burrow_speed = isset($burrow_speed) ? trim($burrow_speed) : null;
            $monster5e->swim_speed = isset($swim_speed) ? trim($swim_speed) : null;
            $monster5e->source = "5E SRD";
            $monster5e->system = "5E";
            $monster5e->user_id = "1";
            $monster5e->save();  

            if (isset($key['special_abilities'])) 
            {
                foreach ($key['special_abilities'] as $sa) 
                {
                    $newAbility = new MonsterAbility;
                    $newAbility->name = isset($sa['name']) ? $sa['name'] : null;
                    $newAbility->description = isset($sa['desc']) ? $sa['desc'] : null;
                    $newAbility->monster_id = $monster5e->id;
                    $newAbility->save(); 

    
                }
            } 

            if(isset($key['actions'])){
                foreach ($key['actions'] as $act) {

                    $newAction = new MonsterAction;
                    $newAction->name = isset($act['name']) ? $act['name'] : null;
                    $newAction->description = isset($act['desc']) ? $act['desc'] : null;
                    $newAction->attack_bonus = isset($act['attack_bonus']) ? $act['attack_bonus'] : "";
                    $newAction->damage_dice = isset($act['damage_dice']) ? $act['damage_dice'] : "";
                    $newAction->damage_bonus = isset($act['damage_bonus']) ? $act['damage_bonus'] : "";
                    $newAction->monster_id = $monster5e->id;
                    $newAction->save(); 


                }               
            }     


            if(isset($key['legendary_actions'])){
                foreach ($key['legendary_actions'] as $la) {

                    $newAction = new MonsterAction;
                    $newAction->name = isset($la['name']) ? $la['name'] : "";
                    $newAction->description = isset($la['desc']) ? $la['desc'] : "";
                    $newAction->legendary = 1; 
                    $newAction->monster_id = $monster5e->id;
                    $newAction->save(); 
 
                }   
            }    
        }

/*
        $rows = array_map('str_getcsv', file('http://copilot.app/bestiary.csv'));
        $header = array_shift($rows);
        $csv = array();
        foreach ($rows as $row) {
          $csv[] = array_combine($header, $row);
        }


        foreach ($csv as $key) {


            $monster = new Monster;
            $monster->name = isset($key['Name']) ? $key['Name'] : "";
            $monster->CR = isset($key['CR']) ? $key['CR'] : "";
            $monster->XP = isset($key['XP']) ? str_replace(array('.', ','), '' , $key['XP']) : "";
            $monster->race = isset($key['Race']) ? $key['Race'] : "";
            $monster->class1 = isset($key['Class1']) ? $key['Class1'] : "";
            $monster->class1_level = isset($key['Class1_Lvl']) ? $key['Class1_Lvl'] : "";
            $monster->class2 = isset($key['Class2']) ? $key['Class2'] : "";
            $monster->class2_level = isset($key['Class2_Lvl']) ? $key['Class2_Lvl'] : "";
            $monster->alignment = isset($key['Alignment']) ? $key['Alignment'] : "";
            $monster->description = isset($key['Description']) ? $key['Description'] : "";
            $monster->size = isset($key['Size']) ? $key['Size'] : "";
            $monster->type = isset($key['Type']) ? $key['Type'] : "";
            $monster->subtype1 = isset($key['subtype1']) ? $key['subtype1'] : "";
            $monster->subtype2 = isset($key['subtype2']) ? $key['subtype2'] : "";
            $monster->subtype3 = isset($key['subtype3']) ? $key['subtype3'] : "";
            $monster->subtype4 = isset($key['subtype4']) ? $key['subtype4'] : "";
            $monster->subtype5 = isset($key['subtype5']) ? $key['subtype5'] : "";
            $monster->subtype6 = isset($key['subtype6']) ? $key['subtype6'] : "";
            $monster->AC = isset($key['AC']) ? $key['AC'] : "";
            $monster->AC_touch = isset($key['AC_Touch']) ? $key['AC_Touch'] : "";
            $monster->AC_flat = isset($key['AC_Flat-footed']) ? $key['AC_Flat-footed'] : "";
            $monster->HP = isset($key['HP']) ? $key['HP'] : "";
            $monster->HD = isset($key['HD']) ? $key['HD'] : "";
            $monster->fort = isset($key['Fort']) ? $key['Fort'] : "";
            $monster->ref = isset($key['Ref']) ? $key['Ref'] : "";
            $monster->will = isset($key['Will']) ? $key['Will'] : "";
            $monster->melee = isset($key['Melee']) ? $key['Melee'] : "";
            $monster->ranged = isset($key['Ranged']) ? $key['Ranged'] : "";
            $monster->space = isset($key['Space']) ? $key['Space'] : "";
            $monster->reach = isset($key['Reach']) ? $key['Reach'] : "";
            $monster->str = isset($key['Str']) ? $key['Str'] : "";
            $monster->dex = isset($key['Dex']) ? $key['Dex'] : "";
            $monster->con = isset($key['Con']) ? $key['Con'] : "";
            $monster->int = isset($key['Int']) ? $key['Int'] : "";
            $monster->wis = isset($key['Wis']) ? $key['Wis'] : "";
            $monster->cha = isset($key['Cha']) ? $key['Cha'] : "";
            $monster->feats = isset($key['Feats']) ? $key['Feats'] : "";
            $monster->skills = isset($key['Skills']) ? $key['Skills'] : "";
            $monster->racialmods = isset($key['RacialMods']) ? $key['RacialMods'] : "";
            $monster->languages = isset($key['Languages']) ? $key['Languages'] : "";
            $monster->sq = isset($key['SQ']) ? $key['SQ'] : "";
            $monster->environment = isset($key['Environment']) ? $key['Environment'] : "";
            $monster->organization = isset($key['Organization']) ? $key['Organization'] : "";
            $monster->treasure = isset($key['Treasure']) ? $key['Treasure'] : "";
            $monster->group = isset($key['Group']) ? $key['Group'] : "";
            $monster->gear = isset($key['Gear']) ? $key['Gear'] : "";
            $monster->othergear = isset($key['OtherGear']) ? $key['OtherGear'] : "";
            $monster->character = isset($key['CharacterFlag']) ? $key['CharacterFlag'] : "";
            $monster->companion = isset($key['CompanionFlag']) ? $key['CompanionFlag'] : "";
            $monster->speed = isset($key['Speed']) ? $key['Speed'] : "";
            $monster->base_speed = isset($key['Base_Speed']) ? $key['Base_Speed'] : "";
            $monster->fly_speed = isset($key['Fly_Speed']) ? $key['Fly_Speed'] : "";
            $monster->climb_speed = isset($key['Climb_Speed']) ? $key['Climb_Speed'] : "";
            $monster->swim_speed = isset($key['Swim_Speed']) ? $key['Swim_Speed'] : "";
            $monster->burrow_speed = isset($key['Burrow_Speed']) ? $key['Burrow_Speed'] : "";
            $monster->speed_special = isset($key['Speed_Special']) ? $key['Speed_Special'] : "";
            $monster->speed_land = isset($key['Speed_Land']) ? $key['Speed_Land'] : "";
            $monster->fly = isset($key['Fly']) ? $key['Fly'] : "";
            $monster->maneuverability = isset($key['Maneuverability']) ? $key['Maneuverability'] : "";
            $monster->climb = isset($key['Climb']) ? $key['Climb'] : "";
            $monster->burrow = isset($key['Burrow']) ? $key['Burrow'] : "";
            $monster->swim = isset($key['Swim']) ? $key['Swim'] : "";
            $monster->mythic = isset($key['Mythic']) ? $key['Mythic'] : "";
            $monster->source = isset($key['Source']) ? $key['Source'] : "";
            $monster->system = 'Pathfinder';
            $monster->creator_id = "1";
            $monster->save();         
        }

        $files = glob(base_path('public/monsters/*.json'));

        foreach ($files as $file) {

            $jsondata = file_get_contents($file);

            $monsterArray = json_decode($jsondata, true);

            $model = Monster::where('system', "Pathfinder")->where('name', $monsterArray['name'])->first();

            if($model){


                if(isset($monsterArray['spells'])){
                     foreach ($monsterArray['spells'] as $spell) {
                        if(key($spell) == "spell-like abilities"){
                            $spellLikeAbilities = $spell['spell-like abilities'];
                        }elseif(key($spell) == "spells prepared"){
                            $spellsPrepared = $spell['spells prepared'];
                        }
                    }               
                }

                if(!isset($monsterArray['description'])){
                    $monsterArray['description'] = "";
                }

                if(isset($monsterArray['sections'])){
                    foreach ($monsterArray['sections'] as $section) {
                        if(key($section) == "body"){
                            $monsterArray['description'] .= " ".$section['body'];
                        }
                    }
                }

                $monsterArray['description'] = str_replace('<p>', "\n", $monsterArray['description']);
                $monsterArray['description'] = str_replace('</p>', "\n", $monsterArray['description']);



                $model->senses = isset($monsterArray['senses']) ? $monsterArray['senses'] : "";
                $model->initiative = isset($monsterArray['init']) ? $monsterArray['init'] : "";
                $model->description = isset($monsterArray['description']) ? $monsterArray['description'] : "";
                $model->damage_reduction = isset($monsterArray['dr']) ? $monsterArray['dr'] : "";
                $model->spell_resist = isset($monsterArray['sr']) ? $monsterArray['sr'] : "";
                $model->damage_resistances = isset($monsterArray['resist']) ? $monsterArray['resist'] : "";
                $model->CMB = isset($monsterArray['cmb']) ? $monsterArray['cmb'] : "";
                $model->CMD = isset($monsterArray['cmd']) ? $monsterArray['cmd'] : "";
                $model->base_attack = $monsterArray['base_attack'];
                $model->aura = isset($monsterArray['aura']) ? $monsterArray['aura'] : "";
                $model->special_attacks = isset($monsterArray['special_attacks']) ? $monsterArray['special_attacks'] : "";
                $model->spells_prepared = isset($spellsPrepared) ? $spellsPrepared : "";
                $model->spell_like_abilities = isset($spellLikeAbilities) ? $spellLikeAbilities : "";
                $model->save(); 

                if(isset($monsterArray['sections'])){
                    foreach ($monsterArray['sections'] as $section) {

                        if(isset($section['subtype']) && $section['subtype'] == "special_abilities" ){
                            foreach ($section['sections'] as $ability) {
                                
                                if(!isset($ability['name'])){
                                    $prevAbility = MonsterAbility::find($newAbility->id);
                                    $prevAbility->description .= isset($ability['body']) ? $ability['body'] : ""; 
                                    $prevAbility->save();
                                }else{
                                    $newAbility = new MonsterAbility;
                                    $newAbility->name = $ability['name'];
                                    $newAbility->description = isset($ability['body']) ? $ability['body'] : "";
                                    $newAbility->type = isset($monsterArray['ability_types']) ? implode($ability['ability_types'], ',') : "";
                                    $newAbility->monster_id = $model->id;
                                    $newAbility->save();                                    
                                }

 

                            }
                        }
                    }
                }             
            }
        }
*/

	    return true;
    }
}
