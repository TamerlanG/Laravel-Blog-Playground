<?php


namespace App\Utilities\PostFilters;


use App\Utilities\FilterInterface;
use App\Utilities\QueryFilter;

class Title extends QueryFilter implements FilterInterface
{
    public function handle($value): void
    {
        $this->query->where('title', $value);
    }
}
