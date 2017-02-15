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
            {{Form::number('product_knotcnt',null,['class'=>'mytextbox','id'=>'product_knotcnt'])}}
        </td>
    </tr>

    <tr>
        <td class="formleft">Size</td>
        <td class="formright">
            {{Form::text('product_size',null,['class'=>'mytextbox','id'=>'product_size'])}}
        </td>
    </tr>

    <tr>
        <td class="formleft">Upload Thumbnail Image</td>
        <td class="formright">
            {{--<a href="{{$base_route,'cropit_replace_image'}}">--}}
                {{--<input type="file" name="product_image" id="rug_image" class="replace_product_thumbnail_image fancybox.ajax">--}}
            {{--</a>--}}
            {{Form::file('product_image',null,['id'=>'rug_image','class'=>'rug_image'])}}
            <br /><b>The uploaded image will appear on the  page.
                <br />The dimension of this image should be px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>
    </tr>
    <tr  class="myform hide" style="display:none">
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
            {{Form::submit($btnText,['class'=>'mybtn rug_add'])}}
            <div class="saving">Saving...</div>
        </td>
    </tr>
</table>