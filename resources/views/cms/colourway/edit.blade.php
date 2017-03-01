@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>{{ucfirst($data['colourway']->colourway_name)}}</h1>
    <div class="goback"><a href="{{route('cms.rug-designs.edit',$data['product']->product_id)}}">Back to {{$data['product']->product_name}}</a></div>
    <div class="clearboth"></div>
    <div class="breadcrumb"> <a href="{{route('cms.dashboard')}}">Dashboard</a> &raquo;
        <a href="{{route('cms.rug-designs')}}"> Rug-Designs </a> &raquo; <a href="{{route('cms.rug-designs.edit',$data['product']->product_id)}}">{{$data['product']->product_name}}</a> &raquo; {{$data['colourway']->colourway_name}} </div>
    <br />
    <div class="clearboth"></div>
    <div style="float:left; margin-right:40px; width: 350px;" class="main_img">
        <img src="{{asset('images/colourway/th/'.$data['colourway']->colourway_th_image)}}" width="300" border="0" />
    </div>
    <div style="float:left; width: 570px;" class="summary4">
        <style>
            .summary4 p{
                margin-bottom: 6px;
            }
        </style>
        <div class="clearboth"></div>

        <div style="font-size: 11pt; border-bottom: 1px dotted #cccccc; padding-bottom:5px;">  <h3>Descriptions</h3></div>
        <br />
        <b>Product Description </b>:
        <br /><br />
        {{ $data['product']->product_desc }}
        <br /><br />
        <b>Product Knot Count </b>: {{ $data['product']->product_detail->product_knotcnt }}
        <br /><br />
        <b>Repeat</b>: {{$data['product']->product_detail->product_size }}
        <br /><br />
        <br /><br />
    </div>
    <div class="clearboth"></div>
    <div class="accordion"><a href="JavaScript:void(0);" rel="pro_detail" class="accordiontab" style='background: url(images/tgup.png) no-repeat right #E30B5D;'>CLICK HERE TO EDIT COLOURWAY DETAIL</a></div>
    <div id="pro_detail" class="accordionblock" style="display:block;">
        <div class="info"> Provide the product name and its detail that you wish to update. </div>
        {{ Form::model($data['colourway'],['route'=> [$base_route.'.update',$data['colourway']->colourway_id],'method'=>'PUT','enctype'=>'multipat/form-data','files'=>true])}}
        @include('cms.colourway.partials._form',['btnText'=>'Save'])
        {{ Form::close()}}
        <script>
            $(function(){
                $('.product_edit').click(function(){
                    var t=$(this);
                    t.hide();
                    $('.saving_detail').show();
                    $.ajax({
                        url: 'ajax/product_edit.php',
                        type: 'post',
                        data: $('#form_product_edit').serialize(),
                        success: function(){
                            //console.log('asdkjds');
                            $('.saving_detail').fadeOut(function(){
                                $('.saved_detail').show().delay(2000).hide(function(){
                                    t.show();
                                });
                            });
                            //window.location = "login.php?p_id=manage_product&id=608&show_tab=pro_detail";
                            alertify.success('Successfully Saved.');
                        }

                    })
                });
            });
        </script>
    </div>

@endsection
@section('extra-scripts')

@endsection