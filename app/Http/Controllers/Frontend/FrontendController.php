<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-02-09
 * Time: 11:11 AM
 */

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Model\Colourway;
use App\Model\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Model\Product;
use Illuminate\Support\Facades\Session;


class FrontendController extends FrontendBaseController
{
    protected $view_path    =   'frontend';
    protected $base_route   =   'marcus-paul';
    protected $extra_values =   [];
    protected $mail         =   'frontend.emails';

    public function __invoke()
    {
        $this->extra_values['route_name']   =  Route::currentRouteName();
        return view(parent::loadDefaultVars($this->view_path.'.home',$this->extra_values));
    }

    public function rugDesigns()
    {
        $data = [];
        $data['product']    = Product::select(
            'tbl_products.product_id',
            'tbl_products.product_name',
            'tbl_products.product_alias',
            'tbl_products.product_image',
            'tbl_product_details.product_status',
            'tbl_colourways.colourway_th_image',
            'tbl_colourways.colourway_default'
        )->leftJoin('tbl_product_details','tbl_product_details.product_id','=','tbl_products.product_id')
            ->leftJoin('tbl_colourways','tbl_colourways.product_id','=','tbl_products.product_id')
            ->where('tbl_colourways.colourway_default','=',1)
            ->where('tbl_product_details.product_status','=',1)
            ->orderBy('tbl_product_details.product_order','asc')
            ->get();

        return view(parent::loadDefaultVars($this->view_path.'.rug-designs'),compact('data'));
    }

    public function beSpokeRugs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.bespoke-rug-service'));
    }

    public function aboutUs()
    {
        return view(parent::loadDefaultVars($this->view_path.'.about-us'));
    }

    public function contactUs()
    {
        $this->extra_values['route_name']   =  Route::currentRouteName();
        return view(parent::loadDefaultVars($this->view_path.'.contact-us'));
    }

    public function sendMail(Request $request)
    {
        $code = $request->input('CaptchaCode1');
        $isHuman = captcha_validate($code);
        $isHuman=1;
        if($isHuman){
            $data = [
                'fullname'   =>         $request->get('full_name'),
                'email'      =>         $request->get('email'),
                'message'    =>         $request->get('message'),
            ];

            Mail::send($this->mail.'.subscription',['data'=>$data], function ($message) use ($data){
                $message->from('marcus@marcuspaul.com','Marcus Paul');
                $message->to($data['email']);
                $message->subject("FW: Marcus Paul Rugs: Enquiry Received");
            });
            return response()->json(json_encode([
                'Success'=>'true'
            ]));
        } else {
            return response()->json(json_encode([
                'success'=>'false'
            ]));
        }

    }

    public function rugDetails($alias)
    {
        $data = [];
        $data['product'] = Product::select('tbl_products.product_id','tbl_products.product_name',
            'tbl_products.product_alias',
            'tbl_products.product_desc',
            'tbl_products.product_image',
            'tbl_product_details.product_knotcnt',
            'tbl_product_details.product_size',
            'tbl_product_details.product_material',
            'tbl_product_details.product_pileheight',
            'tbl_product_details.product_technique',
            'tbl_product_details.product_leadtime',
            'tbl_product_details.product_status',
            'tbl_colourways.colourway_name',
            'tbl_colourways.colourway_id',
            'tbl_colourways.colourway_alias',
            'tbl_colourways.colourway_lg_image')
            ->leftJoin('tbl_product_details','tbl_product_details.product_id','=','tbl_products.product_id')
            ->leftJoin('tbl_colourways','tbl_colourways.product_id','=','tbl_products.product_id')
            ->where('tbl_product_details.product_status','=',1)
            ->where('tbl_products.product_alias','=',$alias)
            ->where('tbl_colourways.colourway_default','=',1)
            ->first();




        $data['colourway'] = Colourway::select('tbl_colourways.colourway_id',
            'tbl_products.product_id',
            'tbl_colourways.colourway_id',
            'tbl_colourways.product_id',
            'tbl_colourways.colourway_name',
            'tbl_colourways.colourway_name',
            'tbl_colourways.colourway_th_image',
            'tbl_colourways.colourway_lg_image',
            'tbl_colourways.colourway_order'
        )->leftJoin('tbl_products','tbl_products.product_id','=','tbl_colourways.product_id')
            ->where('tbl_colourways.colourway_status',1)
            ->where('tbl_products.product_alias','=',$alias)
            ->orderBy('tbl_colourways.colourway_order','asc')
            ->get();

        $nextPrevious = Product::find($data['product']->product_id);
        $order  = $nextPrevious->product_detail;

        $data['previous']= ProductDetail::where('product_order','<',$order->product_order)->orderBy('product_order','desc')->first();

        $data['next'] = ProductDetail::where('product_order', '>', $order->product_order)->orderBy('product_order')->first();
        return view(parent::loadDefaultVars($this->view_path.'.rug_details'), compact('data'));
    }

    public function getColourwayData($id)
    {
        $data = Colourway::findOrFail($id);
        return response()->json(json_encode([
            'success'       =>'true',
            'data'        => [$data, $data->product]

        ]));
    }

    public function enquireForm($product_alias, $colourway_alias=null)
    {
        $data = Product::select('tbl_products.product_id',
                                'tbl_products.product_image',
                                'tbl_products.product_name',
                                'tbl_products.product_alias',
                                'tbl_colourways.product_id',
                                'tbl_colourways.colourway_id',
                                'tbl_colourways.colourway_name',
                                'tbl_colourways.colourway_th_image')
            ->leftJoin('tbl_colourways','tbl_colourways.product_id','=','tbl_products.product_id')
            ->where('tbl_products.product_alias','=',$product_alias)
            ->where('tbl_colourways.colourway_alias','=',!is_null($colourway_alias)?$colourway_alias:'')->first();
        return view(parent::loadDefaultVars($this->view_path.'.enquire'),compact('data'));
    }

    public function sendForm(Request $request)
    {
        $mail_data = [
            "full_name" => $request->get('full_name'),
            "email"     => $request->get('email'),
            "telephone" => $request->get('telephone'),
            "message"   => $request->get('message')
        ];
        $colourway  = Colourway::findOrFail($request->get('colourway_id'));

        Mail::send($this->mail.'.testmail',['mail_data'=>$mail_data,'product_data'=> $colourway ], function ($message) use ($mail_data, $colourway){
            $message->from('marcus@marcuspaul.com','Marcus Paul');
            $message->to($mail_data['email']);
            $message->subject("FW: Marcus Paul Rugs: Enquiry Received");
        });
        Mail::send($this->mail.'.admin_mail',['mail_data'=>$mail_data,'product_data'=>$colourway], function ($message) use ($mail_data,$colourway ){
            $message->from($mail_data['email']);
            $message->to('ravi@doublarddesign.com','Ravi Sharma');
            $message->subject("FW: Marcus Paul Rugs: Enquiry Details");
        });
        return redirect()->back()->with(['message'=>'Enquiry Has been Sent Successfully']);
    }




}