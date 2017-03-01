
<table border="0" class="myform">
    <tr>
        <td class="formleft">Name</td>
        <td class="formright">
            {{Form::text('product_name',null,['class'=>'mytextbox','id'=>'product_name'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft">Description</td>
        <td class="formright">
            {{Form::textarea('product_desc',null,['class'=>'mytextarea','id'=>'product_description'])}}
        </td>
    </tr>

    <tr>
        <td class="formleft">Knot Count</td>
        <td class="formright">
            {{Form::text('product_knotcnt',isset($data) ? AppHelper::getProductRelationValues($data, 'product_knotcnt'):null,['class'=>'mytextbox','id'=>'product_knotcnt'])}}
        </td>
    </tr>

    <tr>
        <td class="formleft">Size</td>
        <td class="formright">
            {{Form::text('product_size',isset($data) ? AppHelper::getProductRelationValues($data, 'product_size') : null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft">Materials</td>
        <td class="formright">
            {{Form::text('product_material',isset($data) ? AppHelper::getProductRelationValues($data, 'product_material') : null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft"> Applied Techniques </td>
        <td class="formright">
            {{Form::text('product_technique',isset($data) ? AppHelper::getProductRelationValues($data, 'product_technique') : null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft">Pile Height</td>
        <td class="formright">
            {{Form::text('product_pileheight',isset($data) ? AppHelper::getProductRelationValues($data, 'product_pileheight') : null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft">Lead Times</td>
        <td class="formright">
            {{Form::text('product_leadtime',isset($data) ? AppHelper::getProductRelationValues($data, 'product_leadtime') : null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>
    <tr>
    <tr>
        @if(isset($data->product_image))
            <td class="formleft">Thumbnail Image</td>
            <td class="formright">
                <img src="{{asset('images/rug-designs/lg/'.$data->product_image)}}"  height ="150"  border="0">
            </td>
        @endif
    </tr>

    <td class="formleft">{{isset($data->product_image) ? 'Replace':''}} Thumbnail Image</td>
    <td class="formright">
        {{Form::file('product_image',null,['id'=>'rug_image','class'=>'rug_image'])}}
        <br /><b>The uploaded image will appear on the  page.
            <br />The dimension of this image should be 513px in height and 350px in width. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
    </td>
    </tr>
</table>