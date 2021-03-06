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
    public static function get(Version $version)
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
    public static function getRaw(Version $version)
    {
        $class = $version->getCoreAttribute('class');
        $sxml = simplexml_load_string($version->getContent('xml'));
        $sxml->registerXPathNamespace("ro", \Config::get('app.rifcs.namespace'));
        $subjectXPath = $sxml->xpath('//ro:registryObject/ro:'.$class.'/ro:subject');
        $subjects = array();
        foreach($subjectXPath as $subject) {
            if((string)$subject != '') {
                $subject = [
                    'value' => (string) $subject,
                    '@attributes' => [
                        'type' => (string) $subject['type']
                    ]
                ];
                $subjects[] = $subject;
            }
        }

        return $subjects;
    }

    /**
     * Process the subjects
     *
     * @todo implement
     * @param  Version $version
     * @return array
     */
    private static function process($subjects)
    {
       return $subjects;
    }
}