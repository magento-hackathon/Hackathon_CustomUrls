<?php

/**
 * @loadSharedFixture config
 */
class Hackathon_CustomUrls_Test_Controller_Router extends EcomDev_PHPUnit_Test_Case_Controller
{

    function testItShouldResolveCustomCheckoutCartUrl()
    {
        $this->dispatch(null, array('_direct' => 'mycart/'));
        $this->assertRequestRoute('checkout/cart/index');
    }

    function testItShouldResolveCustomCheckoutCartUrlParams()
    {
        $this->dispatch(null, array('_direct' => 'mycartwithparams/'));
        $this->assertRequestRoute('checkout/cart/index');
        $this->assertEquals('some_value', $this->getRequest()->getParam('my_awesome_param'));
    }
}