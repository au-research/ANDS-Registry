<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class CitationProvider implements RIFCSProvider
{
    //@note this should cover citationInfo

    /**
     * Get the resolved citations
     *
     * @todo implement
     * @param  Version $version
     * @return array processed citations
     */
    public static function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw unmodified citations
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
     * Process the citations
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private static function process($citations)
    {
       return $citations;
    }
}