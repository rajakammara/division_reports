<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\mandalmaster;
use Illuminate\Support\Facades\DB;
class MandalMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear existing data
        DB::table('mandalmasters')->delete();

        $mandals = [
            ['id'=>1,'mandal'=>'ANANTAPUR-U','division'=>'ATP','new_mandal'=>'ANANTAPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>2,'mandal'=>'ANANTHAPURAM RURAL-R','division'=>'ATP','new_mandal'=>'ANANTAPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>3,'mandal'=>'ANANTHAPURAM RURAL','division'=>'ATP','new_mandal'=>'ANANTAPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>4,'mandal'=>'ATMAKUR','division'=>'ATP','new_mandal'=>'ATMAKUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>5,'mandal'=>'ATMAKUR-R','division'=>'ATP','new_mandal'=>'ATMAKUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>6,'mandal'=>'BUKKARAYASAMUDRAM-R','division'=>'ATP','new_mandal'=>'B.K.Samudram','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>7,'mandal'=>'BUKKARAYASAMUDRAM','division'=>'ATP','new_mandal'=>'B.K.Samudram','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>8,'mandal'=>'GARLADINNE','division'=>'ATP','new_mandal'=>'GARLADINNE','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>9,'mandal'=>'GARLADINNE-R','division'=>'ATP','new_mandal'=>'GARLADINNE','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>10,'mandal'=>'NARPALA','division'=>'ATP','new_mandal'=>'NARPALA','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>11,'mandal'=>'NARPALA-R','division'=>'ATP','new_mandal'=>'NARPALA','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>12,'mandal'=>'PUTLUR-R','division'=>'ATP','new_mandal'=>'PUTLUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['id'=>13,'mandal'=>'PUTLUR','division'=>'ATP','new_mandal'=>'PUTLUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
             ['id'=>14,'mandal'=>'RAPTHADU-R','division'=>'ATP','new_mandal'=>'RAPTHADU','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
             ['id'=>15,'mandal'=>'RAPTHADU','division'=>'ATP','new_mandal'=>'RAPTHADU','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
             ['id'=>16,'mandal'=>'SINGANAMALA-R','division'=>'ATP','new_mandal'=>'SINGANAMALA','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
             ['id'=>17,'mandal'=>'SINGANAMALA','division'=>'ATP','new_mandal'=>'SINGANAMALA','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>18,'mandal'=>'TADIPARTRI','division'=>'ATP','new_mandal'=>'TADIPATRI','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>19,'mandal'=>'TADIPATRI','division'=>'ATP','new_mandal'=>'TADIPATRI','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>20,'mandal'=>'TADIPATRI-U','division'=>'ATP','new_mandal'=>'TADIPATRI','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>21,'mandal'=>'TADIPARTRI-R','division'=>'ATP','new_mandal'=>'TADIPATRI','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>22,'mandal'=>'PEDDAPAPPUR-R','division'=>'ATP','new_mandal'=>'PEDDAPAPPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>23,'mandal'=>'PEDDAPAPPUR','division'=>'ATP','new_mandal'=>'PEDDAPAPPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>24,'mandal'=>'YELLANUR-R','division'=>'ATP','new_mandal'=>'YELLANUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>25,'mandal'=>'YELLANUR','division'=>'ATP','new_mandal'=>'YELLANUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>26,'mandal'=>'KUDERU','division'=>'ATP','new_mandal'=>'KUDERU','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
              ['id'=>27,'mandal'=>'KUDERU-R','division'=>'ATP','new_mandal'=>'KUDERU','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
                ['id'=>28,'mandal'=>'ANANTAPUR','division'=>'ATP','new_mandal'=>'ANANTAPUR','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
        ];
        foreach ($mandals as $mandal) {
            mandalmaster::create($mandal);
        }
    }
}
