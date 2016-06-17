<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VersionTest extends TestCase
{

    /**
     * @test
     * @cover
     */
    public function it_should_load_and_get_xml()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $this->assertEquals($contents, $version->getContent("xml"));
    }

    /**
     * @test
     * @covers Version->getContent()
     */
    public function it_should_allow_core_provider_get()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = $version->getContent('core');
        $this->assertInternalType('array', $content);
    }

    /**
     * @test
     * @covers Version->getContent()
     */
    public function it_should_throw_exception_on_unknown_provider()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $this->setExpectedException('Exception');
        $content = $version->getContent('somethingelsedoesntexist');
    }

}