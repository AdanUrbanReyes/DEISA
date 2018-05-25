<?php

namespace DEISA;

use Illuminate\Database\Eloquent\Model;

class Codigo_postal extends Model
{
    protected $table = 'codigo_postal';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_postal', 'estado', 'municipio', 'asentamiento'
    ];

}
