@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>{{ucfirst($data['colourway']->colourway_name)}}</h1>
    <div class="goback"><a href="">Back to {{$data['product']->product_name}}</a></div>
    <div class="clearboth"></div>
    <div class="breadcrumb"> <a href="#">Dashboard</a> &raquo;
        <a href="#">Products</a>&raquo; <a href="#">{{$data['product']->product_name}}</a> &raquo; {{$data['colourway']->colourway_name}} </div>
    <br />
    <div class="clearboth"></div>
    <div style="float:left; margin-right:40px; width: 350px;" class="main_img">
        <img src="{{asset('images/rug-designs/'.$data['product']->product_image)}}" width="300" border="0" />
    </div>
    <div style="float:left; width: 570px;" class="summary4">
        <style>
            .summary4 p{
                margin-bottom: 6px;
            }
        </style>
        <div class="clearboth"></div>

        <div style="font-size: 11pt; border-bottom: 1px dotted #cccccc; padding-bottom:5px;">  <h3>Descriptions</h3></div>
        <br />
        <b>Product Description </b>:
        <br /><br />
        {{ $data['product']->product_desc }}
        <br /><br />
        <b>Product Knot Count </b>: {{ $data['product']->product_detail->product_knotcnt }}
        <br /><br />
        <b>Repeat</b>: {{$data['product']->product_detail->product_size }}
        <br /><br />
        <br /><br />
    </div>
    <div class="clearboth"></div>
    <div class="accordion"><a href="JavaScript:void(0);" rel="pro_detail" class="accordiontab" style='background: url(images/tgup.png) no-repeat right #E30B5D;'>CLICK HERE TO EDIT THE COLOURWAY DETAIL FOR {{$data['colourway']->colourway_name }}</a></div>
    <div id="pro_detail" class="accordionblock" style="display:block;">
        <div class="info"> Provide the product name and its detail that you wish to update. </div>
            {{ Form::model($data['colourway'],['route'=> [$base_route.'.update',$data['colourway']->colourway_id],'method'=>'PUT','enctype'=>'multipat/form-data','files'=>true])}}
                    @include('cms.colourway.partials._form',['btnText'=>'Save'])
            {{ Form::close()}}
        <script>
            $(function(){
                $('.product_edit').click(function(){
                    var t=$(this);
                    t.hide();
                    $('.saving_detail').show();
                    $.ajax({
                        url: 'ajax/product_edit.php',
                        type: 'post',
                        data: $('#form_product_edit').serialize(),
                        success: function(){
                            //console.log('asdkjds');
                            $('.saving_detail').fadeOut(function(){
                                $('.saved_detail').show().delay(2000).hide(function(){
                                    t.show();
                                });
                            });
                            //window.location = "login.php?p_id=manage_product&id=608&show_tab=pro_detail";
                            alertify.success('Successfully Saved.');
                        }

                    })
                });
            });
        </script>
    </div>
    <!-- ###################################################  Roomset IMAGES  START   ##################################################################################-->
    <div class="accordion"><a href="JavaScript:void(0);" rel="product_images" class="accordiontab">CLICK HERE TO EDIT THE PRODUCT IMAGES</a></div>
    <div id="product_images" class="accordionblock" style="display:none;">
        <div id="product_img_block" style="padding:10px 15px 20px 15px;">
            <form action="" method="post" enctype="multipart/form-data">
                <table border="0" class="myform">
                    <tr>
                        <td class="formleft">Thumbnail image</td>
                        <td class="formright">
                            <input type="file" name="theimageth" />
                            <b><br />The uploaded thumbnail image will appear on the product index page.
                                <br />The dimensions of this image should be 500 px in width and  409 px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.

                            </b><br />

                        </td>
                    </tr>
                    <tr>
                        <td class="formleft">Large image</td>
                        <td class="formright">
                            <input type="file" name="theimagemd" />

                            <b><br /><br />The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
                                <br />The dimensions of this image should be 1100 px in width and  900 px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                            </b><br />

                        </td>
                    </tr>


                    <tr>
                        <td class="formleft">&nbsp;</td>
                        <td class="formright"><input type="submit" value="Save" class="mybtn" /></td>
                    </tr>
                </table>
                <input type="hidden" name="product_id" value="608" />
                <input type="hidden" name="submitted" value="main_image" />
            </form>
            <script language="javascript">
                function form_validate(){
                    if(document.available_img_frm.theimageth.value==""){
                        alert("Please upload the thumbnail image")
                        return false;
                    }
                    if(document.available_img_frm.theimageth.value==""){

                        alert("Please upload the large image")
                        return false;
                    }
                }
            </script>
            <div class="clearboth"></div>
        </div>
    </div>
    <!-- ###################################################   Roomset IMAGES  END   ##################################################################################-->

@endsection
@section('extra-scripts')

@endsection