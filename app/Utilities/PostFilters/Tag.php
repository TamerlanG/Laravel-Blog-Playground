<?php


namespace App\Utilities\PostFilters;


use App\Utilities\FilterInterface;
use App\Utilities\QueryFilter;

class Tag extends QueryFilter implements FilterInterface
{
    public function handle($value): void
    {
        $this->query->whereHas('tags', function ($q) use ($value) {
            return $q->where('tag_id', $value);
        });
    }
}
