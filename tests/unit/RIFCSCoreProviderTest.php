<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RIFCSCoreProviderTest extends TestCase
{

    /**
     * @test
     * @cover CoreProvider
     */
    public function it_should_be_able_to_get_key()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = $version->getContent('core');

        $this->assertArrayHasKey('key', $content);
        $this->assertEquals($content['key'], "AUTCollection1");

        $this->assertArrayHasKey('group', $content);
        $this->assertArrayHasKey('class', $content);
        $this->assertArrayHasKey('originating_source', $content);
        $this->assertEquals($content['class'], "collection");
    }

}