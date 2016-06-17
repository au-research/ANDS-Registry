<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use ANDS\Registry\Providers\RIFCS\TitleProvider;

class RIFCSTitleProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_have_all_name_parts()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = TitleProvider::getRaw($version);
        $this->assertEquals(3, count($content));
        $this->assertContains(
            [
                'value' => 'Collection with all RIF v1.6 elements (primaryName)',
                'attrs' => ['type' => 'primary']
            ],
            $content
        );
        $this->assertContains(
            [
                'value' => 'abbreviatedName',
                'attrs' => ['type' => 'abbreviated']
            ],
            $content
        );

    }
}