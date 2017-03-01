<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table        =   'tbl_products';
    protected $primaryKey   =   'product_id';

    protected $fillable     =   ['product_id','product_name','product_desc','product_image','product_alias','product_title_tag','product_meta_key','product_meta_dsc'];



    public function product_detail()
    {
        return $this->hasOne('App\Model\ProductDetail','product_id');
    }

    public function colourways()
    {
        return $this->hasMany('App\Model\Colourway','product_id');
    }

}
