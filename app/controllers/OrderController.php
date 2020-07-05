<?php

namespace App\Controllers;

use App\Entities\Order;
use App\Entities\Product;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController {
    /** @var ProductService */
    protected $productService;

    /** @var OrderService */
    protected $orderService;

    /** @var PaymentService */
    protected $paymentService;

    public function __construct(ProductService $productService, OrderService $orderService, PaymentService $paymentService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    /**
     * Создание заказа
     *
     * @POST /order/create/
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createOrder(Request $request)
    {
        $ids = $request->request->get('products');

        /** @var Product[] $products */
        $products = $this->productService->getProducts($ids);

        /** @var Order $order */
        $order = $this->orderService->createOrder($products);

        return new JsonResponse(['status' => 'ok', 'id' => $order->getId()]);
    }
}