<?php

class Hackathon_CustomUrls_Model_System_Config_Clone_Customurl extends Mage_Core_Model_Config_Data
{
    /**
     * Get field prefixes for generating translation config nodes
     *
     * @return array
     */
    public function getPrefixes()
    {
        $prefixes = array();
        foreach ($this->getConfiguredUrlNodes() as $name => $node) {
            $prefixes[] = array(
                'field' => $name,
                'label' => (string)$node->label
            );
        }

        return $prefixes;
    }

    protected function getConfiguredUrlNodes()
    {
        return Mage::getConfig()->getNode('global/custom_urls')->children();
    }
}
