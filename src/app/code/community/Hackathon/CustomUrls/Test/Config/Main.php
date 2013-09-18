<?php

class Hackathon_CustomUrls_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     * @group config
     */
    public function itProperlyResolvesTheModelAlias()
    {
        $this->assertModelAlias('hackathon_customurls/observer', 'Hackathon_CustomUrls_Model_Observer');
    }

    /**
     * @test
     * @group config
     */
    public function itDefinesTheRequiredCustomObserver()
    {
        $this->assertEventObserverDefined(
            'global',
            'controller_front_init_routers',
            'hackathon_customurls/observer',
            'handleInitRouters'
        );
    }
}