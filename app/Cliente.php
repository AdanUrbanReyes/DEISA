<?php

namespace DEISA;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'cliente';
	protected $primaryKey = 'numero';
	public $incrementing = true;
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'razon_social', 'planta', 'empresa', 'direccion', 'giro', 'rfc', 'sae', 'proveedor', 'tipo', 'estado'
    ];

}
