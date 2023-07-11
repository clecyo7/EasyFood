<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{
    private $categoryRepository;
    private $tenantReposity;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        TenantRepositoryInterface $tenantReposity
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->tenantReposity = $tenantReposity;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantReposity->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryUrl(string $url)
    {
        return $this->categoryRepository->getCategoryUrl($url);
    }


}
