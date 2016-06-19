<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IngestJobTest extends TestCase
{
    /**
     * @test
     * @cover CoreProvider
     */
    public function it_should_handle()
    {
        $contents = Storage::disk('test')->get('rifcs1.xml');
        $job = new ANDS\Jobs\Ingest($contents);

        /**
         * POST to a url with ds and import package
         * expects the job Import to be queued
         * run the job Import
         * expects the Ingest, Enrich and Index job to be queued
         * run the Ingest Job
         * expects all these stuffs happen in the database
         * run the Enrich Job
         * expects all these values getting enriched and processed correctly
         * run the Index Job
         * expects all records to be in the SOLR index
         * visit API and see that the records are there
         */

    }
}
