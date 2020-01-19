<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity_types = [
            [ "name" => "Public Institution", "icon" => "university", "entity_size" => TRUE, "turn_over" => FALSE, "balance_sheet" => FALSE, "revenue" => FALSE , "employees" => FALSE, "students" => FALSE, "business_type" => FALSE ],
            [ "name" => "NGO", "icon" => "users", "entity_size" => TRUE, "turn_over" => TRUE, "balance_sheet" => FALSE, "revenue" => FALSE , "employees" => FALSE, "students" => FALSE, "business_type" => FALSE ],
            [ "name" => "University", "icon" => "graduation cap", "entity_size" => TRUE, "turn_over" => FALSE, "balance_sheet" => FALSE, "revenue" => FALSE , "employees" => FALSE, "students" => TRUE, "business_type" => FALSE ],
            [ "name" => "Financial Institution", "icon" => "money bill alternate", "entity_size" => FALSE, "turn_over" => FALSE, "balance_sheet" => TRUE, "revenue" => TRUE , "employees" => TRUE, "students" => FALSE, "business_type" => FALSE ],
            [ "name" => "Business", "icon" => "briefcase", "entity_size" => TRUE, "turn_over" => TRUE, "balance_sheet" => FALSE, "revenue" => FALSE , "employees" => FALSE, "students" => FALSE, "business_type" => TRUE ],
            [ "name" => "Think Tank", "icon" => "lightbulb", "entity_size" => TRUE, "turn_over" => TRUE, "balance_sheet" => FALSE, "revenue" => FALSE , "employees" => FALSE, "students" => FALSE, "business_type" => FALSE ],
        ];
        DB::table('entity_types')->insert($entity_types);
    }
}
