<ul id="sorter" class="polaroid ui-sortable">
    <?php $i = 1;?>
    @foreach($data as $d)
        <li id="{{$d->product_id}}" data-id="{{ $d->product_id }}">
        <div class="polaroidimg">
            <a href="{{route($base_route.'.edit', $d->product_id)}}">
                <img src="{{!empty($d->product_image) ? asset('images/rug-designs/lg/'.$d->product_image):asset('images/alternatives/replace-small.jpg')}}" width="200" border="0">
            </a>
        </div>
        <div class="polaroidlabel">
            <div class="tr">
                <div class="td">
                    <span class="product_sn"> {{ $i }}.  </span>{{strip_tags($d->product_name)}}
                </div>
            </div>
        </div>
        <div class="polaroidoption">
            <a href="{{route($base_route.'.edit', $d->product_id)}}"><img src="{{asset($default_images.'icon_edit.png')}}"
                                                                    width="24" height="24" border="0"></a>
            <a href="JavaScript:void(0);" data-id="{{$d->product_id}}" class="rug_del_link"><img src="{{asset($default_images.'icon_delete.png')}}" width="24" height="24" border="0"></a>

            @if($d->product_status == 1)
            <div style="float:right;width:66px;padding-top:5px;">
                <label><input type="checkbox" data-id="{{$d->product_id}}" class="publish_product" checked=""> Publish</label>
            </div>
            @else
                <div style="float:right;width:66px;padding-top:5px;">
                <label><input type="checkbox" data-id="{{$d->product_id}}" class="publish_product"> Publish</label>
            </div>
            @endif
            <div id="img-36" style="float:right;width:30px;display:none;">
                <img src="images/loading.gif" width="20" height="20" border="0">
            </div>
        </div>
    </li>
    <?php $i++;?>
    @endforeach
</ul>
<div class="clearboth"></div>

<script>
    $("document").ready(function(){
        $(".rug_del_link").click(function(){
           if(confirm('Do you want to delete this?')) {


               var $this = $(this);
               var id = $this.attr('data-id');
               $.ajax({
                   url: '{{url('cms/rug-designs/delete')}}' + '/' + id,
                   type: "GET",
                   error: function (request) {
                       console.log(request.responseText);
                   },
                   success: function (data) {
                       $this.parent().parent().hide();
                   }

               })
           }
           });

    });

    $("document").ready(function(){
        $("#sorter").sortable({
            opacity: 0.6,
            cursor: "move",
            update: function (event,ui) {
                var order    = $(this).sortable('toArray');
                var token    = '{{ csrf_token() }}';
                var params   =  {'order':order, '_token':token};
                $.ajax({
                    method : "POST",
                    data    : params,
                    url    : '{{ route($base_route.'.sort.product-order')}}',

                    error:function(request)
                    {
                        console.log(request.responseText);
                    },
                    success:function (data) {
                        //var newData = jQuery.parseJSON(data);
                        var slide_order = 0;
                        $(".product_sn").each(function(){
                            $(this).html(++slide_order +  '. ');
                        });
                    }
                })
            }
        })
    });

    $("document").ready(function () {
        $(".publish_product").click(function () {
            var id      =   $(this).attr('data-id');
            var token    = '{{ csrf_token() }}';
            var params  =   {'id':id, '_token':token };
            $.ajax({
                method : "POST",
                url : '{{route($base_route.'.set-status')}}',
                data : params,
                error:function (request) {
                    console.log(request.responseText);
                },
                success:function (data) {
                    var myData = jQuery.parseJSON(data);
                    console.log(myData);
                    if(myData.product_status==1)
                    {
                        $(this).attr('checked','checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                }

            });
        })
    })
</script>