<?php

class Hackathon_CustomUrls_Model_Observer
{
    public function handleInitRouters(Varien_Event_Observer $observer)
    {
        /** @var $frontController Mage_Core_Controller_Varien_Front */
        $frontController = $observer->getFront();
        $frontController->addRouter(
            'customurls',
            new Hackathon_CustomUrls_Controller_Router()
        );
    }
}