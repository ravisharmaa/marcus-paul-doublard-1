<div class="mp-modal-box">
    <h4>Enquire Now</h4>
    <div class="form-body">
        <div class="mp-color-img">
            <img src="{{asset('images/colourway/th/'.$data->colourway_th_image)}}" alt="" class="img-full ">
            <p>{{$data->product_name}}  {{!empty($data->colourway_name) ?'- '.$data->colourway_name:'' }}</p>
            <div class="clearfix"></div>
        </div>
        <div class="mp-form-content">
                {{Form::open(['route'=>$base_route.'.send-form','class'=>'form-horizontal'])}}
                    {{Form::hidden('product_id',$data->product_id)}}
                    {{Form::hidden('colourway_id',$data->colourway_id)}}
                    @include('frontend.partials._forms.enquire_from',['btnTxt'=>'Submit'])
                {{Form::close()}}
        </div>
    </div>

</div>

