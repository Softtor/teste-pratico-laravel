<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryContract;
use App\Models\Category;
use App\Repositories\Repository;

class CategoryRepository extends Repository implements CategoryRepositoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
