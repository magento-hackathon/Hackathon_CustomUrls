<?php

class Hackathon_CustomUrls_Model_Observer
{
    const XML_PATH_ROUTES = 'global/custom_urls';
    const XML_PATH_FRONT_NAME = 'web/custom_urls/%s_url';

    public function handleInitRouters(Varien_Event_Observer $observer)
    {
        /** @var $frontController Mage_Core_Controller_Varien_Front */
        $frontController = $observer->getFront();
        $frontController->addRouter(
            'customurls',
            new Hackathon_CustomUrls_Controller_Router()
        );
    }

    public function handleGetUrl(Varien_Event_Observer $observer)
    {
        $params = $observer->getParams();

        $availableRoutes = $this->getAvailableRoutes();
        $routeToMatch = trim($params->routePath, '/');

        if (substr_count($routeToMatch, '/') === 1) {
            $routeToMatch .= '/index';
        }

        foreach ($availableRoutes as $availableRoute) {
            if ((string)$availableRoute->route == $routeToMatch) {
                if (isset($availableRoute->params)) {
                    $hasChild = false;
                    foreach ($availableRoute->params->children() as $param) {
                        $hasChild = true;
                        if (!isset($params->routeParams[$param->getName()])
                            || $params->routeParams[$param->getName()] != (string)$param) {
                            continue 2;
                        }
                    }

                    if (!$hasChild && $params->routeParams) {
                        continue;
                    }
                }

                $params->routePath = null;
                $params->routeParams = array('_direct' => $this->getUserDefinedRouteFrontName($availableRoute));
                break;
            }
        }
    }

    protected function getAvailableRoutes()
    {
        return Mage::getConfig()->getNode(self::XML_PATH_ROUTES)->children();
    }

    protected function getUserDefinedRouteFrontName($route)
    {
        return Mage::getStoreConfig(sprintf(self::XML_PATH_FRONT_NAME, $route->getName()));
    }
}