<?php

namespace CRMApp;

use Illuminate\Database\Eloquent\Model;

class vendedor extends Model
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
    protected $table = 'Vendedor';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'IdVendedor';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'Nombre',
                  'Telefono',
                  'Email'
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
     * Get the oportunidad for this model.
     */
    public function oportunidad()
    {
        return $this->hasOne('CRMApp\Oportunidad','VendedorId','IdVendedor');
    }



}
