<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamSeeder extends Seeder
{

    public function run()
    {
        factory(Team::class)->create(['first_name' => 'Santiago','last_name'=>'Ramon y Cajal', 'position' => 'Director', 'photo'=>'photo.jpg']);
        factory(Team::class,4)->create();
    }
}
