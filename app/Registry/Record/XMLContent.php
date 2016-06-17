<?php

namespace ANDS\Registry\Record;

trait XMLContent {

    public function setXML($content)
    {
        $this->setContent($content);
    }

    private function setContent($content)
    {
        $this->content = $content;
    }

}