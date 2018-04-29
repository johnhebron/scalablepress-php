<?php

namespace ScalablePress;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
*
*/
class Base
{

    const API_URL = "https://api.scalablepress.com";

    protected $client;
    protected $api_key;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->setAPIKey(getenv('SCALABLEPRESS_API_KEY'));
    }

    public function setAPIKey($key)
    {
        $this->api_key = $key;
    }

    protected function callScalablePress($method,$request,$post = [])
    {
        try{
            $url = self::API_URL . $request;
            $headers = array('Authorization'=>'BASIC ' . base64_encode(":" . $this->api_key));
            $response = $this->client->request($method,$url, array('query' => $post,'headers' => $headers));
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }
    protected function statusCodeHandling($e)
    {
        $response = array("statuscode" => $e->getResponse()->getStatusCode(),
        "error" => json_decode($e->getResponse()->getBody(true)->getContents()));
        return $response;
    }
}
