<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class SpatialProvider implements RIFCSProvider
{
    /**
     * Get the processed spatial values
     *
     * @todo implement
     * @param  Version $version
     * @return array processed spatial
     */
    public function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw spatial values
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
     * Process the spatial values
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private function process($spatial)
    {
       return $spatial;
    }
}