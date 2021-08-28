<?php

namespace App\Services\Strategies;

interface Strategy
{
    public function decide(): void;
}
