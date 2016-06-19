<?php

namespace ANDS\Registry;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    protected $table = "data_sources";

    protected $primaryKey = "data_source_id";

    public $timestamps = false;

    public function records()
    {
        return $this->hasMany('ANDS\Registry\Record', 'data_source_id');
    }

    public function count()
    {
        $classes = ['collection', 'party', 'activity', 'service'];
        $result = [];
        foreach ($classes as $class) {
            $result[$class] = $this->records->where('class', $class)->count();
        }
        return $result;
    }

    public function published($limit = 30)
    {
        return
            Record::where('data_source_id', $this->data_source_id)
                ->take($limit)
                ->get()
                ->all();
    }
}
