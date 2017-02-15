<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table        =   'tbl_product_details';
    protected $fillable     =   ['id','product_id','product_name','product_knotcnt','product_size'];



    public function product()
    {
        return $this->belongsTo('App\Model\Product','product_id');
    }

}
