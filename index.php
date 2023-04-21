<?php

use \Simplia\Integration\Context;
use \Simplia\Api\Entity\OrderApiEntity;
use \Simplia\Integration\Event\Order\NewOrderEvent;

return static function (Context $context, NewOrderEvent $orderEvent) {

    $order = $context->getApi()->getOrdersEndpoint()->get(
        $orderEvent->getId(),
        OrderApiEntity::createFieldConfig()
            ->withDateCreated()
    );

    if (!$order) {
        throw new RuntimeException('Order not found');
    }

    $context->getClient()->request('POST', 'https://example.org/new-order', [
        'json' => [
            'code' => $order->getId(),
            'date' => $order->getDateCreated(),
        ],
    ]);
};
