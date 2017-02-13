<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $table        =   'tbl_product';
    protected $fillable     =   ['product_id','product_name','product_desc','product_image'];



    public function product_detail()
    {
        return $this->has()
    }

}
