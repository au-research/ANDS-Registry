<?php
use Illuminate\Foundation\Testing\WithoutMileware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ANDS\Registry\Providers\RIFCS\SubjectProvider;

class RIFCSSubjectProviderTest extends TestCase
{
    /**
     * @test
     * @cover SubjectProvider::getRaw
     */
    public function it_should_have_all_subjects_with_attributes()
    {
        $version = new ANDS\Registry\Record\Version;
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $version->setXml($contents);

        $content = SubjectProvider::getRaw($version);

        $this->assertEquals(3, count($content));

        $this->assertContains(
            [
                'value' => '830201',
                '@attributes' => ['type' => 'anzsrc-seo']
            ],
            $content
        );

        $this->assertContains(
            [
                'value' => '0303',
                '@attributes' => ['type' => 'anzsrc-for']
            ],
            $content
        );

        $this->assertContains(
            [
                'value' => 'localSubject',
                '@attributes' => ['type' => 'local']
            ],
            $content
        );

    }
}
