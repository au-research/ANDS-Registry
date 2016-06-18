<?php
use Illuminate\Foundation\Testing\WithoutMileware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ANDS\Registry\Providers\RIFCS\DescriptionProvider;

class RIFCSDescriptionProviderTest extends TestCase
{
    /**
     * @test
     * @cover DescriptionProvider::getRaw
     */
    public function it_should_have_all_descriptions_with_attributes()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = DescriptionProvider::getRaw($version);

        $this->assertEquals(11, count($content));

        // deep testing on actualy values
        // this test case has 11 different descriptions and 11 different types
        $collection = collect($content);
        $values = $collection->pluck('value');
        $this->assertEquals(11, count($values));
        $types = $collection->pluck('@attributes')->pluck('type');
        $this->assertEquals(11, count($types));
    }
}
