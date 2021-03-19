<?php

namespace App\Utilities;

interface FilterInterface
{
    public function handle($value): void;
}
