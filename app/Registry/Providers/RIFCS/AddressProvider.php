<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class AddressProvider implements RIFCSProvider
{
    //@note this should cover location/address

    /**
     * Get the processed address values
     *
     * @todo implement
     * @param  Version $version
     * @return array processed address
     */
    public function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw address values
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
     * Process the address values
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private function process($address)
    {
       return $address;
    }
}