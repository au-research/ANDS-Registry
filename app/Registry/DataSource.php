<?php

namespace ANDS\Registry;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model {

    protected $table = "data_sources";

    protected $primaryKey = "data_source_id";

    public $timestamps = false;

    public function records()
    {
        $this->hasMany(Record::class, 'data_source_id');
    }
}
