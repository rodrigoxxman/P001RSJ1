<?php

namespace CRMApp;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Cliente';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'IdCliente';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'Nombre',
                  'Direccion',
                  'Telefono',
                  'Email',
                  'EmpresaId'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the empresa for this model.
     */
    public function empresa()
    {
        return $this->belongsTo('CRMApp\Empresa','EmpresaId','IdEmpresa');
    }

    /**
     * Get the oportunidad for this model.
     */
    public function oportunidad()
    {
        return $this->hasOne('CRMApp\Oportunidad','ClienteId','IdCliente');
    }
}