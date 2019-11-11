<?php

namespace CRMApp;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model
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
    protected $table = 'Empresa';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'IdEmpresa';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'Nombre',
                  'Tier',
                  'Industria',
                  'Sector',
                  'Direccion'
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
     * Get the cliente for this model.
     */
    public function cliente()
    {
        return $this->hasOne('CRMApp\Cliente','EmpresaId','IdEmpresa');
    }



}
