@extends($master)
@section('title')
    Marcus Paul | Contact Us
@endsection
@section('extra-css')
    <style>
    .BDC_SoundIcon{
    display: none; !important;
    }
    .BDC_ReloadIcon{
    display: none; !important;
    }
    .BDC_CaptchaImageDiv{
    height: 50px;
    }
    .BDC_CaptchaImageDiv > a {
    display: none; !important;

    }
    #MyCaptcha_CaptchaImageDiv{
    height:50px;
    }
    </style>
@endsection
@section('home-section')
    <div class="mp-wrapper">
@endsection
@section('content')
    <div class="mp-section">
        <div class="mp-coll-bg mp-con-detail">
            <h1>Contact Us</h1>
            <div class="mp-in-page">
                <p>To send an enquiry, please complete the form below and click submit.</p>
                <div class="row">
                    <div id="contact_box" class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-body le-ri-padding">
                            {{Form ::open(['route'=> $base_route.'.send-mail','method'=>'POST','class'=>'form-horizontal'])}}
                                @include('frontend.partials._forms._contactform', ['submitBtn'=>'Submit'])
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="mp-cont-info">
                            <h2>Marcus Paul Rugs</h2>
                            <p>Unit 1B Theaklen House,<br class="hidden-xs hidden-sm"> Theaklen Drive, St Leonards on Sea,<br class="hidden-xs hidden-sm"> East Sussex TN38 9AZ, United Kingdom<br><br>
                                Tel: +44 (0)1424 403000 &nbsp;<br> Email: <a href="mailto:orders@marcuspaulrugs.com">orders@marcuspaulrugs.com</a>
                            </p>
                            <p>
                                <span>Distributed by in the UK Tim Page Carpets</span>
                                Design Centre Chelsea Harbour<br>
                                Lots Road, London, SW10 0XE<br><br>
                                Tel: +44 (0)20 7259 7282<br>
                                Email: <a href="mailto:sales@timpagecarpets.com" target="_blank">sales@timpagecarpets.com</a><br>
                                <a href="http://www.timpagecarpets.com/" target="_blank">www.timpagecarpets.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@section('extra-scripts')

    <script>
       $("document").ready(function(){

           $("#btn").click(function (e) {
                e.preventDefault();
                var name        =   $("#full_name").val();
                var email       =   $("#email").val();
                var message     =   $("#message").val();
                var captcha     =   $("#CaptchaCode").val();
                var _token      =   '{{ csrf_token() }}';
                var params      =   {'full_name':name,'email':email,'message':message,'CaptchaCode':captcha,'_token':_token };
                    $.ajax({
                        method  : "POST",
                        url     : '{{route($base_route.'.send-mail')}}',
                        data    : params,
                        error: function(request){
                            var response = jQuery.parseJSON(request.responseText);
                            console.log(response);
                            if (response){
                                (response.full_name)    ? $("#danger_name").html(response.full_name):$("#danger_name").html('');
                                (response.email)        ? $("#danger_email").html(response.email):$("#danger_email").html('');
                                (response.message)      ? $("#danger_message").html(response.message):$("#danger_message").html('');
                                (response.CaptchaCode) ? $("#danger_captcha").html(response.CaptchaCode):$("#danger_captcha").html('');
                            }
                        },
                        success: function (data){
                            var newData = jQuery.parseJSON(data);
                            if(newData.Success == true){

                            }
                        }
                    });
          });
       });
    </script>
@endsection