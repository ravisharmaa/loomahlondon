<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=6;
$show_tab="slide_show";
$row_content=$cnt->getFeaturedPageContent($content_id);

?>
<h1>About Page</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; About Page
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="slide_show" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="slide_show") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE IMAGES FOR THE SLIDESHOW</a></div>
<div id="slide_show" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="slide_show")?"block":"none"; ?>;">


<div class="info">
    	Please overwrite the title and paragraph for the about page that you wish to have.
    </div>
    <form id="form_page_content">
    <table border="0" class="myform">
     <tr>
       <!-- <td class="formleft" style="width:50%">Title</td>-->
        <td class="formright" colspan="2" style="text-align:center;"><input style="text-transform:uppercase;width:98%; text-align:center; font-size: 19px; font-weight: 100;letter-spacing: 0.5px;" type="text" name="content_title" value="<?php echo stripslashes($row_content['content_title']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
    <!--<td class="formleft" style="width:23%">Description</td>-->
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
#cke_1_resizer{
display:none;
}
.cke_contents{
font-size:16px;
height:333px;
} 
	</style>
        <td class="formright" colspan="2" >
      <textarea type="text" name="content_desc" style="width:99%; font-family: BrandonGR; font-size: 16px; letter-spacing: 0.5px;  margin-right:20px; padding:15px 5px; color: #2a2a2a;font-weight: normal;text-rendering: optimizelegibility; text-align:left" class="myeditor"><?php echo stripslashes($row_content['content_desc']); ?></textarea>
        </td>
    </tr>
    
    <tr>
        <td class="formleft" style="border-right:0">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input style="float:right;" type="button" value="Save" class="mybtn save_content" />
        	<div class="saving" style="float:right;">Saving...</div>
            <div class="saved" style="float:right;">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
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
    
    
	<div class="info">
        Provided below are the slide images that feature within the about page.
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
    	<a href="ajax/about_slideimage_add.php" class="slide_add_link fancybox.ajax">Add a slide image</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.slide_add_link').fancybox({
			'beforeClose': function(){
				$.ajax({
					url: 'ajax/about_slideimage_show.php',
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
    <div id="slideshow_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/about_slideimage_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#slideshow_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE ABOUT PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the about page that you wish to have.
    </div>
    <?php
	$row_seo=$cnt->getPageSEO($content_id);
	?>
    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="content_titletag" value="<?php echo stripslashes($row_seo['content_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="content_metakeywords" class="mytextarea"><?php echo stripslashes($row_seo['content_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="content_metadescription" class="mytextarea"><?php echo stripslashes($row_seo['content_metadescription']); ?></textarea></td>
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
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
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
</div>