<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['slideshow_id']))
{
	$cnt->updateSlideImage();
	exit;
}
$slideshow_id=$_REQUEST['id'];
$row_slide=$cnt->showSlideImage($slideshow_id);
?>
<div class="container" style="margin:0;">
    <h1>Edit slide image</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the slide image and its detail that you wish to update.
    </div>
    <form id="form_slide_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="slideshow_title" value="<?php echo stripslashes($row_slide['slideshow_title']); ?>" class="mytextbox" /></td>
    </tr>
    <?php /*
    <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="slideshow_desc" class="mytextarea"><?php echo stripslashes($row_slide['slideshow_desc']); ?></textarea></td>
    </tr>
    */ ?>
	<?php
	if(empty($row_slide['slideshow_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Slide Image</td>
            <td class="formright"><input type="file" id="slideshow_image" name="slideshow_image" value="" />
                                 	 <br />
       		 <b>The uploaded image will appear as slideshow on the home page.
            <br /> The dimensions of the image should be <?php echo SLIDE_IMG_W; ?> px in width.
            <br />The height may vary with a maximum height of <?php echo SLIDE_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product. 
     
             </b></td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Replace Slide Image</td>
            <td class="formright"><img src="../<?php echo SLIDE_IMG.$row_slide['slideshow_image']; ?>" width="200" /></td>
        </tr>
		<tr>
            <td class="formleft"></td>
            <td class="formright"><input type="file" id="slideshow_image" name="slideshow_image" />         	 <br />
       		 <b>The uploaded image will appear as slideshow on the home page.
                <br /> The dimensions of the image should be <?php echo SLIDE_IMG_W; ?> px in width.
            <br />The height may vary with a maximum height of <?php echo SLIDE_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product 
             <br />If you decide to upload a new image, it will replace the existing one. 
</b></td>
        </tr>
		<?php
	}
	?>
      <tr>
        <td class="formleft">Link this image</td>
        <td class="formright" id="internal_link">
        <?php
           $decorative_p_id=3;
			    $row_firstcat=$cat->showFirstCategory($decorative_p_id);
				?>
                        <select name="slideshow_link" class="selecting_val myselectbox" style="width:200px;">
                           <option value="home" <?php if($row_slide['slideshow_link']=="home") echo "selected"; ?>>Home Page</option>
                            <option value="about-us" <?php if($row_slide['slideshow_link']=="about-us") echo "selected"; ?>>About</option>
                            <option value="textiles" <?php if($row_slide['slideshow_link']=="textiles") echo "selected"; ?>>Textiles</option>
                            <option value="wallpapers" <?php if($row_slide['slideshow_link']=="wallpapers") echo "selected"; ?>>Wallpapers</option>
                			<option value="decorative-pieces/<?php echo $row_firstcat['cat_alias']; ?>" <?php if($row_slide['slideshow_link']=='decorative-pieces/'.$row_firstcat['cat_alias']) echo "selected"; ?>>Decorative Pieces</option>
                            <option value="terms-and-conditions" <?php if($row_slide['slideshow_link']=="terms-and-conditions") echo "selected"; ?>>Terms and Conditions</option>
                           <option value="contact-us" <?php if($row_slide['slideshow_link']=="contact-us") echo "selected"; ?>>Contact</option>
                           <option value="site-map" <?php if($row_slide['slideshow_link']=="site-map") echo "selected"; ?>>Site Map</option>
                        </select>
                   
                      <script>
                        $(function(){
                            $('.selecting_val').change(function(){
							//alert('hellow');
                                var url=$(this).val();
                                $.ajax({
                                    url: 'ajax/select_link.php?id=<?php echo $slideshow_id;?>',
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
        	<input type="button" value="Save" class="mybtn slide_edit" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="slideshow_id" value="<?php echo $slideshow_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.slide_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/home_slideimage_edit.php',
				type: 'post',
				data: $('#form_slide_edit').serialize(),
				success: function(){
					$("#slideshow_image").upload("ajax/home_slideimage_upload.php?id=<?php echo $slideshow_id; ?>",function(res){
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