<?php

namespace Modules\Catalog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Catalog\Entities\Nationality;

class SeedNationalitiesTableSeeder extends Seeder
{
    private $nationalities = [
           ['en' => 'Indian','ar' => 'الهندية'],
           ['en' => 'Pakistani','ar' => 'الباكستانية'],
           ['en' => 'philippines','ar' => 'الفلبينية'],
           ['en' => 'nepali','ar' => 'النيبالية'],
           ['en' => 'sri lanka','ar' => 'السيلانية'],
           ['en' => 'ethiopia','ar' => 'الاثيوبية'],
           ['en' => 'egyptian','ar' => 'المصرية'],
           ['en' => 'syria','ar' => 'سوريا'],
           ['en' => 'jordan','ar' => 'الاردن'],
           ['en' => 'lebanon','ar' => 'لبنان'],
           ['en' => 'bangladesh','ar' => 'بنغلاديش'],
           ['en' => 'africa','ar' => 'افريقيا'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->nationalities as $nationality){
            Nationality::create(['title' => $nationality,'status' => 1]);
        }
    }
}
