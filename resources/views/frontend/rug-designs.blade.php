@extends($master)
@section('title')
    Marcus Paul | Rug Designs
@endsection
@section('extra-css')
@endsection
@section('home-section')
    <div class="mp-wrapper">
@endsection
@section('content')
            <div class="mp-section">
                <div class="mp-all-img mp-coll-bg">
                    <div class="row mp-gu-1">
                        @foreach($data['product'] as $p)
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
                            <figure class="mp-coll-cont relative">
                                <img data-original="{{asset('images/colourway/th/'.$p->colourway_th_image)}}" src="img/load.png" class="img-full load relative" alt="{{ $p->product_name }}" title="{{ $p->product_name }}" />
                                <a href="{{route($base_route.'.rug-design-details', [$p->product_alias])}}">
                                    <figcaption class="absolute cover">
                                        <h3>{!! $p->product_name !!}</h3>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
@endsection
@section('extra-scripts')
@endsection