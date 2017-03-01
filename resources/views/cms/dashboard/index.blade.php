@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>Dashboard</h1>
    <div class="clearboth"></div>
    <div class="dashboard_paragraph">
        <p>Dear {{Auth::user()->username}},</p>
        <p>Welcome to <b></b> website content management system.</p>
        <p>Do not forget to <a href="{{url('cms/logout')}}" class="mylink1">logout</a> when you have finished using the system.</p>
        <p style="margin-top:10px;">Please click the required area that you wish to manage below:</p>
    </div>

    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['Rug Designs','cms.rug-designs']) !!}
    </div>
    </div>

    <div class="spacer20"></div>
    <div class="spacer20"></div>
    <div class="clearboth"></div>
@endsection
@section('extra-scripts')
@endsection