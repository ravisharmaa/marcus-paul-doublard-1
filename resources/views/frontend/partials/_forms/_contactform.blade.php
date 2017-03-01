
<div class="form-group ma-btm">
    <div class="col-md-12">
    <label id="danger_name" style="color:red;">&nbsp;</label>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            {{Form::text('full_name', null,['id'=>"full_name", 'class'=>"form-control",'placeholder'=>"Full Name"])}}
        </div>
    </div>
</div>

<div class="form-group ma-btm">
    <div class="col-md-12">
    <label id="danger_email" style="color:red;">&nbsp;</label>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            {{Form::text('email', null,['id'=>"email", 'class'=>"form-control",'placeholder'=>"Email"])}}
        </div>
    </div>
</div>

<div class="form-group ma-btm">
    <div class="col-md-12">
        <label id="danger_message" style="color:red;">&nbsp;</label>
        {{Form::textarea('message',null,['class'=>"form-control" ,'id'=>"message" ,'placeholder'=>"If you have a particular enquiry and would like to send us a message please write it here."])}}
    </div>
</div>

<label id="danger_captcha" style="color:red;">&nbsp;</label>
<div class="form-group">
    <div class="col-xs-6 col-sm-4 col-md-5">
        {!! captcha_image_html('CustomerCaptcha') !!}
    </div>
    <div class="col-xs-6 col-sm-8 col-md-7">
        <input type="text"  style="padding:2px 5px;border: 1px solid #ab9b94;" class="form-control" id="CaptchaCode1" name="CaptchaCode1">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {{Form::button($submitBtn,['id'=>'btn','class'=>'btn mp-btn-sub','type'=>'submit'])}}
    </div>
</div>
