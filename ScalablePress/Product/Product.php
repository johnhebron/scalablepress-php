<?php

namespace ScalablePress\Product;
/**
 * 
 */
class Product extends \ScalablePress\Base
{

    public function listCategories()
    {
        try{
            $url = "/v2/categories";
            $response = $this->callWithoutAuth("get",$url,$value);
            return $response;
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }    
}