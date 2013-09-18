<?php

class Hackathon_CustomUrls_Test_Controller_Router extends EcomDev_PHPUnit_Test_Case_Controller
{

    /**
     * @loadFixture config
     */
    function testItShouldResolveCustomCheckoutCartUrl()
    {
        $this->dispatch(null, array('_direct' => 'mycart/'));

        $this->assertRequestRoute('checkout/cart/index');
    }
}