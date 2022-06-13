<?php

namespace Modules\Category\Repositories\Api;

use Modules\Category\Entities\Category;

class CategoryRepository
{
    function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getPaginationCategories($request)
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $categories = $this->category->where('type', 1)->where(function ($q) use ($request) {

            if ($request->id):
                $q->where('id', $request->id);
            else:
                if ($request->search):

                    $q->whereHas('translations', function ($q) use ($request) {
                        $q->where('title', 'LIKE', '%' . $request->search . '%');
                    });

                endif;

            endif;
        })->with([
            'children' => function ($query) {
                $query->active();
            }, 'courses.category'
        ])->mainCategories()->active()->orderBy('id', 'DESC')->paginate($paginate);

        return $categories;
    }

    public function getAll($request)
    {
        $categories = $this->category->where('type', 1)->where(function ($q) use ($request) {

            if ($request->id):
                $q->where('id', $request->id);
            else:
                if ($request->search):

                    $q->whereHas('translations', function ($q) use ($request) {
                        $q->where('title', 'LIKE', '%' . $request->search . '%');
                    });

                endif;

            endif;
        })->with([
            'children' => function ($query) {
                $query->active();
            }, 'courses.category'
        ])->mainCategories()->active()->orderBy('id', 'DESC')->get();

        return $categories;
    }
}
