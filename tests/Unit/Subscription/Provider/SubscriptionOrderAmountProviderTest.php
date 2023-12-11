<?php

namespace Mollie\Tests\Unit\Subscription\Provider;

use Mollie\Subscription\DTO\SubscriptionOrderAmountProviderData;
use Mollie\Subscription\Exception\CouldNotProvideSubscriptionOrderAmount;
use Mollie\Subscription\Exception\ExceptionCode;
use Mollie\Subscription\Provider\SubscriptionCarrierDeliveryPriceProvider;
use Mollie\Subscription\Provider\SubscriptionOrderAmountProvider;
use Mollie\Tests\Unit\BaseTestCase;

class SubscriptionOrderAmountProviderTest extends BaseTestCase
{
    /** @var SubscriptionCarrierDeliveryPriceProvider */
    private $subscriptionCarrierDeliveryPriceProvider;

    public function setUp(): void
    {
        parent::setUp();

        $this->subscriptionCarrierDeliveryPriceProvider = $this->mock(SubscriptionCarrierDeliveryPriceProvider::class);
    }

    public function testItSuccessfullyProvidesData(): void
    {
        $this->subscriptionCarrierDeliveryPriceProvider->expects($this->once())->method('getPrice')->willReturn(12.34);

        $currency = $this->mock(\Currency::class);

        $currency->iso_code = 'EUR';

        $this->currencyRepository->expects($this->once())->method('findOneBy')->willReturn($currency);

        $subscriptionOrderAmountProvider = new SubscriptionOrderAmountProvider(
            $this->subscriptionCarrierDeliveryPriceProvider,
            $this->currencyRepository
        );

        $result = $subscriptionOrderAmountProvider->get(SubscriptionOrderAmountProviderData::create(
            1,
            2,
            3,
            ['total_price_tax_incl' => 10.00],
            4,
            5
        ));

        $this->assertEquals([
            'value' => 22.34,
            'currency' => 'EUR',
        ], $result->toArray());
    }

    public function testItUnsuccessfullyProvidesDataFailedToProvideCarrierDeliveryPrice(): void
    {
        $this->subscriptionCarrierDeliveryPriceProvider->expects($this->once())->method('getPrice')->willThrowException(new \Exception('', 0));

        $this->currencyRepository->expects($this->never())->method('findOneBy');

        $subscriptionOrderAmountProvider = new SubscriptionOrderAmountProvider(
            $this->subscriptionCarrierDeliveryPriceProvider,
            $this->currencyRepository
        );

        $this->expectException(CouldNotProvideSubscriptionOrderAmount::class);
        $this->expectExceptionCode(ExceptionCode::ORDER_FAILED_TO_PROVIDE_CARRIER_DELIVERY_PRICE);

        $subscriptionOrderAmountProvider->get(SubscriptionOrderAmountProviderData::create(
            1,
            2,
            3,
            ['total_price_tax_incl' => 10.00],
            4,
            5
        ));
    }

    public function testItUnsuccessfullyProvidesDataFailedToFindCurrency(): void
    {
        $this->subscriptionCarrierDeliveryPriceProvider->expects($this->once())->method('getPrice')->willReturn(12.34);

        $this->currencyRepository->expects($this->once())->method('findOneBy')->willReturn(null);

        $subscriptionOrderAmountProvider = new SubscriptionOrderAmountProvider(
            $this->subscriptionCarrierDeliveryPriceProvider,
            $this->currencyRepository
        );

        $this->expectException(CouldNotProvideSubscriptionOrderAmount::class);
        $this->expectExceptionCode(ExceptionCode::ORDER_FAILED_TO_FIND_CURRENCY);

        $subscriptionOrderAmountProvider->get(SubscriptionOrderAmountProviderData::create(
            1,
            2,
            3,
            ['total_price_tax_incl' => 10.00],
            4,
            5
        ));
    }
}
