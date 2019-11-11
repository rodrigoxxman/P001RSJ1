<?php

namespace CRMApp;

use Illuminate\Database\Eloquent\Model;

class oportunidad extends Model
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
    protected $table = 'Oportunidad';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'IdOportunidad';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'Nombre',
                  'FechaOportunidad',
                  'FechaCierre',
                  'MustWin',
                  'MontoUSS',
                  'PercentWin',
                  'Avance',
                  'Ponderado',
                  'Funnel',
                  'Costo',
                  'TipoVenta',
                  'Mes',
                  'Trimestre',
                  'Tamano',
                  'Relevante',
                  'Registrado',
                  'Codigo',
                  'Facturado',
                  'Numfactura',
                  'ClienteId',
                  'PrevendId',
                  'VendId',
                  'SolucionId'
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
        return $this->belongsTo('CRMApp\Cliente','ClienteId','IdCliente');
    }


    public function empresa()
    {
        return $this->belongsTo('CRMApp\Empresa','EmpresaId','IdEmpresa');
    }



    /**
     * Get the prevend for this model.
     */
    public function prevendedor()
    {
        return $this->belongsTo('CRMApp\Prevendedor','PrevendedorId','IdPrevendedor');
    }

    /**
     * Get the vend for this model.
     */
    public function vendedor()
    {
        return $this->belongsTo('CRMApp\Vendedor','VendedorId','IdVendedor');
    }

    /**
     * Get the solucion for this model.
     */
    public function solucion()
    {
        return $this->belongsTo('CRMApp\Solucion','SolucionId','IdSolucion');
    }

    /**
     * Get the mayorista for this model.
     */
    public function mayorista()
    {
        return $this->belongsTo('CRMApp\Mayorista','MayoristaId','IdMayorista');
    }


    
    /**
     * Set the FechaOp.
     *
     * @param  string  $value
     * @return void
     
    *public function setFechaOpAttribute($value)
    *{
    *    $this->attributes['FechaOp'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    *}
    */

    /**
     * Set the FechaCierre.
     *
     * @param  string  $value
     * @return void
     *
    *public function setFechaCierreAttribute($value)
    *{
    *    $this->attributes['FechaCierre'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    *}
    */


    /**
     * Get FechaOp in array format
     *
     * @param  string  $value
     * @return array
     *
    *public function getFechaOpAttribute($value)
    *{
    *    return date('d-m-Y', strtotime($value));
    *}
    */


    /**
     * Get FechaCierre in array format
     *
     * @param  string  $value
     * @return array
     *
    *public function getFechaCierreAttribute($value)
    *{
    *    return date('d-m-Y', strtotime($value));
    *}
    */


}
