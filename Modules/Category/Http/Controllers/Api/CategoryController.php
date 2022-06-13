<?php

namespace Modules\Category\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\Category\Repositories\Api\CategoryRepository as Category;
use Modules\App\Http\Controllers\Api\ApiController;

class CategoryController extends ApiController
{
    private $categories;
    function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function categories(Request $request)
    {
        $categories =  $this->categories->getAll($request);

        return $this->response(CategoryResource::collection($categories));
    }
}
