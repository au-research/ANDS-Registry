<?php

namespace ANDS\Registry\Providers\RIFCS;

use \DOMDocument as DOMDocument;
use \DOMXpath as DOMXpath;

trait XPathProvider {

    public static function runXPath($xpath, $version)
    {
        $gXPath = self::getXPath($version);

        $data = [];
        foreach ($gXPath->query($xpath) as $node) {
            $data[] = $node->nodeValue;
        }

        if (sizeof($data) === 0) {
            return null;
        }

        return sizeof($data) > 1 ? $data : $data[0];
    }

    private static function getXPath($version)
    {
        $xml = $version->getContent();
        $rifDom = new DOMDocument();
        $rifDom->loadXML($xml);
        $gXPath = new DOMXpath($rifDom);
        $gXPath->registerNamespace('ro', "http://ands.org.au/standards/rif-cs/registryObjects");
        return $gXPath;
    }
}