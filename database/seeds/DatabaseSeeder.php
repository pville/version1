<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

//use database\seeds\GroupTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('GroupTypeSeeder');
        $this->call('GroupSeeder');
        $this->call('VolunteerTypeSeeder');
        $this->call('StatesSeeder');
    }
}
