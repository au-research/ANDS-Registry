<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class RightsProvider implements RIFCSProvider
{
    /**
     * Get the resolved rightss
     *
     * @todo implement
     * @param  Version $version
     * @return array processed rightss
     */
    public static function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw unmodified rightss
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    public static function getRaw(Version $version)
    {
        return [];
    }

    /**
     * Process the rightss
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private static function process($rightss)
    {
       return $rightss;
    }
}