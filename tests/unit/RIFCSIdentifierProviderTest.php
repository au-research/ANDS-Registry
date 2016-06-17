<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RIFCSIdentifierProviderTest extends TestCase
{
    /**
     * @test
     * @cover
     */
    public function it_should_get_all_the_identifiers()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = $version->getContent('identifier');

        $this->assertEquals(2, count($content));
        $this->assertContains(
            [
                'value' => 'nla.AUTCollection1',
                '@attributes' => ['type' => 'AU-ANL:PEAU']
            ],
            $content
        );
        $this->assertContains(
            [
                'value' => 'nla.part.12345 ',
                '@attributes' => ['type' => 'AU-ANL:PEAU']
            ],
            $content
        );
    }
}
