<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = [
            ["name" => "Advertisment", "icon" => "info"],
            ["name" => "Advocacy", "icon" => "info"],
            ["name" => "Agriculture", "icon" => "info"],
            ["name" => "Air & Aviation", "icon" => "info"],
            ["name" => "Anti-Corruption", "icon" => "info"],
            ["name" => "Arabic Content Creation & Localization", "icon" => "info"],
            ["name" => "Architecture", "icon" => "info"],
            ["name" => "Automobile Industry", "icon" => "info"],
            ["name" => "Banking", "icon" => "info"],
            ["name" => "Blockchain Technologies", "icon" => "info"],
            ["name" => "Business Consultancy", "icon" => "info"],
            ["name" => "Communications & (Social) Media", "icon" => "info"],
            ["name" => "Conflict & Mediation", "icon" => "info"],
            ["name" => "Construction", "icon" => "info"],
            ["name" => "Corporate Social Responsibility", "icon" => "info"],
            ["name" => "Creative Industries", "icon" => "info"],
            ["name" => "Culture", "icon" => "info"],
            ["name" => "Cybersecurity", "icon" => "info"],
            ["name" => "Data Science", "icon" => "info"],
            ["name" => "Decentralization & Local Development", "icon" => "info"],
            ["name" => "Democratization & Human Rights", "icon" => "info"],
            ["name" => "Digital Marketing", "icon" => "info"],
            ["name" => "Digital Transformation", "icon" => "info"],
            ["name" => "E-Commerce", "icon" => "info"],
            ["name" => "Education", "icon" => "info"],
            ["name" => "Electrical Engineering", "icon" => "info"],
            ["name" => "Energy and Energy Efficiency", "icon" => "info"],
            ["name" => "Environment & environmental protection", "icon" => "info"],
            ["name" => "Events Organization", "icon" => "info"],
            ["name" => "Finance & Accounting and Auditing", "icon" => "info"],
            ["name" => "Fintech", "icon" => "info"],
            ["name" => "Fisheries & Aquaculture", "icon" => "info"],
            ["name" => "Food Processing & Safety", "icon" => "info"],
            ["name" => "Food Security", "icon" => "info"],
            ["name" => "Fundraising", "icon" => "info"],
            ["name" => "Furniture & Office Supplies", "icon" => "info"],
            ["name" => "Gender & Women Empowerment", "icon" => "info"],
            ["name" => "Graphic Design", "icon" => "info"],
            ["name" => "Handicrafts and Accessories", "icon" => "info"],
            ["name" => "Health and Healthtech", "icon" => "info"],
            ["name" => "Home Textiles", "icon" => "info"],
            ["name" => "Hotels", "icon" => "info"],
            ["name" => "Human Resources", "icon" => "info"],
            ["name" => "Humanitarian Aid & Emergency", "icon" => "info"],
            ["name" => "Industrial Design", "icon" => "info"],
            ["name" => "Information & Communication Technology", "icon" => "info"],
            ["name" => "Institutional Development", "icon" => "info"],
            ["name" => "Laboratory & Measurement", "icon" => "info"],
            ["name" => "Labour Market & Employment", "icon" => "info"],
            ["name" => "Law & legal reformnd Legaltech", "icon" => "info"],
            ["name" => "Leather Industry", "icon" => "info"],
            ["name" => "Livestock", "icon" => "info"],
            ["name" => "Logistics", "icon" => "info"],
            ["name" => "Marketing Consultancy", "icon" => "info"],
            ["name" => "Mechanical Engineering", "icon" => "info"],
            ["name" => "Medical Appliances", "icon" => "info"],
            ["name" => "Micro-finance", "icon" => "info"],
            ["name" => "Mining", "icon" => "info"],
            ["name" => "Monitoring & Evaluation", "icon" => "info"],
            ["name" => "Pharmaceutical", "icon" => "info"],
            ["name" => "Poverty Reduction", "icon" => "info"],
            ["name" => "Printing", "icon" => "info"],
            ["name" => "Procurement", "icon" => "info"],
            ["name" => "Programme & Resource Management", "icon" => "info"],
            ["name" => "Public Administration", "icon" => "info"],
            ["name" => "Refrigeration", "icon" => "info"],
            ["name" => "Regional Integration", "icon" => "info"],
            ["name" => "Renewable Energy", "icon" => "info"],
            ["name" => "Research", "icon" => "info"],
            ["name" => "Restauration", "icon" => "info"],
            ["name" => "Risk Management (incl. Insurance)", "icon" => "info"],
            ["name" => "Rural Development", "icon" => "info"],
            ["name" => "Science & Innovation", "icon" => "info"],
            ["name" => "Security Services", "icon" => "info"],
            ["name" => "SME & Private Sector Development", "icon" => "info"],
            ["name" => "Social Development", "icon" => "info"],
            ["name" => "Sports and Leisure", "icon" => "info"],
            ["name" => "Standards & Consumer Protection", "icon" => "info"],
            ["name" => "Statistics", "icon" => "info"],
            ["name" => "Telecommunications", "icon" => "info"],
            ["name" => "Textiles and Ready Made Garments", "icon" => "info"],
            ["name" => "Tourism", "icon" => "info"],
            ["name" => "Trade & Services", "icon" => "info"],
            ["name" => "Training", "icon" => "info"],
            ["name" => "Transportation & Mobility", "icon" => "info"],
            ["name" => "TVET", "icon" => "info"],
            ["name" => "Urban Development", "icon" => "info"],
            ["name" => "Water & Sanitation", "icon" => "info"],
            ["name" => "Wellness and Cosmetics", "icon" => "info"],
            ["name" => "Youth Employment and Empowerment", "icon" => "info"]
        ];
        DB::table('sectors')->insert($sectors);
    }
}
