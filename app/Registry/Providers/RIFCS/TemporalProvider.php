<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class TemporalProvider implements RIFCSProvider
{
    /**
     * Get the processed temporal values
     *
     * @todo implement
     * @param  Version $version
     * @return array processed temporal
     */
    public function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw temporal values
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    public function getRaw(Version $version)
    {
        return [];
    }

    /**
     * Process the temporal values
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private function process($temporal)
    {
       return $spatial;
    }
}