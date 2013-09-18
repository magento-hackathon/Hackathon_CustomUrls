<?php
/**
 * @loadSharedFixture config
 */
class Hackathon_CustomUrls_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Hackathon_CustomUrls_Model_Observer
     */
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

    protected function _getObserverForHandingGetUrlCall($routePath = null, $routeParams = null)
    {
        $params = new stdClass();
        $params->routePath = $routePath;
        $params->routeParams = $routeParams;

        $event = new Varien_Event(array('params' => $params));
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);
        $observer->setParams($params);

        return $observer;
    }

    public function testItReplacesUrlByRoutePath()
    {
        $observer = $this->_getObserverForHandingGetUrlCall('checkout/cart');

        $this->model->handleGetUrl($observer);

        $actualParams = $observer->getParams();

        $this->assertNull($actualParams->routePath);
        $this->assertEquals(array('_direct' => 'mycart'), $actualParams->routeParams);
    }

    public function testItReplacesUrlByRoutePathWithSlash()
    {
        $observer = $this->_getObserverForHandingGetUrlCall('checkout/cart/index');

        $this->model->handleGetUrl($observer);

        $actualParams = $observer->getParams();

        $this->assertNull($actualParams->routePath);
        $this->assertEquals(array('_direct' => 'mycart'), $actualParams->routeParams);
    }

    public function testItDoesNotReplaceUrlByRoutePathThatIsNotOverridden()
    {
        $observer = $this->_getObserverForHandingGetUrlCall('cms/page');

        $this->model->handleGetUrl($observer);

        $actualParams = $observer->getParams();

        $this->assertEquals('cms/page', $actualParams->routePath);
        $this->assertNull($actualParams->routeParams);
    }

    public function testItDoesNotReplaceUrlByRoutePathWithParams()
    {
        $observer = $this->_getObserverForHandingGetUrlCall(
            'checkout/cart/index',
            array('my_awesome_param' => 'some_value')
        );

        $this->model->handleGetUrl($observer);

        $actualParams = $observer->getParams();

        $this->assertNull($actualParams->routePath);
        $this->assertEquals(array('_direct' => 'mycartwithparams'), $actualParams->routeParams);
    }
}