<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class SubjectProvider implements RIFCSProvider
{
    /**
     * Get the resolved subjects
     *
     * @todo implement
     * @param  Version $version
     * @return array processed subjects
     */
    public function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw unresolved subjects
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
     * Process the subjects
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private function process($subjects)
    {
       return $subjects;
    }
}