<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CanGetTableNameStatically
{
    public static function tableName()
    {
        return with(new static)->getTable();
    }
    public static function tableColumns(){
        return array_keys(array_flip(DB::getSchemaBuilder()->getColumnListing(self::tableName())));
    }
}
