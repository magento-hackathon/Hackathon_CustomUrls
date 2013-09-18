<?php

class Hackathon_CustomUrls_Test_Model_System_Config_Clone_Customurl extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @loadFixture config
     */
    public function itGeneratesConfigPlaceholdersFromPredefinedConfigFields()
    {
        $model = new Hackathon_CustomUrls_Model_System_Config_Clone_Customurl();

        $this->assertEquals(
            array(
                array(
                    'field' => 'checkout_cart_index',
                    'label' => 'Checkout Cart Url'
                ),
            ),
            $model->getPrefixes()
        );
    }
}