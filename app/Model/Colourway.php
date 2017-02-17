<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Colourway extends Model
{
    protected $table        =   'tbl_colourways';
    protected $primaryKey   =   'colourway_id';

    protected $fillable     =   [
        'product_id','colourway_name','colourway_alias','colourway_description',
        'colourway_th_image','colourway_lg_image','colourway_default','colourway_order','colourway_status'
    ];



    public function product()
    {
        return $this->belongsTo('App\Model\Product','product_id');
    }

}
