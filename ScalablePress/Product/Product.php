<?php

namespace ScalablePress\Search;
/**
 * 
 */
class Search extends \ScalablePress\Base
{

    public function listCategories()
    {
        try{
            $url = "/v2/categories";
            $response = $this->callScalablePress("get",$url,$value);
            return $response;
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }    
}