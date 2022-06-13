<?php

namespace Modules\Category\ViewComposers\Dashboard;

use Modules\Category\Repositories\Dashboard\CategoryRepository as Category;
use Illuminate\View\View;
use Cache;

class CountCategoryComposer
{
    public $countCategories = [];

    public function __construct(Category $category)
    {
        $this->countCategories =  $category->countCategories();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countCategories' , $this->countCategories);
    }
}
