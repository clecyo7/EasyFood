<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $repository;

    public function __construct(Order $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        return view('admin.pages.orders.index');
    }
}
