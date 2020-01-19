<?php

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
            [ "name" => "Snapchat", "url_regex" => "snapchat.com", "icon" => "snapchat"],
            [ "name" => "Telegram", "url_regex" => "", "icon" => "telegram"],
            [ "name" => "Skype", "url_regex" => "", "icon" => "skype"],
            [ "name" => "Github", "url_regex" => "github.com", "icon" => "github"],
            [ "name" => "Linkedin", "url_regex" => "linkedin.com", "icon" => "linkedin"],
            [ "name" => "YouTube", "url_regex" => "youtube.com", "icon" => "youtube"],
            [ "name" => "Website", "url_regex" => "", "icon" => "globe"]
        ];
        DB::table('supported_links')->insert($supported_links);
    }
}
