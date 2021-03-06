<?php

namespace ANDS\Registry;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'registry_objects';

    protected $primaryKey = "registry_object_id";

    public $timestamps = false;


    public function recordable()
    {
        return $this->morphTo();
    }

}
