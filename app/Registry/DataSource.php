<?php

namespace ANDS\Registry;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    protected $table = "data_sources";

    protected $primaryKey = "data_source_id";

    public $timestamps = false;

    public function published($limit = 30)
    {
        return
            Record::where('data_source_id', $this->data_source_id)
                ->take($limit)
                ->get()
                ->all();
    }
}
