<?php

namespace App\Controllers;

use App\Entities\Order;
use App\Entities\Payment;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController {
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
     * Оплата заказа
     *
     * @POST /payment/create/
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        /** @var Order $order */
        $order = $this->orderService->getOrder($request->request->get('orderId'));

        /** @var Payment $payment */
        $payment = $this->paymentService->createPayment($order);

        if ($payment && $this->paymentService->sendPayment($payment)) {
            return new JsonResponse(['status' => 'ok', 'payment_id' => $payment->getId()]);
        }

        return new JsonResponse(['status' => 'fail', ], JsonResponse::HTTP_BAD_REQUEST);
    }
}