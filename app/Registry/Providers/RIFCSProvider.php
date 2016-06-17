<?php

namespace ANDS\Registry\Providers;
use ANDS\Registry\Record\Version;

interface RIFCSProvider {

    public static function get(Version $version);

}