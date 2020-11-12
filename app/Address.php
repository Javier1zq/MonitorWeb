<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    public $fillable = ['street', 'number', 'townId', 'provinceId', 'type', 'province', 'town'];

}