<?php
/**
 * @loadSharedFixture config
 */
class Hackathon_CustomUrls_Test_Model_Url extends EcomDev_PHPUnit_Test_Case
{
    protected $model;

    protected function setUp()
    {
        $this->model = Mage::getModel('core/url');
        $this->mockSession('core/session');
        $this->app()->addEventArea('frontend');
    }

    public function testItDispatchesEventOnGetUrlCall()
    {
        $this->model->getUrl('checkout/cart');
        $this->assertEventDispatched('hackathon_customurls_url_get_url');
    }

    public function testItReplacesUrlByRoutePath()
    {
        $actualUrl = $this->model->getUrl('checkout/cart');
        $expectedUrl = $this->model->getUrl(null, array('_direct' => 'mycart'));

        $this->assertEquals($expectedUrl, $actualUrl);
    }

    public function testItReplacesUrlByRoutePathWithSlash()
    {
        $actualUrl = $this->model->getUrl('checkout/cart/index');
        $expectedUrl = $this->model->getUrl(null, array('_direct' => 'mycart'));

        $this->assertEquals($expectedUrl, $actualUrl);
    }

    protected function tearDown()
    {
        $this->app()->removeEventArea('frontend');
    }
}