<?php

namespace ANDS\Http\Controllers;

use Illuminate\Http\Request;

use ANDS\Http\Requests;

use Illuminate\Foundation\Bus\DispatchesJobs;
use ANDS\Jobs\Ingest;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{

    public function import()
    {
        $contents = $contents = Storage::disk('test')->get('rifcs1.xml');
        $job = new Ingest($contents);

        dispatch($job);
        return "Done";
    }

}
