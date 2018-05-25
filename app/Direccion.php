<?php

namespace DEISA;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direccion';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calle', 'numero_exterior', 'numero_interior', 'codigo_postal'
    ];
}
