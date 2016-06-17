<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class RelationshipProvider implements RIFCSProvider
{
    /*
     * @todo RelationshipRepository
     * @todo RelationshipInterface
     */

    /**
     * Get All Related Records
     *
     * @todo EXPLICIT
     * @todo REVERSE
     * @todo IDENTIFIER
     * @todo IDENTIFIER_REVERSE
     * @todo GRANTS
     *
     * @param  Version $version
     * @return array
     */
    public static function get(Version $version)
    {
        return [];
    }

    /**
     * Get Raw relationship data
     * @param  Version $version
     * @return array
     */
    public static function getRaw(Version $version)
    {
        return [];
    }

    public static function process(Version $version)
    {
        // process relationship and put them into the database
    }

    public static function getIndex(Version $version)
    {
        $content = self::get($version);
        return json_encode($content);
    }
}