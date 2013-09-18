<?php

class Hackathon_CustomUrls_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     * @group config
     */
    public function itProperlyResolvesTheModelAliasForObserver()
    {
        $this->assertModelAlias('hackathon_customurls/observer', 'Hackathon_CustomUrls_Model_Observer');
    }

    /**
     * @test
     * @group config
     */
    public function itProperlyResolvesTheModelAliasForConfigCloneCustomurl()
    {
        $this->assertModelAlias('hackathon_customurls/system_config_clone_customurl', 'Hackathon_CustomUrls_Model_System_Config_Clone_Customurl');
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