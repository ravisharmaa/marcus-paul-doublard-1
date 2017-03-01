<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-13
 * Time: 12:43 PM
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Colourway;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Classes\AppHelper;


class ColourwaysController extends AdminBaseController
{
    protected $base_route       =   'cms.rug-designs.colourway';
    protected $view_path        =   'cms.colourway';
    protected $upload_folder    =   'images/rugs/';


    public function add($id)
    {
        $product_data = Product::findOrFail($id);
        return view(parent::siteDefaultVars($this->view_path.'.add'),compact('product_data'));
    }

    public function store(Request $request)
    {

        $imageName_th = null;
        $imageName_lg = null;

        if($request->hasFile('colourway_th_image')) {
            $colourway_th_image = $request->file('colourway_th_image');
            $imageName_th = AppHelper::uploadImage($colourway_th_image, $this->upload_folder.'colourway/th/');
        }
        if($request->hasFile('colourway_lg_image')) {
            $colourway_lg_image = $request->file('colourway_lg_image');
            $imageName_lg = AppHelper::uploadImage($colourway_lg_image, $this->upload_folder.'colourway/lg/');
        }


        $data = Colourway::create([
            'product_id'                => $request->get('product_id'),
            'colourway_name'            => $request->get('colourway_name'),
            'colourway_description'     => $request->get('colourway_description'),
            'colourway_alias'           => $this->setUniqueNameOnCreate($request->get('colourway_name')),
            'colourway_th_image'        => $imageName_th,
            'colourway_lg_image'        => $imageName_lg,
            'colourway_default'         => $request->get('colourway_default'),
            'colourway_order'           => $this->setOrderOnCreate($request->get('product_id')),
            'colourway_status'          => 1
        ]);

        if($data->colourway_default ==1)
            Colourway::where('product_id', $data->product_id)->where('colourway_id','!=',$data->colourway_id)
                ->update(['colourway_default'=>'0']);

        return redirect()->back();
    }



    public function delete($id)
    {
        $data = Colourway::findOrFail($id);
        $data->colourway_status = 3;
        $data->save();
        return redirect()->back();
    }

    public function show($id)
    {
        $data = [];
        $data['product']     =   Product::findOrFail($id);
        $data['colourways']  =   $data['product']->colourways()->orderBy('colourway_order','asc')->where('colourway_status','!=',3)->get();
        return view(parent::siteDefaultVars($this->view_path.'.partials._showdata'),compact('data'));
    }


    public function edit($id)
    {
        $data = [];
        $data['colourway']  = Colourway::findOrFail($id);
        $data['product']    = Product::findOrFail($data['colourway']->product_id);
        return view(parent::siteDefaultVars($this->view_path.'.edit',$this->getExtraValues()), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data                           =   Colourway::findOrFail($id);
        $data->colourway_name           =   $request->get('colourway_name');
        $data->colourway_description    =   $request->get('colourway_description');
        $data->colourway_default        =   $request->get('colourway_default');
        $data->colourway_alias          =   $this->setUniqueNameOnCreate($request->get('colourway_name'));

        if($request->hasFile('colourway_th_image')){
            $colourway_th_image         = $request->file('colourway_th_image');
            File::delete($this->upload_folder.'colourway/th/'.$data->colourway_th_image);
            $imageName_th               = AppHelper::uploadImage($colourway_th_image, $this->upload_folder.'colourway/th/');
            $data->colourway_th_image   = $imageName_th;
        }

        if($request->hasFile('colourway_lg_image')) {
            File::delete($this->upload_folder.'colourway/lg/'.$data->colourway_lg_image);
            $colourway_lg_image         = $request->file('colourway_lg_image');
            $imageName_lg               = AppHelper::uploadImage($colourway_lg_image, $this->upload_folder.'colourway/lg/');
            $data->colourway_lg_image   = $imageName_lg;
        }
        $data->save();
        if($data->colourway_default ==1)
            Colourway::where('product_id', $data->product_id)->where('colourway_id','!=',$data->colourway_id)
                ->update(['colourway_default'=>'0']);

        return redirect()->back();

    }
    public function changeDefault(Request $request)
    {
        $id             = $request->get('id');
        $colour_data    = Colourway::findOrFail($id);
        
        if($colour_data->colourway_default==1)
            $colour_data->colourway_default =0;
        else
            $colour_data->colourway_default = 1;
        
        $colour_data->save();

        $data = Colourway::   where('product_id', $colour_data->product_id)
            ->where('colourway_id','!=',$colour_data->colourway_id)
            ->update(['colourway_default'=>'0']);

        return response()->json(json_encode([
            'success'   => 'true',
        ]));
    }

    public function getExtraValues()
    {
        $extra_values           =   [];
        $extra_values['scope']  =   'Rug Designs';
        return $extra_values;
    }

    protected function setOrderOnCreate($product_id)
    {
        $colourway_order        = Colourway::where('product_id',$product_id)->max('colourway_order');
        return $colourway_order = is_null($colourway_order) ? 1 : $colourway_order+1;
    }


    public function publishedStatus(Request $request)
    {

        $id = $request->get('id');
        $data = Colourway::find($id);
        
        if($data->colourway_status === 1)
           $data->colourway_status = 0;
        else
           $data->colourway_status = 1;

        $data->save();

       return response()->json(json_encode([
           'success'    =>  'true',
           'data'       =>  $data->colourway_status
       ]));


    }


    public function changeOrder(Request $request)
    {
       $order = $request->get('order');
       $i =1 ;
       foreach ($order as $id)
       {
           $data = Colourway::findOrFail($id);
           $data->colourway_order = $i;
           $data->save();
           $i++;
       }
       return response()->json(json_encode([
           'success' => 'true',
           'order'   => $data->colourway_oder
       ]));
    }

    public function setUniqueNameOnCreate($colourway_name)
    {
        $product_name_data  = Colourway::select('colourway_name')->where('colourway_name','=',$colourway_name)->first();
        return $product_name = str_slug($product_name_data['colourway_name'] === $colourway_name ? $colourway_name.'1':$colourway_name);
    }


}