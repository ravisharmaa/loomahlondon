<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['content_part_id']))
{
	echo $cnt1->editPart();
}
else
{
	$content_part_id=$_REQUEST['id'];
	$row_part=$cnt1->showContentPart($content_part_id);
	$content_id=$row_part['content_id'];
	$content_part_type=$row_part['content_part_type'];
	?>
    <div class="container" style="margin:0;">
    	<h1><?php echo stripslashes($cnt1->contentName($content_id)); ?></h1>
        <div class="clearboth"></div>
    	<form id="content_paragraph_form">
	    <?php
		if($content_part_type=="Title")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$('.mybtn_cancel').trigger('click');
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide the title that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Title</td>
                <td class="formright"><input type="text" name="content_part_data1" value="<?php echo stripslashes($row_part['content_part_data1']); ?>" class="mytextbox" /><br />Provided text appears as the title slightly bigger and bolder font face than regular text.</td>
            </tr>
        	<tr>
                <td class="formleft">Title Alignment</td>
                <td class="formright">
            		<label><input type="radio" name="content_part_data3" value="left" <?php if($row_part['content_part_data3']=="left") echo "checked"; ?> /> Left</label>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="center" <?php if($row_part['content_part_data3']=="center") echo "checked"; ?> /> Center</label>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="right" <?php if($row_part['content_part_data3']=="right") echo "checked"; ?> /> Right</label>
            		<br />If you want to align the title to left of the page, choose "Left" or if you want it to center of the page, choose "center" or if you want it to right of the page, choose "right".
                </td>
            </tr>
        	<tr>
                <td class="formleft">&nbsp;</td>
                <td class="formright">
            		<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
            	</td>
            </tr>    
			</table>
			<?php
		}
		else if($content_part_type=="Text")
		{
			?>
			<script type="text/javascript">
			var editor = CKEDITOR.instances['content_part_data1']; 
			if(editor) { 
				editor.destroy(true); 
			}
			$('.myeditor').ckeditor({
				langCode: 'en', 
				width : '100%',
				height : '400',
				toolbar:
				[
					['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
					['Image', 'Link', 'Unlink', 'Flash'],
					['Cut','Copy','Paste','PasteText','PasteFromWord','-','Find','Replace'],
					['SelectAll','RemoveFormat'],
					'/',
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Table','NumberedList','BulletedList'],
					['Format'],
					['TextColor','BGColor'],
					['Font','FontSize'],
				],
				filebrowserBrowseUrl:'ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
			});
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$('.mybtn_cancel').trigger('click');
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide the paragraphs that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Paragraphs</td>
                <td class="formright"><textarea name="content_part_data1" class="myeditor"><?php echo stripslashes($row_part['content_part_data1']); ?></textarea></td>
            </tr>
        	<tr>
            	<td class="formleft">&nbsp;</td>
				<td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="Image")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$("#content_part_data2").upload("ajax/content_part_image_upload.php?id="+data,function(res) {
								$('.mybtn_cancel').trigger('click');
							},function(data) {
							});
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide the image that you wish to add.
            </div>
            <table border="0" class="myform">
            <?php
			if(empty($row_part['content_part_data2']))
			{
				?> 
                <tr>
                    <td class="formleft">Upload Image</td>
                    <td class="formright"><input type="file" id="content_part_data2" name="content_part_data2" /></td>
                </tr>
				<?php
			}
			else
			{
				?> 
                <tr>
                    <td class="formleft">Current Image</td>
                    <td class="formright"><img src="../<?php echo CONTENT_IMG.$row_part['content_part_data2']; ?>" width="200" /></td>
                </tr>
				<tr>
                    <td class="formleft">&nbsp;</td>
                    <td class="formright">If you wish to replace the above image then select a new image below.<br /><input type="file" id="content_part_data2" name="content_part_data2" /></td>
                </tr>
				<?php
			}
			?>
            <tr>
                <td class="formleft">Image Alignment</td>
                <td class="formright">
                	<label><input type="radio" name="content_part_data3" value="left" <?php if($row_part['content_part_data3']=="left") echo "checked"; ?> /> Left</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="center" <?php if($row_part['content_part_data3']=="center") echo "checked"; ?> /> Center</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="right" <?php if($row_part['content_part_data3']=="right") echo "checked"; ?> /> Right</label>
                    <br />If you want to align image to left of the page, choose "Left" or if you want it to center of the page, choose "center" or if you want it to right of the page, choose "right". It is applicable if the image' width is smaller than the page's width.
                </td>
            </tr>
            <tr>
                <td class="formleft">Image Caption</td>
                <td class="formright"><input type="text" name="content_part_data1" value="<?php echo stripslashes($row_part['content_part_data1']); ?>" class="mytextbox" /></td>
            </tr>
        	<tr>
            	<td class="formleft">&nbsp;</td>
				<td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
            <?php
		}
		else if($content_part_type=="TextImage")
		{
			?>
			<script type="text/javascript">
			var editor = CKEDITOR.instances['content_part_data1']; 
			if(editor) { 
				editor.destroy(true); 
			}
			$('.myeditor').ckeditor({
				langCode: 'en', 
				width : '100%',
				height : '300',
				toolbar:
				[
					['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
					['Image', 'Link', 'Unlink'],
					['Cut','Copy','Paste','PasteText','PasteFromWord','-','Find','Replace'],
					['SelectAll','RemoveFormat'],
					'/',
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Table','NumberedList','BulletedList'],
					['Format'],
					['TextColor','BGColor'],
					['Font','FontSize'],
				],
				filebrowserBrowseUrl:'ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
			});
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$("#content_part_data2").upload("ajax/content_part_image_upload.php?id="+data,function(res) {
								$('.mybtn_cancel').trigger('click');
							},function(data) {
							});
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide the paragraphs along with the image that you wish to add.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Paragraphs</td>
                <td class="formright"><textarea name="content_part_data1" class="myeditor"><?php echo stripslashes($row_part['content_part_data1']); ?></textarea></td>
            </tr>
            <?php
			if(empty($row_part['content_part_data2']))
			{
				?> 
                <tr>
                    <td class="formleft">Upload Image</td>
                    <td class="formright"><input type="file" id="content_part_data2" name="content_part_data2" />
                     <br /><b>Landscaped image dimension</b>
                     <br /> The dimensions of the image should be <?php echo LANDSCAPED_IMG_LG_W;?> px in width.
              		 <br />The height may vary with a maximum height of <?php echo LANDSCAPED_IMG_LG_H;?> px.
                     
               		 <br /><br /><b>Portrait image dimension</b> 
                     <br /> The dimensions of the image should be <?php echo PORTRAIT_IMG_LG_W;?> px in width.
             		 <br />The height may vary with a maximum height of  <?php echo PORTRAIT_IMG_LG_H;?> px.
                </td>
                </tr>
				<?php
			}
			else
			{
				?> 
                <tr>
                    <td class="formleft">Current Image</td>
                    <td class="formright"><img src="../<?php echo CONTENT_IMG.$row_part['content_part_data2']; ?>" width="200" /></td>
                </tr>
				<tr>
                    <td class="formleft">Replace Image</td>
                    <td class="formright"><input type="file" id="content_part_data2" name="content_part_data2" />
                     <br /><b>Landscaped image dimension</b> <br /> The dimensions of the image should be <?php echo LANDSCAPED_IMG_LG_W;?> px in width.
                <br />The height may vary with a maximum height of <?php echo LANDSCAPED_IMG_LG_H;?> px.
                <br /><br /><b>Portrait image dimension</b> <br /> The dimensions of the image should be <?php echo PORTRAIT_IMG_LG_W;?> px in width.
                <br />The height may vary with a maximum height of  <?php echo PORTRAIT_IMG_LG_H;?> px.
                </td>
                </tr>
				<?php
			}
			?>
            <tr>
                <td class="formleft">Image Alignment</td>
                <td class="formright">
                	<label><input type="radio" name="content_part_data3" value="left" <?php if($row_part['content_part_data3']=="left") echo "checked"; ?> /> Left</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="right" <?php if($row_part['content_part_data3']=="right") echo "checked"; ?> /> Right</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="top" <?php if($row_part['content_part_data3']=="top") echo "checked"; ?> /> Top</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="bottom" <?php if($row_part['content_part_data3']=="bottom") echo "checked"; ?> /> Bottom</label>
                 		<br />If you wish to select image alignment Left / Right provided image should be portrait <br />
                    If you wish to select image alignment Top / Bottom provided image should be landscaped.
               </td>
            </tr>
            <tr>
				<td class="formleft">&nbsp;</td>
				<td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
                </td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="Gallery")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$("#content_part_image").upload("ajax/content_part_gallery_upload.php?id=<?php echo $content_part_id; ?>",function(res) {
								$.ajax({
									url: 'ajax/content_part_gallery_show.php',
									type: 'post',
									data: { id: '<?php echo $content_part_id; ?>' },
									success: function(data){
										$('#gallery_block').html(data);
										$("#content_part_image").val('');
									}
								});
								//$('.mybtn_cancel').trigger('click');
								$('.saving').hide();
								$('.save').show();
								$('.mybtn_cancel').show();
							},function(data) {
							});
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide images for the gallery that you wish to add.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Images in Gallery</td>
                <td class="formright">
                	<div id="gallery_block">
                    	<script>
                		$.ajax({
							url: 'ajax/content_part_gallery_show.php',
							type: 'post',
							data: { id: '<?php echo $content_part_id; ?>' },
							success: function(data){
								$('#gallery_block').html(data);
							}
						});
						</script>
                	</div>
                </td>
            </tr>
            <tr>
                <td class="formleft">Upload Image</td>
                <td class="formright"><input type="file" id="content_part_image" name="content_part_image" /></td>
            </tr>
            <?php /*
            <tr>
                <td class="formleft">Gallery Appearance</td>
                <td class="formright">
                	<label><input type="radio" name="content_part_data3" value="carousel" /> Carousel</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="content_part_data3" value="grid" checked /> Grid</label>
                    <br />If you want to show this gallery image in carousel (single row sliding images), choose "Carousel" or if you want to show the gallery images in grid, choose "Grid".
                </td>
            </tr>
			*/ ?>
            <tr>
            	<td class="formleft">&nbsp;</td>
                <td class="formright">
                	<input type="button" value="Upload" class="mybtn save" />
					<div class="saving" style="width:100px;">Uploading</div>
                    <input type="button" value="Close" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="Link")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$('.mybtn_cancel').trigger('click');
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide a text and its link that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Text to the Link</td>
                <td class="formright"><input type="text" name="content_part_data1" value="<?php echo stripslashes($row_part['content_part_data1']); ?>" class="mytextbox" />
                <br />Provided text appears as the label for the link you provide below.<br />If it is left blank then the below provided URL or selected page name will appear instead.</td>
            </tr>
            <tr>
				<td class="formleft">Link To</td>
                <td class="formright">
                	<label><input type="radio" name="content_part_data2" value="I" class="link_to" <?php if($row_part['content_part_data2']=="I") echo "checked"; ?> /> Internal Page</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="radio" name="content_part_data2" value="E" class="link_to" <?php if($row_part['content_part_data2']=="E") echo "checked"; ?> /> External Page</label>
					<br />If you want to link within this website then choose "Internal Link" otherwise choose "External Link".
				</td>
			</tr>
			<tr>	
				<td class="formleft">&nbsp;</td>
                <td class="formright">
					<script>
                    $(function(){
                        $('.link_to').click(function(){
                            if($(this).val()=="E"){
                                $('#internal_link').fadeOut(function(){
                                    $('#external_link').fadeIn();								 
                                });		
                            }
                            else{
                                $('#external_link').fadeOut(function(){
                                    $('#internal_link').fadeIn();								 
                                });
                            }
                        });	   
                    });
                    </script>
                    <div id="internal_link" <?php if($row_part['content_part_data2']=="E") echo "style='display:none;'"; ?>>
                        <b>Select Page:</b>
                  <?php /*?>      <select name="content_part_data3" style="width:300px;">
                        	<option value="">No Link</option>
                            <?php //$mycnt->contentSelectBoxCms(0); ?>
                        </select><?php */?>
                        <select name="content_part_data3" style="width:300px;">
            	<option value="" <?php if($row_part['content_part_data3']=="") echo "selected"; ?>>Home Page</option>
            	<option value="mirror-gallery" <?php if($row_part['content_part_data3']=="mirror-gallery"){?>selected="selected"<?php } ?>>Mirror Gallery</option>
                	<?php
					$row_cats=$cat->showCategories(0);
					if(count($row_cats)){
						foreach($row_cats as $row_cat){
						?>
							<option value="mirror-gallery/<?php echo $row_cat['cat_alias']; ?>" <?php if($row_part['content_part_data3']=="mirror-gallery/".$row_cat['cat_alias']) echo "selected"; ?> style="padding-left:20px;"><?php echo $row_cat['cat_name']; ?></option>
							<?php	
							$row_products=$pro->showProducts($row_cat['cat_id']);
							if(count($row_products))
							{
								foreach($row_products as $row_product)
								{
									?>
									<option value="mirror-gallery/<?php echo $row_cat['cat_alias']; ?>/<?php echo $row_product['product_alias']; ?>" style="padding-left:40px;" <?php if($row_part['content_part_data3']=="mirror-gallery/".$row_cat['cat_alias']."/".$row_product['product_alias']) echo "selected"; ?>><?php echo $row_product['product_name']; ?></option>
                                    <?php	
							  	}
							}
					  	}
					}
                  	?>
              	<option value="bespoke-services" <?php if($row_part['content_part_data3']=="bespoke-services") echo "selected"; ?>>Bespoke Services</option>	
                	<?php
					$row_casestudies=$csd->showCaseStudies();
					if(count($row_casestudies)){
						foreach($row_casestudies as $row_casestudy){
							?>
							<option value="case-study/<?php echo $row_casestudy['casestudy_alias']; ?>" <?php if($row_part['content_part_data3']=="case-study/".$row_casestudy['casestudy_alias']) echo "selected"; ?> style="padding-left:20px;"><?php echo $row_casestudy['casestudy_name']; ?></option>
						  	<?php	
						}
					}
					?>
              	<option value="about-us" <?php if($row_part['content_part_data3']=="about-us") echo "selected"; ?>>About Us</option>	
                	<?php
                	$row_abouts=$cnt1->showContents(6);
                	if(count($row_abouts)){
                    	foreach($row_abouts as $row_about){
                        	?>
                        	<option value="about-us/<?php echo $row_about['content_alias']; ?>" <?php if($row_part['content_part_data3']=="about-us/".$row_about['content_alias']) echo "selected"; ?> style="padding-left:20px;"><?php echo $row_about['content_name']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>
            	<option value="contact-us" <?php if($row_part['content_part_data3']=="contact-us") echo "selected"; ?>>Contact Us</option>
                <option value="news"  <?php if($row_part['content_part_data3']=="news") echo "selected"; ?>>News</option>
                	<?php
                	$row_dnewss=$blg->showPublishedBlogs();
                	if(count($row_dnewss)){
                    	foreach($row_dnewss as $row_dnews){
                        	?>
                        	<option value="news/<?php echo $row_dnews['blog_alias']; ?>" <?php if($row_part['content_part_data3']=="news/".$row_dnews['blog_alias']) echo "selected"; ?> style="padding-left:20px;"><?php echo $row_dnews['blog_title']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>						     
				   <option value="other-services"  <?php if($row_part['content_part_data3']=="other-services") echo "selected"; ?> >Other Services</option>
                	<?php
                	$row_otherservices=$cnt1->showContents(16);
                	if(count($row_otherservices)){
                    	foreach($row_otherservices as $row_otherservice){
                        	?>
                        	<option value="other-services/<?php echo $row_otherservice['content_alias']; ?>" <?php if($row_part['content_part_data3']=="other-services/".$row_otherservice['content_alias']) echo "selected"; ?> style="padding-left:20px;"><?php echo $row_otherservice['content_name']; ?></option>
                       		<?php	
                    	}
                  	}
                  	?>								     
        	</select>
                        <br />Select the page that you want to link with the above text.</span>
                    </div>
                    <div id="external_link" <?php if($row_part['content_part_data2']=="I") echo "style='display:none;'"; ?>>
                        <b>URL:</b> <input type="text" name="content_part_data4" value="<?php echo stripslashes($row_part['content_part_data4']); ?>" placeholder="http://" style="width:85%;" />
                        <br />Provide a valid URL that strats from http:// or https://.
                    </div>
				</td>
			</tr>
			<tr>
				<td class="formleft">&nbsp;</td>
                <td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="File")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$("#content_part_data2").upload("ajax/content_part_file_upload.php?id="+data,function(res) {
								$('.mybtn_cancel').trigger('click');
							},function(data) {
							});
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide a text and its link that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Text to the File</td>
                <td class="formright"><input type="text" name="content_part_data1" value="<?php echo stripslashes($row_part['content_part_data1']); ?>" class="mytextbox" />
				<br />Provided text appears as the label for the file you browse below.<br />If it is left blank then the below provided file name will appear instead.</td>
			</tr>
			<?php
			if(empty($row_part['content_part_data2']))
			{
				?> 
                <tr>
                    <td class="formleft">Browse File</td>
                    <td class="formright"><input type="file" id="content_part_data2" name="content_part_data2" />
                    <br />It is better if you provide pdf file, not exceeding 2 MB in size.</td>
                </tr>
				<?php
			}
			else
			{
				?> 
                <tr>
                    <td class="formleft">Current File</td>
                    <td class="formright"><a href="../<?php echo CONTENT_FILE.$row_part['content_part_data2']; ?>"><?php echo $row_part['content_part_data2']; ?></a></td>
                </tr>
				<tr>
                    <td class="formleft">&nbsp;</td>
                    <td class="formright">If you wish to replace the above image then select a new image below.<br /><input type="file" id="content_part_data2" name="content_part_data2" /><br />It is better if you provide pdf file, not exceeding 2 MB in size.</td>
                </tr>
				<?php
			}
			?>
            <tr>
				<td class="formleft">&nbsp;</td>
				<td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                    <input type="button" value="Cancel" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="Video")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$('.mybtn_cancel').trigger('click');
						}
					});
				});
			});
			</script>
            <div class="info">
                Provide a title and the youtube link of the video that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Title to the Video</td>
                <td class="formright"><input type="text" name="content_part_data1" value="<?php echo stripslashes($row_part['content_part_data1']); ?>" class="mytextbox" />
				<br />Provided text appears as the title for the video file you select below.</td>
			</tr>
			<tr>
				<td class="formleft">Youtube Code</td>
                <td class="formright">www.youtube.com/watch?v=<input type="text" name="content_part_data5" value="<?php echo stripslashes($row_part['content_part_data5']); ?>" class="mytextbox" style="width:300px;" />
                <div style="border:#CCC 1px solid;background:#EEE;margin-top:10px;padding:10px 20px;">
                	<b>In order to capture the youtube code do the following:</b>
					<p>After uploading the video to youtube, go to the video page.<br />The URL of the video page, i.e. www.youtube.com/watch?v=xxxxxxxxxx,<br />in which xxxxxxxxxx is your youtube code which varies with different videos.<br />Copy the code and paste the code in the above text box.</p>
				</div>
				</td>
			</tr>
			<tr>
				<td class="formleft">&nbsp;</td>
                <td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving...</div>
                	<input type="button" value="Cancel" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		else if($content_part_type=="FAQ")
		{
			?>
			<script type="text/javascript">
			$(function() {
				$('.mybtn_cancel').click(function(){
					$.fancybox.close();					  
				});
				
				$('.save').click(function(){
					$(this).hide();
					$('.mybtn_cancel').hide();
					$('.saving').show();
					$.ajax({
						type: "POST",
						url: 'ajax/content_part_edit.php',
						data: $('#content_paragraph_form').serialize(),
						success: function(data){
							$('.mybtn_cancel').trigger('click');
						}
					});
				});
			});
			</script>
			<div class="info">
                Provide frequently asked questions that you wish to update.
            </div>
            <table border="0" class="myform">
            <tr>
                <td class="formleft">Question</td>
                <td class="formright"><textarea name="content_part_data1" class="mytextarea"><?php echo stripslashes($row_part['content_part_data1']); ?></textarea></td>
			</tr>
			<tr>
                <td class="formleft">Answer</td>
                <td class="formright"><textarea name="content_part_data2" class="mytextarea"><?php echo stripslashes($row_part['content_part_data2']); ?></textarea></td>
			</tr>
			<tr>
				<td class="formleft">&nbsp;</td>
                <td class="formright">
                	<input type="button" value="Save" class="mybtn save" />
					<div class="saving">Saving</div>
                    <input type="button" value="Close" class="mybtn_cancel" />
				</td>
			</tr>
			</table>
			<?php
		}
		?>
		<input type="hidden" name="content_part_id" value="<?php echo $content_part_id; ?>" />
		</form>
    </div>    
	<?php	
}
?>