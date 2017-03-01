<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table        =   'tbl_product_details';
    protected $fillable     =   ['id','product_id','product_name','product_knotcnt','product_size','product_order','product_status','product_pileheight','product_material','product_leadtime','product_technique'];



    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }


}
