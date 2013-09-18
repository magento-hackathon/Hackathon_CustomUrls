<?php

class Hackathon_CustomUrls_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case
{
    protected $model;

    protected function setUp()
    {
        $this->model = Mage::getModel('hackathon_customurls/observer');
    }


    public function testItShouldAddANewRouterOnEventDispatch()
    {
        $frontController = new Mage_Core_Controller_Varien_Front();
        $event = new Varien_Event(array('front' => $frontController));
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);
        $observer->setFront($frontController);

        $this->model->handleInitRouters($observer);

        $actualRouters = $frontController->getRouters();

        $this->assertInstanceOf('Hackathon_CustomUrls_Controller_Router', current($actualRouters));
    }
}