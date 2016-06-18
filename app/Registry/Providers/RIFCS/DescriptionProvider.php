<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;

class DescriptionProvider implements RIFCSProvider
{
    /**
     * Get the resolved descriptions
     *
     * @todo implement
     * @param  Version $version
     * @return array processed descriptions
     */
    public static function get(Version $version)
    {
        return self::process(self::getRaw());
    }

    /**
     * Get the raw unmodified descriptions
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    public static function getRaw(Version $version)
    {
        $class = $version->getCoreAttribute('class');
        $sxml = simplexml_load_string($version->getContent('xml'));
        $sxml->registerXPathNamespace("ro", \Config::get('app.rifcs.namespace'));
        $descriptionXPath = $sxml->xpath('//ro:registryObject/ro:'.$class.'/ro:description');
        $descriptions = array();
        foreach($descriptionXPath as $description) {
            if((string)$description != '') {
                $description = [
                    'value' => (string) $description,
                    '@attributes' => [
                        'type' => (string) $description['type']
                    ]
                ];
                $descriptions[] = $description;
            }
        }

        return $descriptions;
    }

    /**
     * Process the descriptions
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private static function process($descriptions)
    {
       return $descriptions;
    }
}