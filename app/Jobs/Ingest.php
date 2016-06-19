<?php

namespace ANDS\Jobs;

use ANDS\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ingest extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $payLoad;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payLoad)
    {
        $this->payLoad = $payLoad;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump($this->payLoad);
    }
}
