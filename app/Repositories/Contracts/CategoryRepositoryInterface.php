<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function gategoriesByTenantUuid(string $uuid);

    public function getCategoriesByTenantId(string $uuid);

    public function getCategoryUrl(string $url);

    //public function getTenantByUuid(string $uuid);
}