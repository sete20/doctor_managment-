<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{

    /**
     * @param null $category
     */
    public function run($category = null)
    {
        $count = 0;

        for ($i = 0; $i < 5; $i++) {
            $cat = Category::create([
                'status' => 1,
                'category_id' => $category
            ]);

            $cat->translateOrNew('en')->title = 'category -'. $cat->id;
            $cat->translateOrNew('ar')->title = 'قسم -'. $cat->id;
            $cat->save();

//            if (rand(0, 1) == 1 && $count <= 2 && !$category) {
//                $this->run($cat->id);
//                $count ++;
//            }
        }
    }
}
