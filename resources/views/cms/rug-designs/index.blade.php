@extends('cms.layout.master')
@section('extra-styles')

@endsection

@section('main-content')
        <h1 style="width:500px;">Rug Designs</h1>
        <div class="clearboth"></div>
        <div class="breadcrumb">
            <a href="login.php">Dashboard</a> »Rug Designs
        </div>
        <div class="info">
            Provided below are the collections that feature within the Rug Designs  page.
            <br><br>
            Click the "Add a collection" button below if you wish to add a Rug Design.
            <br><br>
            Click on the image or pencil icon to manage its constituent products.
            <br><br>
            In the unlikely event that you wish to delete a collection, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
            <br><br>
            If you wish to change the order in which collections are displayed, you can drag and drop to an alternative position.
        </div>
        <div class="myadd">
            <a href="{{route($base_route.'.add')}}" class="rug_add_link fancybox.ajax">Add a rug</a>
        </div>
        <div class="clearboth"></div>
        <script>
            $(function(){
                $('.rug_add_link').fancybox();
            });
        </script>
        <div id="cat_block"><ul id="sorter" class="polaroid ui-sortable">
                <li id="sortdata_36">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=36">
                            <img src="../images/categories/songbird-blue-yellow-on-oyster-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">1</span>. Bennison                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=36"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="36"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-36" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-36" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_27">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=27">
                            <img src="../images/categories/pineapple-pink-on-oatmeal-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">2</span>. Blithfield                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=27"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="27"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-27" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-27" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_30">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=30">
                            <img src="../images/categories/bird&amp;blossom-multi-colourway-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">3</span>. Hamilton Weston                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=30"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="30"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-30" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-30" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_33">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=33">
                            <img src="../images/categories/ticking-01-peony-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">4</span>. Ian Mankin                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=33"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="33"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-33" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-33" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <div class="clearboth"></div>
                <li id="sortdata_28">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=28">
                            <img src="../images/categories/templeton-stripe-blue-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">5</span>. Jean Monro                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=28"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="28"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-28" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-28" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_39">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=39">
                            <img src="../images/categories/half-moon-deepwater-2tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">6</span>. Lake August                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=39"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="39"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-39" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-39" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_29">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=29">
                            <img src="../images/categories/branches-de-pin-blanc-noir-tb.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">7</span>. Madeleine Castaing                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=29"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="29"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-29" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-29" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_31">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=31">
                            <img src="../images/categories/italian-wallpaper-img.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">8</span>. Marthe Armitage                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=31"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="31"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-31" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-31" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <div class="clearboth"></div>
                <li id="sortdata_32">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=32">
                            <img src="../images/categories/nicholas-highresfabrics-2toiledeslapins-yellow.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">9</span>. Nicholas Herbert Ltd                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=32"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="32"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-32" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-32" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
                <li id="sortdata_35">
                    <div class="polaroidimg">
                        <a href="login.php?p_id=manage_products&amp;id=35">
                            <img src="../images/categories/wothers.jpg" width="200" border="0">

                        </a>
                    </div>
                    <div class="polaroidlabel">
                        <div class="tr">
                            <div class="td">
                                <span class="cat_sn">10</span>. Other                		</div>
                        </div>
                    </div>
                    <div class="polaroidoption">
                        <a href="login.php?p_id=manage_products&amp;id=35"><img src="images/icon_edit.png" width="24" height="24" border="0"></a>
                        <a href="JavaScript:void(0);" class="cat_del_link" rel="35"><img src="images/icon_delete.png" width="24" height="24" border="0"></a>

                        <div style="float:right;width:66px;padding-top:5px;">
                            <label><input type="checkbox" id="checkbox-35" class="publish_product" checked=""> Publish</label>
                        </div>
                        <div id="img-35" style="float:right;width:30px;display:none;">
                            <img src="images/loading.gif" width="20" height="20" border="0">
                        </div>
                    </div></li>
            </ul>
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
                    $('.cat_del_link').click(function(){
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
        <div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab">CLICK HERE TO EDIT SEO FOR THE WALLPAPERS PAGE</a></div>
        <div id="page_seo" class="accordionblock" style="display:none;">
            <div class="info">
                Please provide the SEO contents for the wallpapers page that you wish to have.
            </div>

            <form id="form_page_seo">
                <table border="0" class="myform">
                    <tbody><tr>
                        <td class="formleft">Title tag</td>
                        <td class="formright"><input type="text" name="cat_titletag" value="Wallpapers" class="mytextbox"></td>
                    </tr>
                    <tr>
                        <td class="formleft">Meta keywords</td>
                        <td class="formright"><textarea name="cat_metakeywords" class="mytextarea">Wallpapers</textarea></td>
                    </tr>
                    <tr>
                        <td class="formleft">Meta description</td>
                        <td class="formright"><textarea name="cat_metadescription" class="mytextarea">Wallpapers</textarea></td>
                    </tr>
                    <tr>
                        <td class="formleft">&nbsp;</td>
                        <td class="formright">
                            <input type="button" value="Save" class="mybtn save_seo">
                            <div class="saving">Saving...</div>
                            <div class="saved">Successfully Saved.</div>
                        </td>
                    </tr>
                    </tbody></table>
                <input type="hidden" name="cat_id" value="2">
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
        </div>	<div class="clearboth"></div>

@endsection

@section('footer')

@endsection