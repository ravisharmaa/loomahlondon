<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['content_id']))
{
	echo $cnt->addSlideImage();
	exit;
}
$content_id=1;
?>
<div class="container" style="margin:0;">
    <h1>Add a slide image</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the slide image that you wish to add.
    </div>
    <form id="form_slide_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Photo credit by</td>
        <td class="formright"><input type="text" name="slideshow_title" value="" class="mytextbox" /></td>
    </tr>
    <?php /*
    <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="slideshow_desc" class="mytextarea"></textarea></td>
    </tr>
    */ ?>
    <input type="hidden" name="slideshow_desc" class="mytextbox" value="">
	<tr>
        <td class="formleft">Slide Image</td>
        <td class="formright"><input type="file" id="slideshow_images" name="slideshow_image" />
                <br />
        <b>The uploaded image will appear as slideshow on the home page.
        <br />The dimension of this image should be <?php echo SLIDE_IMG_W; ?> px in width and <?php echo SLIDE_IMG_H; ?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
</b></td>
    </tr>
    <tr>
        <td class="formleft">Link this image to page</td>
		<td class="formright" id="internal_link">
		        <select name="slideshow_link" class="selecting_val myselectbox" style="width:200px;">
                           <option value="index">Home Page</option>
                            <option value="about-us">About</option>
                            <option value="textiles">Textiles</option>
                            <option value="wallpapers">Wallpapers</option>
                            <option value="decorative-pieces">Decorative Pieces</option>
                         
                            <option value="terms-and-conditions">Terms and Conditions</option>
                           <option value="contact-us">Contact</option>
                           <option value="site-map">Site Map</option>
                        </select>
                   
                      <script>
                        $(function(){
                            $('.selecting_val').change(function(id){
							//alert('hellow');
                                var url=$(this).val();
                                $.ajax({
                                    url: 'ajax/select_link.php?id='+id,
                                    type: 'post',
                                    data: { url: url },
                                    success: function(data){
                                        $('#internal_link').html(data); 
                                    }
                                });
                            });    
                        });
                        </script>
        </td>
	</tr>
	<tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn slide_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.slide_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/home_slideimage_add.php',
				type: 'post',
				data: $('#form_slide_add').serialize(),
				success: function(id){
					$("#slideshow_images").upload("ajax/home_slideimage_upload.php?id="+id,function(res){
						$('.saving').hide();
						$.fancybox.close();	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
    
    
</div>