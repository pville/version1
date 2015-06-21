<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        $this->call('EventCategorySeeder');
        $this->call('OrganizationCategorySeeder');
    }
}

class EventCategorySeeder extends Seeder {

    public function run()
    {
        DB::table('event_category')->delete();


        DB::table('event_category')->insert(array('type' => 'Clothing'));
        DB::table('event_category')->insert(array('type' => 'Walk / Run'));
        DB::table('event_category')->insert(array('type' => 'Event Setup'));
        DB::table('event_category')->insert(array('type' => 'Food Drive'));
        DB::table('event_category')->insert(array('type' => 'Supply Drive'));
        DB::table('event_category')->insert(array('type' => 'Blood Drive'));
        DB::table('event_category')->insert(array('type' => 'Soup Kitcken'));
        DB::table('event_category')->insert(array('type' => 'Clean Up'));
        DB::table('event_category')->insert(array('type' => 'Hospital'));
        DB::table('event_category')->insert(array('type' => 'Camp'));
        DB::table('event_category')->insert(array('type' => 'Other'));
    }

}


class OrganizationCategorySeeder extends Seeder {

    public function run()
    {
        DB::table('organization_category')->delete();


        DB::table('organization_category')->insert(array('type' => 'Animals'));
        DB::table('organization_category')->insert(array('type' => 'Arts,Culture,Humanities'));
        DB::table('organization_category')->insert(array('type' => 'Community Development'));
        DB::table('organization_category')->insert(array('type' => 'Education'));
        DB::table('organization_category')->insert(array('type' => 'Environment'));
        DB::table('organization_category')->insert(array('type' => 'Health'));
        DB::table('organization_category')->insert(array('type' => 'Human+Civil Rights'));
        DB::table('organization_category')->insert(array('type' => 'Humans Services'));
        DB::table('organization_category')->insert(array('type' => 'International'));
        DB::table('organization_category')->insert(array('type' => 'Religion'));

    }

}
