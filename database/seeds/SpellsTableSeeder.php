<?php

use Illuminate\Database\Seeder;
use App\Spell;
use App\SpellTag;

class SpellsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //start D&D
        $jsondata = file_get_contents(base_path('database/data/spells5e.json'));

        $data = json_decode($jsondata, true);

        foreach ($data as $key) {


            if($key['ritual'] == "no"){
                $key['ritual'] = 0;
            }else{
                $key['ritual'] = 1;
            }

            if($key['concentration'] == "no"){
                $key['concentration'] = 0;
            }else{
                $key['concentration'] = 1;
            }

            if($key['level'] == "Cantrip"){
                $key['level'] = 0;
            }else{
                $key['level'] = substr($key['level'], 0, 1);
            }

            $classes = explode(',', $key['class']);
            $tags = array();
            
            $levelText = "";
            foreach ($classes as $class) {
                $tags[] = $class." ".$key['level'];
                $levelText .= $class.": ".$key['level'];
            }

            $components = explode(',', $key['components']);
            
            $spell = new Spell;

            foreach ($components as $component) {
                trim($component);
                if($component == 'V'){
                    $spell->verbal = 1;
                }elseif ($component == ' S') {
                    $spell->somatic = 1;
                }elseif ($component == ' M') {
                    $spell->material = 1;
                }
            }


            $spell->name = isset($key['name']) ? $key['name'] : "";
            $spell->ritual = isset($key['ritual']) ? $key['ritual'] : "";
            $spell->level = $levelText;
            $spell->school = isset($key['school']) ? $key['school'] : "";
            $spell->materials = isset($key['material']) ? $key['material'] : "";
            $spell->casting_time = isset($key['casting_time']) ? $key['casting_time'] : "";
            $spell->range = isset($key['range']) ? $key['range'] : "";
            $spell->components = isset($key['components']) ? $key['components'] : "";
            $spell->duration = isset($key['duration']) ? $key['duration'] : "";
            $spell->description = isset($key['desc']) ? $key['desc'] : "";
            $spell->higher_levels = isset($key['higher_level']) ? $key['higher_level'] : "";
            $spell->archetype = isset($key['archetype']) ? $key['archetype'] : "";
            $spell->circle = isset($key['circles']) ? $key['circles'] : "";
            $spell->source = "5E SRD";
            $spell->system = "5E";
            $spell->save(); 

            foreach ($tags as $tag) {

                //Check if it already exists first

                $newTag = new SpellTag;
                $newTag->spell_id = $spell->id;
                $newTag->tag = trim($tag);
                $newTag->save();
            }           
        }
        //end D&D

    	/*/Start Pathfinder
        $files = glob(base_path('public/spells/*.json'));

        foreach ($files as $file) {

            $jsondata = file_get_contents($file);

            $spellArray = json_decode($jsondata, true);
                
            $spell = new Spell;
            
            $tags = array();
            foreach ($spellArray['levels'] as $level){
                $tags[] = $level['class']." ".$level['level'];
            }

            $materials = array();

            if(isset($spellArray['components'])){
                 foreach ($spellArray['components'] as $component) {

                    if($component['type'] == 'V'){
                        $spell->verbal = 1;
                    }elseif ($component['type'] == 'S') {
                        $spell->somatic = 1;
                    }elseif ($component['type'] == 'M') {
                        $spell->material = 1;
                    }elseif ($component['type'] == 'F') {
                        $spell->focus = 1;
                    }elseif ($component['type'] == 'DF') {
                        $spell->divine_focus = 1;
                    }
                    
                    if (isset($component['text'])) {
                        //set materials text
                        $materials[] = $component['text'];
                    }
                }               
            }


            if(isset($spellArray['spell_resistance']) && $spellArray['spell_resistance'] == "yes"){
                $spell_resistance = 1;
            }else{
                $spell_resistance = 0;
            }
              

            $spell->name = isset($spellArray['name']) ? $spellArray['name'] : "";
            $spell->description = isset($spellArray['body']) ? $spellArray['body'] : "";
            $spell->short_description = isset($spellArray['description']) ? $spellArray['description'] : "";
            $spell->materials = implode($materials,',');
            $spell->source = $spellArray['source'];
            $spell->system = 'Pathfinder';
            $spell->spell_resist = $spell_resistance;
            $spell->casting_time = isset($spellArray['casting_time']) ? $spellArray['casting_time'] : "";
            $spell->level = isset($spellArray['level_text']) ? $spellArray['level_text'] : "";
            $spell->descriptor = isset($spellArray['descriptor_text']) ? $spellArray['descriptor_text'] : "";
            $spell->range = isset($spellArray['range']) ? $spellArray['range'] : "";
            $spell->targets = isset($spellArray['effects'][0]['text']) ? $spellArray['effects'][0]['text'] : "";
            $spell->duration = isset($spellArray['duration']) ? $spellArray['duration'] : "";
            $spell->subschool = isset($spellArray['subschool_text']) ? $spellArray['subschool_text'] : "";
            $spell->type = isset($spellArray['type']) ? $spellArray['type'] : "";
            $spell->school = isset($spellArray['school']) ? $spellArray['school'] : "";
            $spell->saving_throw = isset($spellArray['saving_throw']) ? $spellArray['saving_throw'] : "";
            $spell->components = isset($spellArray['component_text']) ? $spellArray['component_text'] : "";
            $spell->save();

            foreach ($tags as $tag) {

                //Check if it already exists first

                $newTag = new SpellTag;
                $newTag->spell_id = $spell->id;
                $newTag->tag = $tag;
                $newTag->save();
            }       
    
        }

        $rows = array_map('str_getcsv', file('http://copilot.app/spellspf.csv'));
        $header = array_shift($rows);
        $csv = array();
        foreach ($rows as $row) {
          $csv[] = array_combine($header, $row);
        }        

        foreach ($csv as $spellInfo) {
            $model = Spell::where('system', "Pathfinder")->where('name', $spellInfo['name'])->first();

            if($model){
                $model->domain = $spellInfo['domain'];
                $model->patron = $spellInfo['patron'];
                $model->bloodline = $spellInfo['bloodline'];
                $model->save();
            }
        }
        //end Pathfinder*/
    }
}
