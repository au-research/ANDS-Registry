<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;
use SoapBox\Formatter\Formatter;

class TitleProvider implements RIFCSProvider
{
    public static function get(Version $version)
    {
        return self::getRaw($version);
    }

    public static function getRaw(Version $version)
    {
        $class = $version->getCoreAttribute('class');
        $formatter = Formatter::make($version->getContent('xml'), Formatter::XML);
        $content = $formatter->toArray();
        $rawNames = $content['registryObject'][$class]['name'];

        $names = [];
        foreach ($rawNames as $rawName) {
            // Join together the name parts with spaces
            // Order is not defined
            $name = [
                'value' => is_array($rawName['namePart'])
                            ? implode(' ', $rawName['namePart'])
                            : $rawName['namePart'],
                'attrs' => ['type' => $rawName['@attributes']['type']]
            ];
            $names[] = $name;
        }
        return $names;
    }
}