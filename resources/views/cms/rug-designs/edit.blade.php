@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>{{$data->product_name}}</h1>
    <div class="goback" style="width:330px;">
        <a href="login.php?p_id=manage_wallpapers&id=2">Back to {{$extra_values['scope']}}</a>    </div>
    <div class="clearboth"></div>
    <div class="breadcrumb">
        <a href="#">Dashboard</a> &raquo;
        <a href="#">Rug Designs</a>
        &raquo; {{$data->product_name}}
    </div>

    <div class="accordion"><a href="JavaScript:void(0);" rel="cat_detail" class="accordiontab" >CLICK HERE TO EDIT THE DETAILS OF  {{ucwords($data->product_name)}}</a></div>
    <div id="cat_detail" class="accordionblock" style="display:none;">
        <div class="info">
            Provide the title, description and its image that you wish to update.
        </div>

        {{Form::model($data,['route'=>[$base_route.'.update',$data->product_id],'method'=>'PUT','id'=>'form_rug_add','enctype'=>'multipart/form-data','files'=>true])}}
            @include('cms.rug-designs.partials._form',['btnText'=>'Save'])
        {{Form::close()}}
            <script>

            $(".chb").change(function() {
                $(".chb").prop('checked', false);
                $(this).prop('checked', true);
            });

            $(".yes").click(function(){
                $(".hide").show();

            });
            $(".no").click(function(){
                $(".hide").hide();

            });

        </script>
    </div>
    <script>
        $(function(){
            $('.cat_edit').click(function(){
                var t=$(this);
                t.hide();
                $('.saving').show();
                $.ajax({
                    url: 'ajax/cat_edit.php',
                    type: 'post',
                    data: $('#form_cat_edit').serialize(),
                    success: function(){
                        $("#cat_images").upload("ajax/cat_image_upload.php?id=36",function(res){
                            $('.saving').fadeOut(function(){
                                $('.saved').fadeIn(function(){
                                    $(this).fadeOut(function(){
                                        t.show();
                                    });
                                });
                            });

                            $.ajax({
                                url: 'ajax/show_change_img_cat.php?id=36',
                                type: 'post',
                                data: $('#form_page_content').serialize(),
                                success: function(data){
                                    $('.showimgage').html(data);
                                }
                            });
                        },function(data){
                            alertify.success('Successfully Saved.');
                        });
                    }
                })
            });
        });
    </script>
    <div class="accordion"><a href="JavaScript:void(0);" rel="pro_list" class="accordiontab" style='background: url(images/tgup.png) no-repeat right #E30B5D;'>CLICK HERE TO MANAGE THE PRODUCTS WITHIN THE BENNISON</a></div>
    <div id="pro_list" class="accordionblock" style="display:block;">
        <div class="info">
            Provided below are the products that feature within the bennison products page.
            <br /><br />
            Click the "Add a product" button below if you wish to add a product.
            <br /><br />
            Click on the image or pencil icon to edit its detail.
            <br /><br />
            In the unlikely event that you wish to delete a product, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
            <br /><br />
            If you wish to change the order in which products are displayed, you can drag and drop a product to an alternative position.
        </div>
        <div class="myadd">
            <a href="ajax/product_add.php?id=36" class="product_add_link fancybox.ajax">Add a product</a>
        </div>
        <div class="clearboth"></div>
        <script>
            $(function(){
                $('.product_add_link').fancybox();
            });
        </script>
        <div id="pro_block">
            <div class="pleasewait">Please wait...</div>
            <script>
                $(function(){
                    $.ajax({
                        url: 'ajax/product_show.php',
                        type: 'post',
                        data: { id: '36' },
                        success: function(data){
                            $('#pro_block').html(data);
                        }
                    });
                });
            </script>
        </div>
    </div>

    <div class="accordion"><a href="JavaScript:void(0);" rel="cat_seo" class="accordiontab" >CLICK HERE TO EDIT SEO FOR THE BENNISON PAGE</a></div>
    <div id="cat_seo" class="accordionblock" style="display:none;">
        <div class="info">
            Please provide the SEO contents for the bennison page that you wish to have.
        </div>
        <form id="form_page_seo">
            <table border="0" class="myform">
                <tr>
                    <td class="formleft">Title tag</td>
                    <td class="formright"><input type="text" name="cat_titletag" value="" class="mytextbox" /></td>
                </tr>
                <tr>
                    <td class="formleft">Meta keywords</td>
                    <td class="formright"><textarea name="cat_metakeywords" class="mytextarea"></textarea></td>
                </tr>
                <tr>
                    <td class="formleft">Meta description</td>
                    <td class="formright"><textarea name="cat_metadescription" class="mytextarea"></textarea></td>
                </tr>
                <tr>
                    <td class="formleft">&nbsp;</td>
                    <td class="formright" style="height:36px;">
                        <input type="button" value="Save" class="mybtn save_seo" />
                        <div class="saving">Saving...</div>
                        <div class="saved">Successfully Saved.</div>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="cat_id" value="36" />
        </form>
        <script>
            $(function(){
                $('.save_seo').click(function(){
                    var t=$(this);
                    t.hide();
                    $('.saving').show();
                    $.ajax({
                        url: 'ajax/cat_seo_save.php',
                        type: 'post',
                        data: $('#form_page_seo').serialize(),
                        success: function(){
                            $('.saving').fadeOut(function(){
                                $('.saved').show().delay(1000).hide(function(){
                                    t.show();
                                });
                            });
                            alertify.success('Successfully Saved.');
                        }
                    })
                });
            });
        </script>
    </div>	<div class="clearboth"></div>
    </div>

@endsection

@section('extra-scripts')

@endsection