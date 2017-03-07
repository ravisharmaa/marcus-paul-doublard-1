@foreach($data['colourway'] as $c)
    <li>
        <a href="" class="colourway_data" data-id="{{ $c->colourway_id }}">
            <img data-original="{{asset('images/colourway/th/'.$c->colourway_th_image)}}" src="{{asset('assets/frontend/img/load.png')}}" alt="{{$data['product']->product_name. ' - ' .$c->colourway_name}}" title="{{!empty($c->colourway_name) ? $data['product']->product_name.' - '.$c->colourway_name: $data['product']->product_name}}" class="img-full load">
        </a>
    </li>
@endforeach