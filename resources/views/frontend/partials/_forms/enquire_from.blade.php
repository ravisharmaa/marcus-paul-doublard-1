<div class="form-group">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            {{Form::text('full_name', null,['id'=>"full_name", 'class'=>"form-control",'placeholder'=>"Name"])}}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            {{Form::text('email', null,['id'=>"email", 'class'=>"form-control",'placeholder'=>"Email"])}}
        </div>

    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
            {{Form::text('telephone', null,['id'=>"email", 'class'=>"form-control",'placeholder'=>"Telephone"])}}
        </div>

    </div>
</div>

<!-- Textarea -->
<div class="form-group">
    <div class="col-md-12">
        {{Form::textarea('message',null,['class'=>"form-control" ,'id'=>"message" ,'placeholder'=>"If you have a particular enquiry and would like to send us a message please write it here."])}}
    </div>
</div>

<!-- Textarea -->
{{--<div class="form-group">--}}
    {{--<div class="col-xs-6 col-sm-5 col-md-5">--}}
        {{--<img src="captcha/captchaForContactusForm.php?characters=5&amp;width=140&amp;height=35" class="capcha-img">--}}
    {{--</div>--}}
    {{--<div class="col-xs-6 col-sm-7 col-md-7">--}}
        {{--<input id="prependedtext" name="prependedtext" class="form-control" placeholder="" type="text">--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-12">
        {{Form::button($btnTxt,['class'=>'btn mp-btn-sub','type'=>'Submit'])}}
    </div>
</div>