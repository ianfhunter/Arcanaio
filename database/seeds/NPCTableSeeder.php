<?php

use Illuminate\Database\Seeder;
use App\NPC;

class NPCTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = glob(base_path('public/NPCs/*.json'));

        foreach ($files as $file) {

            $jsondata = file_get_contents($file);

            $npcArray = json_decode($jsondata, true);

            $crFraction = isset($npcArray['cr']) ? $npcArray['cr'] : "";
            $CR = eval('return '.$crFraction.';');

            if(isset($npcArray['super_race'])){
                $race = substr($npcArray['super_race'], 0, strpos($npcArray['super_race'], ' '));
                $classes = trim(substr($npcArray['super_race'], strlen($race)));
            }

            $acArray = explode(',', $npcArray['ac']);
            $ac = $acArray['0'];
            $acTouch = substr($acArray['1'], 7);
            $acFlat = trim(substr($acArray['2'], 12, strpos(trim($npcArray['ac']), ' ')));

            $string = $npcArray['ac'];
            $start  = strpos($string, '(');
            $end    = strpos($string, ')', $start + 1);
            $length = $end - $start;
            $acStats = substr($string, $start + 1, $length - 1);

            $hpArray = explode(' ',$npcArray['hp']);
            $HP = $hpArray[0];
            $HD = $hpArray[1];

            $roleplaying = "";

            if(isset($npcArray['sections'])){
                foreach ($npcArray['sections'] as $section) {
                    if (isset($section['name']) && $section['name'] == "Tactics") {
                        $tactics = $section['body'];
                    }elseif(isset($section['body'])){
                        $roleplaying .= $section['body'];
                    }
                }
            }

            if(isset($npcArray['boon'])){
                $roleplaying .= $npcArray['boon'];
            }

            $npc = new NPC;
            $npc->name = isset($npcArray['name']) ? $npcArray['name'] : "";
            $npc->CR = $CR;
            $npc->XP = isset($npcArray['xp']) ? str_replace(array('.', ','), '' , $npcArray['xp']) : "";
            $npc->race = isset($race) ? $race : "";
            $npc->classes = isset($classes) ? $classes : "";
            $npc->alignment = isset($npcArray['alignment']) ? $npcArray['alignment'] : "";
            $npc->size = isset($npcArray['size']) ? $npcArray['size'] : "";
            $npc->type = isset($npcArray['creature_type']) ? $npcArray['creature_type'] : "";
            $npc->AC = isset($ac) ? $ac : "";
            $npc->AC_touch = isset($acTouch) ? $acTouch : "";
            $npc->AC_flat = isset($acFlat) ? $acFlat : "";
            $npc->AC_stats = isset($acStats) ? $acStats : "";
            $npc->HP = isset($HP) ? $HP : "";
            $npc->HD = isset($HD) ? $HD : "";
            $npc->fort = isset($npcArray['fortitude']) ? $npcArray['fortitude'] : "";
            $npc->ref = isset($npcArray['reflex']) ? $npcArray['reflex'] : "";
            $npc->will = isset($npcArray['will']) ? $npcArray['will'] : "";
            $npc->CMB = isset($npcArray['cmb']) ? $npcArray['cmb'] : "";
            $npc->CMD = isset($npcArray['cmd']) ? $npcArray['cmd'] : "";
            $npc->initiative = isset($npcArray['init']) ? $npcArray['init'] : "";
            $npc->melee = isset($npcArray['melee']) ? $npcArray['melee'] : "";
            $npc->ranged = isset($npcArray['ranged']) ? $npcArray['ranged'] : "";
            $npc->base_attack = isset($npcArray['base_attack']) ? $npcArray['base_attack'] : "";
            $npc->special_attacks = isset($npcArray['special_attacks']) ? $npcArray['special_attacks'] : "";
            $npc->spells_prepared = isset($npcArray['spells']) ? json_encode($npcArray['spells']) : "";
            $npc->str = isset($npcArray['strength']) ? $npcArray['strength'] : "";
            $npc->dex = isset($npcArray['dexterity']) ? $npcArray['dexterity'] : "";
            $npc->con = isset($npcArray['constitution']) ? $npcArray['constitution'] : "";
            $npc->int = isset($npcArray['intelligence']) ? $npcArray['intelligence'] : "";
            $npc->wis = isset($npcArray['wisdom']) ? $npcArray['wisdom'] : "";
            $npc->cha = isset($npcArray['charisma']) ? $npcArray['charisma'] : "";
            $npc->feats = isset($npcArray['feats']) ? $npcArray['feats'] : "";
            $npc->skills = isset($npcArray['skills']) ? $npcArray['skills'] : "";
            $npc->senses = isset($npcArray['senses']) ? $npcArray['senses'] : "";
            $npc->languages = isset($npcArray['languages']) ? $npcArray['languages'] : "";
            $npc->sq = isset($npcArray['special_qualities']) ? $npcArray['special_qualities'] : "";
            $npc->immunities = isset($npcArray['immune']) ? $npcArray['immune'] : "";
            $npc->defensive_abilities = isset($npcArray['defensive_abilities']) ? $npcArray['defensive_abilities'] : "";
            $npc->damage_reduction = isset($npcArray['dr']) ? $npcArray['dr'] : "";
            $npc->spell_resist = isset($npcArray['sr']) ? $npcArray['sr'] : "";
            $npc->gear = isset($npcArray['combat_gear']) ? $npcArray['combat_gear'] : "";
            $npc->gear = isset($npcArray['combat_gear']) ? $npcArray['combat_gear'] : "";
            $npc->tactics = isset($tactics) ? $tactics : "";
            $npc->roleplaying = isset($roleplaying) ? $roleplaying : "";
            $npc->speed = isset($npcArray['speed']) ? $npcArray['speed'] : "";
            $npc->source = "NPC Codex";
            $npc->system = 'Pathfinder';
            $npc->save();         
        }

    }
}
