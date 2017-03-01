<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Classes\AppHelper;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Colourway;
use App\Model\ProductDetail;
use App\Model\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\Flysystem\Exception;


class RugDesignsController extends AdminBaseController
{
    protected $base_route       =   'cms.rug-designs';
    protected $view_path        =   'cms.rug-designs';
    protected $upload_folder    =   'images/colourway';

    public function index()
    {
        $data = Product::select('product_id','product_name','product_image')->get();
        return view(parent::siteDefaultVars($this->view_path.'.index'), $this->getExtraValues(), compact('data'));
    }

    public function add()
    {
        return view(parent::siteDefaultVars($this->view_path.'.add'));
    }

    public function store(Request $request)
    {
        $imageName = null;
        if($request->hasFile('product_image')) {
            $image      = $request->file('product_image');
            $imageName  = AppHelper::uploadImage($image,$this->upload_folder.'/rug-designs/lg/');
        }
        $product_order      = ProductDetail::max('product_order');

        $data = Product::create([
                'product_name'      => $request->get('product_name'),
                'product_desc'      => $request->get('product_desc'),
                'product_alias'     => $this->setUniqueNameOnCreate($request->get('product_name')),
                'product_image'     => $imageName,
                'product_title_tag' => $request->get('product_title_tag'),
                'product_meta_key'  => $request->get('product_meta_key'),
                'product_meta_desc' => $request->get('product_meta_desc'),
            ]);

        ProductDetail::create([
                 'product_id'           => $data->product_id,
                'product_knotcnt'       => $request->get('product_knotcnt'),
                'product_size'          => $request->get('product_size'),
                'product_material'      => $request->get('product_material'),
                'product_pileheight'    => $request->get('product_pileheight'),
                'product_technique'     => $request->get('product_technique'),
                'product_leadtime'      => $request->get('product_leadtime'),
                'product_order'         => is_null($product_order) ? 1: $product_order+1,
                'product_status'        =>  1
            ]);

        return redirect()->route($this->base_route.'.edit',[$data]);

    }


    public function delete($id)
    {
        $data = Product::findOrFail($id);
        File::delete($this->upload_folder.'/rug-designs/lg/'. $data->product_image);
        $data->delete();
        return view(parent::siteDefaultVars($this->view_path.'.index'));
    }

    public function show()
    {
        $data = Product::select('tbl_products.product_id','tbl_products.product_name','tbl_products.product_desc','tbl_products.product_image','tbl_product_details.product_order','tbl_product_details.product_status')
            ->leftJoin('tbl_product_details','tbl_product_details.product_id','=','tbl_products.product_id')
            ->orderBy('tbl_product_details.product_order','asc')
            ->get();
        
        return view(parent::siteDefaultVars($this->view_path.'.partials._showdata'), compact('data'));
    }

    
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        return view(parent::siteDefaultVars($this->view_path.'.edit',$this->getExtraValues()), compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data                       =   Product::findOrFail($id);
        $data->product_name         =   $request->get('product_name');
        $data->product_desc         =   $request->get('product_desc');

        if($request->hasFile('product_image'))
        {
            File::delete($this->upload_folder.'/rug-designs/lg/'. $data->product_image);
            $image      = $request->file('product_image');
            $imageName = AppHelper::uploadImage($image,$this->upload_folder.'/rug-designs/lg/');
            $data->product_image = $imageName;
        }
        $data->save();
        
        $data->product_detail->product_knotcnt        =   $request->get('product_knotcnt');
        $data->product_detail->product_size           =   $request->get('product_size');
        $data->product_detail->product_material       =   $request->get('product_material');
        $data->product_detail->product_pileheight     =   $request->get('product_pileheight');
        $data->product_detail->product_technique      =   $request->get('product_technique');
        $data->product_detail->product_leadtime       =   $request->get('product_leadtime');
        $data->product_detail->save();

        return redirect()->route($this->base_route.'.edit',[$data]);

    }

    public function getExtraValues()
    {
        $extra_values = [];
        $extra_values['scope'] = 'Rug Designs';
        return $extra_values;
    }

    public function sorter(Request $request)
    {
        $orderArray = $request->get('order');
        $i = 1;
        foreach ($orderArray as $value)
        {
            $data = Product::findOrFail($value);
            $data->product_detail->product_order = $i;
            $data->product_detail->save();
            $i++;
        }
        return response()->json(json_encode([
            'message'=>'Success',
        ]));

    }

    public function setStatus(Request $request)
    {
        $id      = $request->get('id');
        $data    = Product::findOrFail($id);
        
        if($data->product_detail->product_status==1)
            $data->product_detail->product_status = 0;
        else
            $data->product_detail->product_status = 1;

        $data->product_detail->save();

        return response()->json(json_encode([
            'success'        => 'true',
            'product_status' =>  $data->product_detail->product_status
        ]));
    }


    public function setUniqueNameOnCreate($product_name)
    {
        $product_name_data  = Product::select('product_name')->where('product_name','=',$product_name)->first();
        return $product_name = str_slug($product_name_data['product_name'] === $product_name ? $product_name.'1':$product_name);
    }

    public function updateSeo(Request $request, $id)
    {

        $data = Product::findOrFail($id);
        $data->product_title_tag    =   $request->get('product_title_tag');
        $data->product_meta_key     =   $request->get('product_meta_key');
        $data->product_meta_desc    =   $request->get('product_meta_desc');
        $data->save();
        return redirect()->route($this->base_route.'.edit',[$data]);


    }
}