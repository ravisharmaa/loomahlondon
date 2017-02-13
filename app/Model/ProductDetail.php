<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table        =   'tbl_product_details';
    protected $fillable     =   ['product_id','product_name','product_knotcnt','size'];



    public function product_detail()
    {
        return $this->belongsTo('App\Model\Product');
    }

}
