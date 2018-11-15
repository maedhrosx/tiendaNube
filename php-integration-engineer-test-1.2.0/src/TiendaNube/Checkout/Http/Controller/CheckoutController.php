<?php

declare(strict_types=1);

namespace TiendaNube\Checkout\Http\Controller;

use Psr\Http\Message\ResponseInterface;
//use Psr\Http\Message\Request;
use TiendaNube\Checkout\Service\Shipping\AddressServiceInterface;
use TiendaNube\Checkout\Service\Store\StoreServiceInterface;
use TiendaNube\Checkout\Http\Client;

class CheckoutController extends AbstractController
{
    /**
     * Returns the address to be auto-fill the checkout form
     *
     * Expected JSON:
     * {
     *     "address": "Avenida da França",
     *     "neighborhood": "Comércio",
     *     "city": "Salvador",
     *     "state": "BA"
     * }
     *
     * @Route /address/{zipcode}
     *
     * @param string $zipcode
     * @param AddressServiceInterface $addressServiceInterface
     * @param StoreServiceInterface $store
     * @return ResponseInterface
     */
    public function getAddressAction(string $zipcode, AddressServiceInterface $addressServiceInterface, StoreServiceInterface $storeServiceInterface):ResponseInterface {

        // filtering and sanitizing input
        $rawZipcode = preg_replace("/[^\d]/","",$zipcode);
        
        // check if store is available for Restful api beta
        $isStoreBeta = $storeServiceInterface->getCurrentStore()->isBetaTester();
        
        if ($isStoreBeta) {
            # getting address from Restful api
            $base_url = config('api_address_base_url'); #url from config https://shipping.tiendanube.com/v1/
            $params = array('address' => $rawZipcode);
            $client = new Client($base_url);
            $address = $client->request($params);
        } else {
            // getting address by zipcode
            $address = $addressServiceInterface->getAddressByZip($rawZipcode);
        }
        
        // checking the result
        if (!is_null($address)) {
            return $this->json($address);
        }

        // TODO manage exceptions and code errors
        // returning the error when not found
        return $this->json(['error'=>'The requested zipcode was not found.'],404);
    }
}
