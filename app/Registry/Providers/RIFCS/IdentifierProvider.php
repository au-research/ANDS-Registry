<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;
use SoapBox\Formatter\Formatter;

class IdentifierProvider implements RIFCSProvider
{

    public static function get(Version $version)
    {
        return self::getRaw($version);
    }

    public static function getRaw(Version $version) {
        $class = $version->getCoreAttribute('class');

        // Doesn't get identifiers type
        // $formatter = Formatter::make($version->getContent('xml'), Formatter::XML);
        // $content = $formatter->toArray();
        // $content = \XMLParser::xml($version->getContent('xml'));
        // $identifier = $content['registryObject'][$class]['identifier'];
        // dd($identifier);

        // resort to using simple xml instead
        $sxml = simplexml_load_string($version->getContent('xml'));
        $sxml->registerXPathNamespace("ro", \Config::get('app.rifcs.namespace'));
        $identifierXPath = $sxml->xpath('//ro:registryObject/ro:'.$class.'/ro:identifier');
        $identifiers = array();
        foreach($identifierXPath as $identifier) {
            if((string)$identifier != '') {
                $identifier = [
                    'value' => (string) $identifier,
                    '@attributes' => [
                        'type' => (string) $identifier['type']
                    ]
                ];
                $identifiers[] = $identifier;
            }
        }

        return $identifiers;
    }


}