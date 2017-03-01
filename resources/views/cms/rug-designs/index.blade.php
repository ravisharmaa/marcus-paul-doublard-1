@extends('cms.layout.master')
@section('extra-styles')

@endsection

@section('main-content')
        <h1 style="width:500px;">Rug Designs</h1>
        <div class="clearboth"></div>
        <div class="breadcrumb">
            <a href="{{route('cms.dashboard')}}"> Dashboard </a> » Rug Designs
        </div>
        <div class="info">
            Provided below are the collections that feature within the Rug Designs page.
            <br><br>
            Click the "Add a rug" button below if you wish to add a Rug Design.
            <br><br>
            Click on the image or pencil icon to manage it.
            <br><br>
            In the unlikely event that you wish to delete a collection, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
            <br><br>
            If you wish to change the order in which collections are displayed, you can drag and drop to an alternative position.
        </div>
        <div class="myadd">
            <a href="{{route($base_route.'.add')}}" class="rug_add_link fancybox.ajax">Add a Rug</a>
        </div>
        <div class="clearboth"></div>
        <script>
            $(function(){
                $('.rug_add_link').fancybox();

            });
           {{--$(".rug_add_link").click(function(e){--}}
              {{--e.preventDefault();--}}
              {{--$('.rug_add_link').fancybox();--}}
              {{--$.ajax({--}}
                  {{--method: "GET",--}}
                  {{--url: '{{route($base_route.'.add')}}',--}}
                  {{--success:function(request){--}}
                    {{--console.log(request.responseText);--}}
                  {{--},--}}

              {{--});--}}

        </script>
        <div id="cat_block">
            <div class="pleasewait" style="padding:2px 0 6px 30px;">Please wait...</div>
            <script>
                $("document").ready(function(){
                    $.ajax({
                        url     :   '{{route($base_route.'.show-products')}}',
                        type    : "GET",
                        data    : {},
                        success:function(data){
                            $("#cat_block").html(data);
                        }

                    });
                });
            </script>
            <div class="clearboth"></div>
            <script>
                $(function(){
                    $("#sorter").sortable({
                        opacity: 0.6, cursor: 'move', update: function(){
                            var order=$(this).sortable('serialize');
                            $.post("ajax/cat_sort.php", order, function(theResponse){
                                var cat_sn=0;
                                $('.cat_sn').each(function(){
                                    $(this).html(++cat_sn);
                                });
                            });
                        }
                    });
                    $('.rug_del_link').click(function(e){
                        e.preventDefault();
                        if(confirm("Are you sure that you wish to delete this category?")){
                            var t=$(this);
                            $.ajax({
                                url: 'ajax/cat_delete.php',
                                type: 'post',
                                data: { id: t.attr('rel') },
                                success: function(data){
                                    t.parent().parent().hide();
                                }
                            });
                        }
                    });

                    $('.publish_product').click(function(){
                        var tt=$(this);
                        var id=tt.attr('id').split('-')[1];
                        $('#img-'+id).show();
                        var status=0;
                        if($(this).is(':checked'))
                            status=1;
                        $.ajax({
                            url: 'ajax/designer_status.php',
                            type: 'post',
                            data: { id: id, status: status },
                            success: function(){
                                $('#img-'+id).hide();
                            }
                        });
                    });
                });
            </script>
        </div>
@endsection

@section('extra-scripts')

@endsection