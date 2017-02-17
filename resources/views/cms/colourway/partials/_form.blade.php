<table border="0" class="myform">
    <tr>
        <td class="formleft">Colourway Name</td>
        <td class="formright">
            {{Form::text('colourway_name',null,['class'=>'mytextbox','id'=>'colourway_name'])}}
        </td>
    </tr>
    <tr>
        <td class="formleft">Description</td>
        <td class="formright">
            {{Form::textarea('colourway_desc',null,['class'=>'mytextarea','id'=>'colourway_description'])}}
        </td>
    </tr>

    <tr>
        @if(isset($data->product_image))
            <td class="formleft">Previous Thumbnail Image</td>
            <td class="formright">
                <img src="{{asset('images/'.$data->product_image)}}"  height ="150"  border="0">
            </td>
        @endif
    </tr>
    <tr>
        <td class="formleft">Upload Thumbnail Image</td>
        <td class="formright">
            {{Form::file('colourway_th_image',null,['id'=>'colourway_th_image'])}}
            <br /><b>The uploaded image will appear on the  page.
                <br />The dimension of this image should be 500px in width and 750px in height . Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>

    </tr>
    <tr>
        <td class="formleft">Upload Large Image</td>
        <td class="formright">
            {{Form::file('colourway_lg_image',null,['id'=>'colourway_lg_image','class'=>'rug_image'])}}
            <br /><b>The uploaded image will appear on the  page.
                <br />The dimension of this image should be 1100px in width and 750px in height . Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>
    </tr>

    <tr>
        <td class="formleft"></td>
        <td class="formright">
            Would you like to make this colourway the default colourway? <br/>
            {{Form::radio('colourway_default',1,true,['id'=>'colourway_default'])}}Yes
            <input type="radio" id="colourway_default" name="colourway_default" value="0" /> No
        </td>

    </tr>
    <tr  class="myform hide" style="display:none">
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
            {{Form::submit($btnText,['class'=>'mybtn'])}}
            <div class="saving">Saving...</div>
        </td>
    </tr>
</table>