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
            {{Form::textarea('colourway_description',null,['class'=>'mytextarea','id'=>'colourway_description'])}}
        </td>
    </tr>

    <tr>
        @if(isset($data['colourway']->colourway_th_image))
            <td class="formleft"> Thumbnail Image</td>
            <td class="formright">
                <img src="{{asset('images/colourway/th/'.$data['colourway']->colourway_th_image) }}"  height ="150"  border="0">
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
        @if(isset($data['colourway']->colourway_lg_image))
            <td class="formleft"> Large Image</td>
            <td class="formright">
                <img src="{{asset('images/colourway/lg/'.$data['colourway']->colourway_lg_image) }}"  height ="150"  border="0">
            </td>
        @endif
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
            {{isset($data['colourway']->colourway_default) ? 'Is this the default Colourway ?' :
            "Would you like to make this colourway the default colourway ?"
            }}<br/>
            {{Form::radio('colourway_default',1,true,['id'=>'colourway_default'])}}Yes
            {{Form::radio('colourway_default',0)}}No
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