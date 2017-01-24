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
	echo $cnt->addScrollLinkImage();
	exit;
}
$content_id=4;
?>
<div class="container" style="margin:0;">
    <h1>Add scrolling link image</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the scrolling link image and its detail that you wish to add.
    </div>
    <form id="form_scroll_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="home_scroll_title" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="home_scroll_desc" class="mytextarea"></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Scrolling link Image</td>
        <td class="formright"><input type="file" id="home_scroll_image" name="home_scroll_image" />
        <br />
        <b>The uploaded thumbnail image will appear as scrolling link on the home page.
           <br /> The dimensions of the image should be <?php echo SCROLL_IMG_W; ?> px in width.
            <br />The height may vary with a maximum height of <?php echo SCROLL_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product. 
</b>
        </td>
    </tr>
    <tr>
        <td class="formleft">Link this image to page</td>
        <td class="formright">
        	<select name="home_scroll_link" class="myselectbox">
            	<option value="">Home Page</option>
            	<option value="mirror-gallery">Mirror Gallery</option>
                	<?php
					$row_cats=$cat->showCategories(0);
					if(count($row_cats)){
						foreach($row_cats as $row_cat){
						?>
							<option value="mirror-gallery/<?php echo $row_cat['cat_alias']; ?>" style="padding-left:20px;"><?php echo $row_cat['cat_name']; ?></option>
							<?php	
							$row_products=$pro->showProducts($row_cat['cat_id']);
							if(count($row_products))
							{
								foreach($row_products as $row_product)
								{
									?>
									<option value="mirror-gallery/<?php echo $row_cat['cat_alias']; ?>/<?php echo $row_product['product_alias']; ?>" style="padding-left:40px;"><?php echo $row_product['product_name']; ?></option>
                                    <?php	
							  	}
							}
					  	}
					}
                  	?>
              	<option value="bespoke-services">Bespoke Services</option>	
                	<?php
					$row_casestudies=$csd->showCaseStudies();
					if(count($row_casestudies)){
						foreach($row_casestudies as $row_casestudy){
							?>
							<option value="case-study/<?php echo $row_casestudy['casestudy_alias']; ?>" style="padding-left:20px;"><?php echo $row_casestudy['casestudy_name']; ?></option>
						  	<?php	
						}
					}
					?>
              	<option value="about-us">About Us</option>	
                	<?php
                	$row_abouts=$cnt1->showContents(6);
                	if(count($row_abouts)){
                    	foreach($row_abouts as $row_about){
                        	?>
                        	<option value="about-us/<?php echo $row_about['content_alias']; ?>" style="padding-left:20px;"><?php echo $row_about['content_name']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>
            	<option value="contact-us">Contact Us</option>						     
				<option value="news">News</option>
                	<?php
                	$row_dnewss=$blg->showPublishedBlogs();
                	if(count($row_dnewss)){
                    	foreach($row_dnewss as $row_dnews){
                        	?>
                        	<option value="news/<?php echo $row_dnews['blog_alias']; ?>" style="padding-left:20px;"><?php echo $row_dnews['blog_title']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>
                <option value="other-services">Other Services</option>
                	<?php
                	$row_otherservices=$cnt1->showContents(16);
                	if(count($row_otherservices)){
                    	foreach($row_otherservices as $row_otherservice){
                        	?>
                        	<option value="other-services/<?php echo $row_otherservice['content_alias']; ?>" style="padding-left:20px;"><?php echo $row_otherservice['content_name']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>			     
        	</select>
        </td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn scroll_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.scroll_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/home_scrolling_link_add.php',
				type: 'post',
				data: $('#form_scroll_add').serialize(),
				success: function(id){
					$("#home_scroll_image").upload("ajax/home_scrolling_link_upload.php?id="+id,function(res){
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