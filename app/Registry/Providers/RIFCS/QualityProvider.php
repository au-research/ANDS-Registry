<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class QualityProvider implements RIFCSProvider
{
    /**
     * Get the Quality Level of a Version
     * @todo implement
     * @param  Version $version
     * @return array
     */
    public function get(Version $version)
    {
        // return quality level
        return [
            'quality_level' => '4'
        ];
    }

    /**
     * Process the quality level of a version
     * @todo implement
     * @param  Version $version
     * @return boolean
     */
    public function process(Version $version)
    {
       // run quality checking and save to DB
       // Version->saveAttribute(quality_level, 4)
       return true;
    }
}