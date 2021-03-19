<?php


namespace App\Utilities\PostFilters;


use App\Utilities\FilterInterface;
use App\Utilities\QueryFilter;

class User extends QueryFilter implements FilterInterface
{
    public function handle($value): void
    {
        $this->query->where('user_id', $value);
    }
}
