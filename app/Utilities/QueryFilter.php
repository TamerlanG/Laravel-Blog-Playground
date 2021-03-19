<?php


namespace App\Utilities;


class QueryFilter
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
}
