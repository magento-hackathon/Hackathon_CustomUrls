<?php

class Hackathon_CustomUrls_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     */
    public function itProperlyResolvesTheModelAliasForObserver()
    {
        $this->assertModelAlias('hackathon_customurls/observer', 'Hackathon_CustomUrls_Model_Observer');
    }

    /**
     * @test
     */
    public function itProperlyResolvesTheModelAliasForConfigCloneCustomurl()
    {
        $this->assertModelAlias('hackathon_customurls/system_config_clone_customurl', 'Hackathon_CustomUrls_Model_System_Config_Clone_Customurl');
    }

    /**
     * @test
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

    /**
     * @test
     */
    public function itOverridesCoreUrlModel()
    {
        $this->assertModelAlias(
            'core/url',
            'Hackathon_CustomUrls_Model_Url'
        );
    }

    /**
     * @test
     */
    public function itObservesGetUrlEvent()
    {
        $this->assertEventObserverDefined(
            'frontend',
            'hackathon_customurls_url_get_url',
            'hackathon_customurls/observer',
            'handleGetUrl'
        );
    }
}