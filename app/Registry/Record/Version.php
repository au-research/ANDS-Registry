<?php

namespace ANDS\Registry\Record;

class Version {

    use XMLContent;

    private $content = null;

    public function getContent($content = "xml")
    {
        if ($content == "xml") {
            return $this->content;
        }

        $providers = \Config::get('app.rifcs.providers');

        if (!array_key_exists($content, $providers)) {
            throw new \Exception("Provider $content Not Found for RIFCS");
        }

        $provider = new $providers[$content];
        return $provider->get($this);
    }

    public function getCoreAttribute($key)
    {
        $core = \ANDS\Registry\Providers\RIFCS\CoreProvider::get($this);
        return $core[$key];
    }
}