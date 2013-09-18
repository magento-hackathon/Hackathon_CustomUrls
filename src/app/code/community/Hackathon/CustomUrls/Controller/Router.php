<?php

class Hackathon_CustomUrls_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    const XML_PATH_ROUTES = 'global/custom_urls';
    const XML_PATH_FRONT_NAME = 'web/custom_urls/%s_url';
    const XML_PATH_FRONT_NAME_FOR_ROUTE = 'frontend/routers/%s/args/frontName';

    public function match(Zend_Controller_Request_Http $request)
    {

        $availableRoutes = Mage::getConfig()->getNode(self::XML_PATH_ROUTES)->children();
        $pathInfo = $request->getPathInfo();
        foreach ($availableRoutes as $route) {
            $configPath = sprintf(self::XML_PATH_FRONT_NAME, $route->getName());
            $frontName = Mage::getStoreConfig($configPath);
            if ($frontName && $frontName == trim($pathInfo, '/')) {
                $routePath = explode('/', (string)$route->route, 4);
                if (isset($routePath[0])) {
                    $frontName = (string)Mage::getConfig()->getNode(
                        sprintf(self::XML_PATH_FRONT_NAME_FOR_ROUTE, $routePath[0])
                    );
                    $request->setModuleName($frontName);
                    if (!empty($routePath[1])) {
                        $controllerName = $routePath[1];
                    } else {
                        $controllerName = 'index';
                    }
                    if (!empty($routePath[2])) {
                        $actionName = $routePath[2];
                    } else {
                        $actionName = 'index';
                    }
                    $request->setControllerName($controllerName)
                            ->setActionName($actionName);

                    $request->setAlias(
                        Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                        $pathInfo
                    );

                    return true;
                }
            }
        }

        return false;
    }
}