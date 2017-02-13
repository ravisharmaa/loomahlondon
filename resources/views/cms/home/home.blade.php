@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>{{$extra_values['scope']}}</h1>
    <div class="clearboth"></div>
    <div class="breadcrumb">
        <a href="login.php">Dashboard</a> &raquo; Rug Designs
    </div>
    <div class="accordion"><a href="JavaScript:void(0);" rel="slide_show" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="slide_show") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE IMAGES FOR THE SLIDESHOW</a></div>
    <div id="slide_show" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="slide_show")?"block":"none"; ?>;">
        <div class="info">
            Provided below are the slide images that feature within the home page.
            <br /><br />
            Click the "Add a slide image" button below if you wish to add a slide image.
            <br /><br />
            Click on the image or pencil icon of a slide image to manage its detail.
            <br /><br />
            In the unlikely event that you wish to delete a slide image, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
            <br /><br />
            If you wish to change the order in which slide images are displayed, you can drag and drop a slide image to an alternative position.
        </div>
        <div class="myadd">
            <a href="ajax/home_slideimage_add.php" class="slide_add_link fancybox.ajax">Add a slide image</a>
        </div>
        <div class="clearboth"></div>

        <div id="slideshow_block">
            <div class="pleasewait">Please wait...</div>
        </div>
    </div>
    <style>
        .cke_top {
            display:none;
        }
        .cke_bottom {
            background: none;
            border-top:  0px;
            box-shadow:  0px;
        }
        .cke_path {
            display: none;

        }
        .cke_editable{
            font-size: 16px;
            line-height: 1.6;
            text-align: center;
        }
        #cke_1_resizer{
            display:none;
        }
    </style>
    <div class="info">
        Please overwrite the paragraph for the home page that you wish to have.
    </div>
    <form id="form_page_content">
        <table border="0px" class="myform">
            <tr>
                <td class="formright" colspan="2">
                    <textarea type="text" name="content_desc"  class="myeditors" style="width:99%; height:30px; font-weight:bold; text-transform: uppercase; color:#2a2a2a;font-family: "BrandonGM";">xxxx</textarea>
                </td>
            </tr>
            <tr>
                <td class="formleft" style="border-right:0">&nbsp;</td>
                <td class="formright" style="height:36px;">
                    <input style="float:right;" type="button" value="Save" class="mybtn save_content" />
                    <div class="saving" style="float:right;">Saving...</div>
                    <div class="saved" style="float:right;">Successfully Saved.</div>
                </td>3.
            </tr>
        </table>
        <input type="hidden" name="content_id" value="xx" />
    </form>
    <div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE HOME PAGE</a></div>
    <div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
        <div class="info">
            Please provide the SEO contents for the home page that you wish to have.
        </div>
        <form id="form_page_seo">
            <table border="0" class="myform">
                <tr>
                    <td class="formleft">Title tag</td>
                    <td class="formright"><input type="text" name="content_titletag" value="xxx" class="mytextbox" /></td>
                </tr>
                <tr>
                    <td class="formleft">Meta keywords</td>
                    <td class="formright"><textarea name="content_metakeywords" class="mytextarea">xxx</textarea></td>
                </tr>
                <tr>
                    <td class="formleft">Meta description</td>
                    <td class="formright"><textarea name="content_metadescription" class="mytextarea">xxx</textarea></td>
                </tr>
                <tr>
                    <td class="formleft">&nbsp;</td>
                    <td class="formright">
                        <input type="button" value="Save" class="mybtn save_seo" />
                        <div class="saving">Saving...</div>
                        <div class="saved">Successfully Saved.</div>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="content_id" value="xx" />
        </form>
    </div>
@endsection

@section('extra-scripts')
    <script>
        $(function(){
            $.ajax({
                url: 'ajax/home_slideimage_show.php',
                type: 'post',
                data: {},
                success: function(data){
                    $('#slideshow_block').html(data);
                }
            });
        });
    </script>
    <script>
        $(function(){
            $('.save_seo').click(function(){
                var t=$(this);
                t.hide();
                $('.saving').show();
                $.ajax({
                    url: 'ajax/content_seo_save.php',
                    type: 'post',
                    data: $('#form_page_seo').serialize(),
                    success: function(){
                        $('.saving').fadeOut(function(){
                            $('.saved').show().delay(1000).fadeOut(function(){
                                t.show();
                            });
                        });
                        alertify.success('Successfully Saved.');
                    }
                })
            });
        });
    </script>
    <script>
        $(function(){
            $('.save_content').click(function(){
                var t=$(this);
                t.hide();
                $('.saving').show();
                $.ajax({
                    url: 'ajax/featured_content_save.php',
                    type: 'post',
                    data: $('#form_page_content').serialize(),
                    success: function(){
                        $('.saving').fadeOut(function(){
                            $('.saved').fadeIn(function(){
                                $(this).fadeOut(2000,function(){
                                    t.show();
                                });
                            });
                        });
                        alertify.success('Successfully Saved.');
                    }
                })
            });
        });
    </script>
    <script>
        $(function(){
            $('.slide_add_link').fancybox({
                'beforeClose': function(){
                    $.ajax({
                        url: 'ajax/home_slideimage_show.php',
                        type: 'post',
                        data: {},
                        success: function(data){
                            $('#slideshow_block').html(data);
                        }
                    });
                }
            });
        });
    </script>
@endsection
