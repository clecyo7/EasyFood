<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Order;
use App\Models\Tenant;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = ''
    ) {
        $data = [
            'tenant_id' => $tenantId,
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if ($tableId) $data['table_id'] = $tableId;

        $order = $this->entity->create($data);

        return $order;
    }

     /**
     * cadastrar pedido
     */

    public function registerProductsOrder(int $orderId, array $products)
    {

        $order = $this->entity->find($orderId);
        $orderProducts = [];

        foreach($products as $product) {
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price'],
            ];
        }

        $order->products()->attach($orderProducts);

        // $orderProducts = [];
        // foreach($products as $product) {
        //     array_push($orderProducts, [
        //         'order_id' => $orderId,
        //         'product_id' => $product['id'],
        //         'qty' => $product['qty'],
        //         'price' => $product['price'],
        //     ]);
        // }

        // DB::table('order_product')->insert($orderProducts);

    }

    public function getOrderByIdentify(string $identify)
    {
      //  dd($identify);
        return $this->entity
            ->where('identify', $identify)
            ->first();
    }

    public function getClientIdByOrder(int $idClient)
    {

        return $this->entity->where('client_id', $idClient)->paginate();
    }

}
