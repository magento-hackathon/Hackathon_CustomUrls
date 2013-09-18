<?php

class Hackathon_CustomUrls_Model_Url extends Mage_Core_Model_Url
{
    /**
     * Build url by requested path and parameters
     *
     * @param   string|null $routePath
     * @param   array|null $routeParams
     * @return  string
     */
    public function getUrl($routePath = null, $routeParams = null)
    {
        $paramsProxy = new stdClass();
        $paramsProxy->routePath = $routePath;
        $paramsProxy->routeParams = $routeParams;

        Mage::dispatchEvent('hackathon_customurls_url_get_url', array(
            'params' => $paramsProxy
        ));

        $routePath = $paramsProxy->routePath;
        $routeParams = $paramsProxy->routeParams;

        return parent::getUrl($routePath, $routeParams);
    }
}