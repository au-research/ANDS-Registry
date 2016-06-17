<?php

namespace ANDS\Registry\Providers\RIFCS;
use ANDS\Registry\Providers\RIFCSProvider;
use ANDS\Registry\Record\Version;
use SoapBox\Formatter\Formatter;

class TitleProvider implements RIFCSProvider
{



    public static function get(Version $version)
    {
        return self::getTitles($version);
    }

    public static function process(Version $version) {
        $titles = self::get($version);

        // save titles to the database
    }

    public static function getRaw(Version $version)
    {
        $class = $version->getCoreAttribute('class');
        // $formatter = Formatter::make($version->getContent('xml'), Formatter::XML);
        // $content = $formatter->toArray();
        // $rawNames = $content['registryObject'][$class]['name'];

        $sxml = simplexml_load_string($version->getContent('xml'));
        $sxml->registerXPathNamespace("ro", \Config::get('app.rifcs.namespace'));
        $rawNames = [];
        foreach ($sxml->xpath('//ro:registryObject/ro:'.$class.'/ro:name') as $fragment){
            $name = ['value' => null];
            if ($type = (string) $fragment['type']) {
                $name['@attributes'] = ['type' => $type];
            }

            foreach ($fragment->namePart as $namePartFragment) {
                $namePart = [];
                if ($type = (string) $namePartFragment['type']) {
                    $namePart['@attributes'] = ['type'=>$type];
                }
                $namePart['value'] = (string) $namePartFragment;

                // flatten it if there's only 1 namePart
                if (count($namePart) === 1) {
                    $namePart = $namePart['value'];
                }

                $name['value'][] = $namePart;
            }
            $rawNames[] = $name;
        }

        // clean up nested value
        $rawNames = collect($rawNames)->map(function($item){
            if (is_array($item['value']) && count($item['value'])===1) {
                $item['value'] = $item['value'][0];
            }
            return $item;
        });

        return $rawNames->all();
    }

    public static function getTitles($names, $class) {
        //if there's a primary name, use it

        $displayTitle = null;
        $listTitle = null;

        // take the first primary found
        $name = collect($names)->first(function($key, $item) {
            return $item['@attributes']['type'] == 'primary';
        });
        $name['value'] = collect($name['value'])->flatten()->all();
        $displayTitle = is_array($name['value']) ? $name['value'][0] : $name['value'];
        $listTitle = $displayTitle;

        // special rules for party
        if ($class === "party") {
            $displayTitle = self::constructTitleByOrder(
                $names,
                ['title', 'given', 'initial', 'family', 'suffix']
            );

            $listTitle = self::constructTitleByOrder(
                $names,
                ['family', 'given', 'initial', 'title', 'suffix'],
                $suffix = true
            );
        }

        $titles = [
            'display_title' => $displayTitle,
            'list_title' => $listTitle
        ];

        return $titles;
    }

    /**
     * ANDS Business Rule
     * return a title following a given order
     *
     * @param  array  $names   an Array of raw names
     * @param  array  $order   an Array of order of name types
     * @param  boolean $suffix would list_title business rule suffix apply
     * @return string          Title based on business rule
     */
    public static function constructTitleByOrder($names, $order, $suffix = false) {
        $titleFragments = [];
        $names = collect($names);

        // take the first primary found
        $name = $names->first(function($key, $item) {
            return $item['@attributes']['type'] == 'primary';
        });

        // add up the part on order
        $nameParts = collect($name['value']);
        foreach ($order as $o) {
            $part = $nameParts->where('@attributes', ['type'=>$o]);
            if ($part->count() > 0) {
                $titleFragments[$o] = $part->pluck('value')->flatten()->all();
            }
        }

        // join the nameparts together
        $titleFragments = collect($titleFragments);
        $titleFragments = $titleFragments->map(function($item, $key){
            return is_array($item) ? implode(' ', $item) : $item;
        });

        // business logic for list title suffix
        if ($suffix) {
            $titleFragments = $titleFragments->map(function($item, $key){
                if ($key == 'initial' || $key == 'given') {
                    $item .= ".";
                }
                return $item;
            });
            return implode(', ', $titleFragments->all());
        }

        return implode(' ', $titleFragments->all());
    }


}