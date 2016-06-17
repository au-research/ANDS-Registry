<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;
use SoapBox\Formatter\Formatter;

class CoreProvider implements RIFCSProvider
{

    public static function get(Version $version)
    {
        return self::getRaw($version);
    }

    public static function getRaw(Version $version) {
        $formatter = Formatter::make($version->getContent('xml'), Formatter::XML);
        $content = $formatter->toArray();

        return [
            'key' => $content['registryObject']['key'],
            'group' => $content['registryObject']['@attributes']['group'],
            'originating_source' => $content['registryObject']['originatingSource'],
            'class' => self::getRecordClass($content)
        ];
    }

    public static function getRecordClass($content) {
        $validClasses = \Config::get('app.rifcs.classes');
        $validClasses = array_values($validClasses);
        $recordClass = null;
        // dd(array_key_exists('collection', $content['registryObject']));
        foreach ($validClasses as $class) {
            if (array_key_exists($class, $content['registryObject'])) {
                $recordClass = $class;
            }
        }
        return $recordClass;
    }

}