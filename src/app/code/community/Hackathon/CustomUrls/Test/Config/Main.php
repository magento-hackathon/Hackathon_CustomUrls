<?php

class Hackathon_CustomUrls_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     * @group config
     */
    public function it_properly_resolves_the_model_alias()
    {
        $this->assertModelAlias('hackathon_customurls/observer', 'Hackathon_CustomUrls_Model_Observer');
    }

    /**
     * @test
     * @group config
     */
    public function it_defines_the_required_custom_obeserver()
    {
        $this->assertEventObserverDefined(
            'global',
            'controller_front_init_routers',
            'hackathon_customurls/observer',
            'handleInitRouters'
        );
    }
}