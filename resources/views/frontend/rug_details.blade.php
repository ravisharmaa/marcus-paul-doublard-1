@extends($master)
@section('title')
    <title> {{ strip_tags($data['product']->product_name) }} | Rug Designs | Marcus Paul | Hand Woven Rugs </title>
@endsection
@section('extra-css')
@endsection
@section('home-section')
    <div class="mp-wrapper">
        @endsection
        @section('content')
            <div class="mp-section">
                <div class="mp-coll-bg">
                    <div class="row">
                        <div class="col-md-2 hidden-xs hidden-sm ">
                            <div class="aside left">
                                <h4 class="mp-color">Colourway(s)</h4>
                                <ul>
                                    @foreach($data['colourway'] as $c)
                                        <li>
                                            <a href="" class="colourway_data" data-id="{{ $c->colourway_id }}">
                                                <img data-original="{{asset('images/colourway/th/'.$c->colourway_th_image)}}" src="{{asset('assets/frontend/img/load.png')}}" alt="{{$data['product']->product_name. ' - ' .$c->colourway_name}}" title="{{!empty($c->colourway_name) ? $data['product']->product_name.' - '.$c->colourway_name: $data['product']->product_name}}" class="img-full load">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            {{$data['colourway']->links()}}
                            <!-- aside end-->
                                <div class="clearfix"></div>
                            </div>
                            <!-- col-md-2 end-->
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10 ">
                            <div class="mp-detail-img right">
                                <div class="mp-breadcrumb">
                                    <ul class="pull-left">
                                        <li><a href="{{route('marcus-paul.rug-designs')}}">Back to Index</a></li>
                                    </ul>
                                    <ul class="pull-right">
                                        @if(!is_null($data['previous']))
                                            <li><a href="{{route($base_route.'.rug-design-details',[$data['previous']->product->product_alias])}}">Previous</a></li>
                                        @endif
                                        @if(!is_null($data['next']))
                                            <li><a href="{{route($base_route.'.rug-design-details',[$data['next']->product->product_alias])}}">Next </a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-7">
                                        <div class="mp-detail">
                                            <h2>{!! isset($data['product']->product_name)   ? $data['product']->product_name:'' !!}</h2>
                                            <h3 class="colourway_name">{{isset($data['product']->colourway_name) ? $data['product']->colourway_name:''}}</h3>

                                            <div class="mp-zoom-img visible-xs"><!-- mobile view -->
                                                <div class="relative">
                                                    <a class="image_data img-pop" href="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}">
                                                        <img src="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}" class="main_image img-full " alt="{{$data['product']->product_name. ' - ' .$data['product']->colourway_name}}" title="{{$data['product']->colourway_name.' - '.$data['product']->product_name}}" />
                                                    </a>
                                                    <div class="clickToEn">
                                                        <a class="image_data_click img-pop" href="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}">
                                                            <span>Click to enlarge</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!-- mobile view -->

                                            <p>
                                                {{isset($data['product']->product_desc) ? $data['product']->product_desc:''}}
                                            </p>
                                            <h5>Details</h5>
                                            <dl class="clearfix">
                                                <dt>Knot Count:</dt>
                                                <dd>{{isset($data['product']->product_knotcnt) ? $data['product']->product_knotcnt:''}}</dd>
                                                <div class="clearfix"></div>
                                                <dt>Size:</dt>
                                                <dd>{{isset($data['product']->product_size) ? $data['product']->product_size:''}} </dd>
                                                <div class="clearfix"></div>
                                                @if(!empty($data['product']->product_material))
                                                    <dt>Material:</dt>
                                                    <dd>{{$data['product']->product_material }} </dd>
                                                    <div class="clearfix"></div>
                                                @endif
                                                @if(!empty($data['product']->product_pileheight))
                                                    <dt>Pile Height:</dt>
                                                    <dd>{{$data['product']->product_pileheight }} </dd>
                                                    <div class="clearfix"></div>
                                                @endif
                                                @if(!empty($data['product']->product_technique))
                                                    <dt>Applied Techniques:</dt>
                                                    <dd>{{$data['product']->product_technique }} </dd>
                                                    <div class="clearfix"></div>
                                                @endif
                                                @if(!empty($data['product']->product_leadtime))
                                                    <dt>Lead Times:</dt>
                                                    <dd>{{$data['product']->product_leadtime }} </dd>
                                                    <div class="clearfix"></div>
                                                @endif
                                            </dl>
                                            @if(!empty($data['product']->colourway_alias))
                                                <a href="{{route($base_route.'.enquire',[$data['product']->product_alias,$data['product']->colourway_alias])}}" id="enquire" class="enq-pop fancybox.ajax btn mp-enquire enqBtn">
                                                    <span>Enquire</span>
                                                </a>
                                            @else
                                                <a href="{{route($base_route.'.enquire',[$data['product']->product_alias])}}" id="enquire" class="enq-pop fancybox.ajax btn mp-enquire enqBtn">
                                                    <span>Enquire</span>
                                                </a>
                                            @endif
                                            <script>
                                                $("document").ready(function(){
                                                    $(".enq-pop").fancybox();
                                                });
                                            </script>
                                            {{--<!-- <button type="button" name="Download Tear Sheet" class="btn mp-enquire tearSheet" href="#">--}}
                                            {{--<span>Tear sheet with colours</span>--}}
                                            {{--</button> -->--}}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-5 hidden-xs">
                                        <div class="mp-zoom-img">
                                            <div class="relative">
                                                <a  class="image_data img-pop" href="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}">
                                                    <img  src="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}" class="main_image img-full " alt="{{!empty($data['product']->colourway_name) ? $data['product']->product_name. ' - ' .$data['product']->colourway_name : $data['product']->product_name}}" title="{{!empty($data['product']->colourway_name) ? $data['product']->product_name. ' - ' .$data['product']->colourway_name : $data['product']->product_name}}" />
                                                </a>
                                                <div class="clickToEn">
                                                    <a class="image_data_click img-pop" href="{{asset('images/colourway/lg/'.$data['product']->colourway_lg_image)}}">
                                                        <span>Click to enlarge</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- detail-row end-->
                                </div>
                            </div>
                        </div>

                        <!-- small device -->
                        <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
                            <div class="aside">
                                <h4 class="mp-color">Colourway(s)</h4>
                                <ul class="clearfix">
                                    @foreach($data['colourway'] as $c)
                                        <li><a href="" class="colourway_data" data-id="{{ $c->colourway_id }}">
                                                <img data-original="{{asset('images/colourway/th/'.$c->colourway_th_image)}}" src="img/load.png" alt="" class="img-full load">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- aside end-->
                            </div>
                            <!-- col-md-2 end-->
                        </div>
                        <!-- row end -->
                    </div>
                    <div class="clearfix"></div>
                    <!-- mp-coll-bg end-->
                </div>
                <div class="clearfix"></div>
                <!-- mp-section end -->
            </div>
        @endsection
        @section('extra-scripts')
            <script>
                $(function() {
                    $(".img-pop").fancybox({
                        autoCenter	: true,
                        closeClick	: true,
                        closeEffect	: 'fade',
                        maxHeight	: '90%',
                        openEffect	: 'fade',
                        openSpeed   : 'slow',
                        nextEffect	: 'fade',
                        prevEffect	: 'fade',
                        padding		:  0,
                        scrolling	: 'hidden',
                        helpers: {
                            overlay: {
                                locked: true,
                                closeClick: false
                            }
                        }
                    });
                    $(".enq-pop").fancybox({
                        maxWidth	: 600,
                        padding		: 0,
                        width		: '100%',
                        autoSize	: false,
                        openEffect: 'fade',
                        'transitionIn' : 'fade',
                        'transitionOut' : 'fade',
                        scrolling   : 'hidden',
                        helpers: {
                            overlay : {
                                locked: true,
                                closeClick: false
                            }
                        }
                    });
                    $('.flexslider').flexslider({
                        animation: "slide",
                        start: function(slider){
                            //$('body').removeClass('loading');
                        }
                    });
                });

            </script>

            <script>
                $("document").ready(function(){
                    $(".colourway_data").click(function(e){
                        e.preventDefault();
                        var $this            =     $(this);
                        var id               =     $this.attr('data-id');
                        var url              =    '{{asset('/')}}';
                        var base_route       =     '{{ route($base_route.'.enquire') }}';

                        $.ajax({
                            method: "GET",
                            url : ' {{url('get-colourway-data')}}'+'/'+ id,
                            error:function (request) {
                                console.log(request.responseText);
                            },
                            success:function (data) {
                                var newData = jQuery.parseJSON(data);
                                console.log(newData);
                                console.log(newData.data[0].colourway_lg_image);
                                if(newData.data[0].colourway_name){
                                    $(".colourway_name").html('<h3>'+ newData.data[0].colourway_name + '</h3>' );
                                    $(".image_data").attr('href',url +'images/colourway/lg/'+ newData.data[0].colourway_lg_image);
                                    $(".image_data_click").attr('href',url +'images/colourway/lg/'+ newData.data[0].colourway_lg_image);
                                    $(".main_image").attr('src', url+'images/colourway/lg/'+newData.data[0].colourway_lg_image).prop('title',newData.data[1].product_name+ ' - '+ newData.data[0].colourway_name);
                                    $("#enquire").attr('href', base_route +'/'+newData.data[1].product_alias + '/'+ newData.data[0].colourway_alias);
                                }

                            }

                        })
                    });
                });

            </script>

            <script>
                $("document").ready(function(){
                    $("#previous").click(function(e){
                        e.preventDefault();
                        var id = $('#previous').attr('data-id');
                        var token = '{{ csrf_token() }}';
                        var params = {'id':id,'_token':token};
                        $.ajax({
                            method : "POST",
                            url    : '{{route($base_route.'.enquire.previous')}}',
                            data    : params,
                            error:function(request){
                                console.log(request.responseText);
                            },

                            success:function(data){
                                var myData = jQuery.parseJSON(data);
                            }
                        });

                    });
                })
                $(window).load(function() {
                    var height = Math.max($(".left").outerHeight(true), $(".right").outerHeight(true));
                    $(".left").outerHeight(height);
                    $(".right").outerHeight(height);
                });
                $(window).bind('orientationchange', function() {
                    var height = Math.max($(".left").outerHeight(true), $(".right").outerHeight(true));
                    $(".left").outerHeight(height);
                    $(".right").outerHeight(height);
                    window.location.reload();
                });

            </script>

            <script>
                $("document").ready(function(){
                    $(".pagination a").click(function(e){
                        e.preventDefault();
                        var page = $(this).attr('href').split('page=')[1];
                        getData(page);

                    });

                    function getData(page)
                    {
                        $.ajax({
                            url: '{{url('rug-design-details/'.$data['product']->product_alias)}}'+'/'+page
                        }).done(function(data){

                        });
                    }
                })
            </script>

@endsection