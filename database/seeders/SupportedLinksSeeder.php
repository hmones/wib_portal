<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportedLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supported_links = [
            [ "name" => "Facebook", "url_regex" => "facebook.com", "icon" => "facebook"],
            [ "name" => "Twitter", "url_regex" => "twitter.com", "icon" => "twitter"],
            [ "name" => "Instagram", "url_regex" => "instagram.com", "icon" => "instagram"],
            [ "name" => "Linkedin", "url_regex" => "linkedin.com", "icon" => "linkedin"],
            [ "name" => "Website", "url_regex" => "", "icon" => "globe"],
        ];
        DB::table('supported_links')->insert($supported_links);
    }
}
