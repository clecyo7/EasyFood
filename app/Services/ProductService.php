<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    private $productRepository;
    private $tenantRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        TenantRepositoryInterface $tenantRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {

        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getproductsByTenantId($tenant->id, $categories);
    }

    public function getProductByUuid(string $uuid)
    {
        return $this->productRepository->getProductByUuid($uuid);
    }


}
