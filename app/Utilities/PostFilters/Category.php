<?php


namespace App\Utilities\PostFilters;


use App\Utilities\FilterInterface;
use App\Utilities\QueryFilter;

class Category extends QueryFilter implements FilterInterface
{
    public function handle($value): void
    {
        $this->query->where('category_id', $value);
    }
}
