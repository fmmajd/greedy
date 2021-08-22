<?php

namespace App\Repositories\Contracts;

interface ArticlesRepositoryInterface
{
    public function truncate(): void;

    public function createBy(int $refId, string $name, int $stock): void;
}
