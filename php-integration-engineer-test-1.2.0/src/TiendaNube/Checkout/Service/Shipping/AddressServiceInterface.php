<?php

declare(strict_types=1);

namespace TiendaNube\Checkout\Service\Shipping;

use TiendaNube\Checkout\Model\AddressShipping;

/**
 * Interface AddressShippingServiceInterface
 *
 * @package TiendaNube\Checkout\Service\Shipping
 */
interface AddressServiceInterface
{
    /**
     * Get the current Address instance
     *
     * @return AddressShipping
     */
    public function getAddressByZip(string $zip);
}
