<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuid(string $uuid);

    public function getCategoriesByTenantId(string $uuid);

    public function getCategoryByUuid(string $uuid);

    //public function getTenantByUuid(string $uuid);
}
