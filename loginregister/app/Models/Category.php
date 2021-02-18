<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';

    protected $fillable =['id','cname','corder','cstatus','cimage'];

    public function getOrder(){
        return $this->corder;
    }
}
