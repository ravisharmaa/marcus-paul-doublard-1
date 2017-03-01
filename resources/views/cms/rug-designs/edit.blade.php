@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>{{strip_tags($data->product_name)}}</h1>
    <div class="goback" style="width:330px;">
        <a href="{{route('cms.rug-designs')}}">Back to {{$extra_values['scope']}}</a>    </div>
    <div class="clearboth"></div>
    <div class="breadcrumb">
        <a href="{{route('cms.dashboard')}}">Dashboard </a> &raquo;
        <a href="{{route('cms.rug-designs')}}"> Rug Designs </a>
        &raquo; {{ strip_tags($data->product_name) }}
    </div>

    <div class="accordion"><a href="JavaScript:void(0);" rel="seo_data" class="accordiontab" >CLICK HERE TO EDIT DETAIL</a></div>
    <div id="seo_data" class="accordionblock" style="display:none;">
        <div class="info">
            Provide the details that you wish to update.
        </div>

        {{Form::model($data,['route'=>[$base_route.'.update',$data->product_id],'method'=>'PUT','id'=>'form_rug_add','enctype'=>'multipart/form-data','files'=>true])}}
        @include('cms.rug-designs.partials._form',['btnText'=>'Save'])
        <table border="0" class="myform">
        <tr  class="myform hide" style="display:none">
        <tr>
            <td class="formleft">&nbsp;</td>
            <td class="formright">
                {{Form::submit("Save",['class'=>'mybtn rug_add'])}}
                <div class="saving">Saving...</div>
            </td>
        </tr>
        </table>
        {{Form::close()}}

        <script>

            $(".chb").change(function() {
                $(".chb").prop('checked', false);
                $(this).prop('checked', true);
            });

            $(".yes").click(function(){
                $(".hide").show();

            });
            $(".no").click(function(){
                $(".hide").hide();

            });
        </script>
    </div>
    <div class="accordion"><a href="JavaScript:void(0);" rel="pro_list" class="accordiontab" style='background: url(images/tgup.png) no-repeat right #E30B5D;'>CLICK HERE TO MANAGE  COLOURWAYS </a></div>
    <div id="pro_list" class="accordionblock" style="display:block;">
        <div class="info">
            Provided below are the products that feature within the {{ strip_tags($data->product_name) }} rugs page.
            <br><br>
            Click the "Add a Colourway" button below if you wish to add a colourway.
            <br><br>
            Click on the image or pencil icon to edit its detail.
            <br><br>
            In the unlikely event that you wish to delete a collection, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
            <br><br>
            If you wish to change the order in which collections are displayed, you can drag and drop to an alternative position.
        </div>
        <div class="myadd">
            <a href="{{route($base_route.'.colourway.add',[$data->product_id])}}" class="colourway_add_link fancybox.ajax">Add a Colourway</a>
        </div>
        <div  data-attr="{{$data->product_id}}" class="clearboth"></div>
        <script>
            $(function(){
                $('.colourway_add_link').fancybox();
            });
        </script>
        <div id="pro_block">
            <div class="pleasewait">Please wait...</div>
            <script>
                $(function(){
                    $.ajax({
                        url: '{{route($base_route.'.colourway.show',[$data->product_id])}}',
                        type: 'get',
                        data: {},
                        success: function(data){
                            $('#pro_block').html(data);
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="clearboth"></div>

    <div class="accordion"><a href="JavaScript:void(0);" rel="cat_detail" class="accordiontab" >CLICK HERE TO EDIT SEO</a></div>
    <div id="cat_detail" class="accordionblock" style="display:none;">
        <div class="info">
            Provide the  SEO details that you wish to update.
        </div>

        {{Form::model($data,['route'=>[$base_route.'.update_seo',$data->product_id],'method'=>'PUT','id'=>'form_rug_add','enctype'=>'multipart/form-data','files'=>true])}}
        <table border="0" class="myform">
            <tr>
                <td class="formleft">Title Tag</td>
                <td class="formright">
                    {{Form::text('product_title_tag',null,['class'=>'mytextbox','id'=>'product_size'])}}
                </td>
            </tr>
            <tr>
                <td class="formleft">Meta Keywords</td>
                <td class="formright">
                    {{Form::text('product_meta_key',null,['class'=>'mytextbox','id'=>'product_size'])}}
                </td>
            </tr>

            <tr>
                <td class="formleft">Meta Description</td>
                <td class="formright">
                    {{Form::textarea('product_meta_desc',null,['class'=>'mytextbox','id'=>'product_size'])}}
                </td>
            </tr>


            <tr  class="myform hide" style="display:none">
            <tr>
                <td class="formleft">&nbsp;</td>
                <td class="formright">
                    {{Form::submit("Save",['class'=>'mybtn rug_add'])}}
                    <div class="saving">Saving...</div>
                </td>
            </tr>
        </table>
        {{Form::close()}}

        <script>

            $(".chb").change(function() {
                $(".chb").prop('checked', false);
                $(this).prop('checked', true);
            });

            $(".yes").click(function(){
                $(".hide").show();

            });
            $(".no").click(function(){
                $(".hide").hide();

            });
        </script>
    </div>

@endsection

@section('extra-scripts')

@endsection