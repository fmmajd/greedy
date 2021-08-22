<?php

namespace App\Services\Populators;

interface JsonPopulator
{
    public function populateFromJson(array $json);
}
