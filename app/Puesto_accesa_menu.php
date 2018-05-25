<?php

namespace DEISA;

use Illuminate\Database\Eloquent\Model;

class Puesto_accesa_menu extends Model
{
    protected $table = 'puesto_accesa_menu';
    protected $primaryKey = ['departamento', 'puesto', 'menu'];
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'departamento', 'puesto', 'menu'
    ];
}
