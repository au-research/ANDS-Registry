<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ANDS\Registry\Providers\RIFCS\TitleProvider;

class RIFCSTitleProviderTest extends TestCase
{
    /**
     * @test
     * @cover TitleProvider::getRaw
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
                '@attributes' => ['type' => 'primary']
            ],
            $content
        );
        $this->assertContains(
            [
                'value' => 'abbreviatedName',
                '@attributes' => ['type' => 'abbreviated']
            ],
            $content
        );
    }

    /**
     * @test
     * @cover TitleProvider::getTitles
     */
    public function it_should_have_primary_as_the_title()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $class = $version->getCoreAttribute('class');
        $names = TitleProvider::getRaw($version);
        $content = TitleProvider::getTitles($names, $class);

        $this->assertEquals(
            'Collection with all RIF v1.6 elements (primaryName)',
            $content['display_title']
        );

        $this->assertEquals(
            'Collection with all RIF v1.6 elements (primaryName)',
            $content['list_title']
        );
    }

    /**
     * @test
     * @cover TitleProvider::getTitles
     */
    public function it_should_have_processed_party_as_the_title()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs2.xml');
        $version->setXml($contents);

        $class = $version->getCoreAttribute('class');
        $names = TitleProvider::getRaw($version);
        $content = TitleProvider::getTitles($names, $class);

        $this->assertEquals(
            'A/Pr Gary R Hime',
            $content['display_title']
        );

        $this->assertEquals(
            'Hime, Gary R., A/Pr',
            $content['list_title']
        );
    }
}
