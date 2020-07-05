<?php

namespace App\Controllers;

use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Класс инициализации данных приложения
 *
 * @package App\Controllers
 */
class InitializeController {
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
     * Создание n-го количества случайных товаров
     *
     * @GET /init/
     *
     * @return JsonResponse
     */
    public function init()
    {
        $products = $this->productService->generate(20);

        return new JsonResponse(['status' => 'ok', 'message' => "Создано товаров: "  . count($products), 'products' => $products]);
    }
}
