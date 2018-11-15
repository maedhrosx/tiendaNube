<?php

namespace TiendaNube\Checkout\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class UrlClient
{
    public $base_url = null;
    public $url = null;
    
    /** 
     * Initialize params from client
     * 
     * @param String $base_uri
     */
    public function __construct( String $base_uri)
    {
        $this->base_url = $base_uri;
    }
    
    public function client_with_options( $headers, $params )
    {
    }
    
    /**
     * 
     * Make requests http with Guzzle
     * 
     * @param $params
     */
    public function request(Array $params)
    { 
        try{
            $client = new GuzzleHttp\Client();
            
            foreach( $params as $param => $val)
            {
                $string_param = '/'.$param.'/'.$val;
            }
            $response = $client->get($this->base_url.$string_param, [
                'headers' => ['Authentication bearer' => $token,
                              'Content-type' => 'application/json']
            ]);
            $json = $response->json();
            return $json;
        } catch (ClientException $e) {
            // TODO logger or return
            $logger->info('Error Request'.$e->getRequest();
            $logger->info('Error Response'.$e->getResponse();
        } catch (RequestException $e) {
            // TODO logger or return
            $logger->info('Error Request'.$e->getRequest();
            echo $e->getRequest();
            if ($e->hasResponse()) {
                $logger->info('Error Response'.$e->getResponse();
            }
        }
        return null;
    }
}

