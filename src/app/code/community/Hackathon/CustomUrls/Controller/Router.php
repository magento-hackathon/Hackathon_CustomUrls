<?php

class Hackathon_CustomUrls_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    const XML_PATH_ROUTES = 'global/custom_urls';
    const XML_PATH_FRONT_NAME = 'web/custom_urls/%s_url';
    const XML_PATH_FRONT_NAME_FOR_ROUTE = 'frontend/routers/%s/args/frontName';

    public function match(Zend_Controller_Request_Http $request)
    {
        $availableRoutes = $this->getAvailableRoutes();

        $pathInfo = $request->getPathInfo();

        foreach ($availableRoutes as $availableRoute) {

            $frontName = $this->getUserDefinedRouteFrontName($availableRoute);

            if ($frontName && $frontName == trim($pathInfo, '/')) {

                $routePath = explode('/', (string) $availableRoute->route);

                if (!empty($routePath)) {
                    list($routeName, $controllerName, $actionName) = array_merge(
                        $routePath, array('index', 'index')
                    );

                    $moduleName = $this->getFrontNameByRoute($routeName);

                    $request->setModuleName($moduleName)
                            ->setControllerName($controllerName)
                            ->setActionName($actionName);

                    $this->setRouteParameters($request, $availableRoute);

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

    protected function getAvailableRoutes()
    {
        return Mage::getConfig()->getNode(self::XML_PATH_ROUTES)->children();
    }

    protected function getUserDefinedRouteFrontName($route)
    {
        return  Mage::getStoreConfig(sprintf(self::XML_PATH_FRONT_NAME, $route->getName()));
    }

    protected function setRouteParameters($request, $route)
    {
        if (isset($route->params) && $route->params->hasChildren()) {
            $request->setParams($route->params->asArray(true));
        }
    }

    public function getFrontNameByRoute($routeName)
    {
        $frontNameInConfig = (string) Mage::getConfig()->getNode(
            sprintf(self::XML_PATH_FRONT_NAME_FOR_ROUTE, $routeName)
        );

        if ($frontNameInConfig) {
            return $frontNameInConfig;
        }

        return parent::getFrontNameByRoute($routeName);
    }
}