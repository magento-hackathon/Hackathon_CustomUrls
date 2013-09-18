<?php

class Hackathon_CustomUrls_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    public function testClassAlias()
    {
        $this->assertModelAlias('hackathon_customurls/observer', 'Hackathon_CustomUrls_Model_Observer');
    }

    public function testEventObserver()
    {
        $this->assertEventObserverDefined(
            'global',
            'controller_front_init_routers',
            'hackathon_customurls/observer',
            'handleInitRouters'
        );
    }
}