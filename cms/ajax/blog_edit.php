<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['blog_id']))
{
	echo $blg->saveBlog();
	exit;
}
$blog_id=$_REQUEST['id'];
$row_blog=$blg->showBlog($blog_id);
?>
<div class="container" style="margin:0;">
    <h1>Edit News Article</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the news article details that you wish to update.
    </div>
    <form id="form_blog_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Nnews Article Title</td>
        <td class="formright">
        	<input type="text" name="blog_title" value="<?php echo stripslashes($row_blog['blog_title']); ?>" class="mytextbox" />
        	<br /><span class="grey">Provided text appears as the title of the news article.</span>
      	</td>
    </tr>
    <?php
	$row_blog_cats=$blg->showBlogCategories();
	if(count($row_blog_cats))
	{
		?>		
        <tr>
            <td class="formleft">Related Categories</td>
            <td class="formright">
                <?php
                foreach($row_blog_cats as $row_blog_cat)
				{
					?>
                	<div style="float:left;width:33%">
						<label><input type="checkbox" name="blog_cats[<?php echo $row_blog_cat['blog_cat_id']; ?>]" <?php echo $blg->isCheckedCategory($blog_id,$row_blog_cat['blog_cat_id']); ?> /> <?php echo stripslashes($row_blog_cat['blog_cat_name']); ?></label>
                    </div>
            		<?php
				}
				?>
            <?php /*?>	<br /><span class="grey">Put a tick mark to the categories those you wish to have as its categories.</span><?php */?>
            </td>
        </tr>
		<?php
	}
	if(empty($row_blog['blog_thumbimage']))
	{
		?>
        <tr>
            <td class="formleft">Upload Thumbnail Image</td>
            <td class="formright">
                <input type="file" id="blog_thumbimage" name="blog_thumbimage" />
                <br /><span class="grey">Upload a thumbnail image for the news article which appears in the index page of the news article.
                <br />The dimension of the image should be <?php echo BLOG_IMG_TH_W; ?> px in width and <?php echo BLOG_IMG_TH_H; ?>  px in height.
                <br />If it is different than this then it will appear incorrectly.</span>
            </td>
        </tr>
        <?php
	}
	else
	{
		?>
        <tr>
            <td class="formleft">Thumbnail Image</td>
            <td class="formright"><img src="../<?php echo BLOG_IMG_TH.$row_blog['blog_thumbimage']; ?>" width="150" /></td>
        </tr>
        <tr>
            <td class="formleft">Upload New Image</td>
            <td class="formright">
                <input type="file" id="blog_thumbimage" name="blog_thumbimage" />
                <br /><span class="grey">Upload a thumbnail image for the news article which appears in the index page of the news article.
                <br />The dimension of the image should be <?php echo BLOG_IMG_TH_W; ?> px in width and <?php echo BLOG_IMG_TH_H; ?> px in height.
                <br />If it is different than this then it will appear incorrectly.
                <br />Uploading a new image will replace the existing one.</span>
            </td>
        </tr>
        <?php	
	}
	?>
    <tr>
        <td class="formleft">Nnews Article Content</td>
        <td class="formright">
        	<textarea name="blog_desc" class="myeditor"><?php echo stripslashes($row_blog['blog_desc']); ?></textarea>
        	<span class="grey">Provided text appears as the content for the news article.</span>    
       	</td>
    </tr>
    <tr>
        <td class="formleft">Upload Nnews Article Image</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_image" class="blog_image" <?php if($row_blog['blog_image']==1) echo "checked"; ?> /> Do you wish to upload an image to this news article?</label>
            <script>
			$(function(){
				$('.blog_image').click(function(){
					if($(this).is(':checked'))
						$('#blog_image').show();
					else
						$('#blog_image').hide();
				});
			});
			</script>
            <div id="blog_image" style="margin:10px 0 0 20px;display:<?php echo $row_blog['blog_image']==1?"display":"none"; ?>;">
        		Where do you wish to align the image to the paragraph?
                <div style="margin:5px 0 10px 20px;">
                    <label><input type="radio" name="blog_image_alignment" value="T" <?php if($row_blog['blog_image_alignment']=="T") echo "checked"; ?> /> Top of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="B" <?php if($row_blog['blog_image_alignment']=="B") echo "checked"; ?> /> Bottom of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="L" <?php if($row_blog['blog_image_alignment']=="L") echo "checked"; ?> /> Left of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="R" <?php if($row_blog['blog_image_alignment']=="R") echo "checked"; ?> /> Right of the paragraph</label>
                </div>    
                Which image do you wish to upload?
                <div style="margin:5px 0 0 20px;">
                	<?php
                	if(empty($row_blog['blog_imagename']))
                    {
                        ?>
                        <input type="file" id="blog_imagename" name="blog_imagename" />
                        <br /><span class="grey">Provided image appears as the image for news article.
                        <br />The dimensions of the image should be <?php echo BLOG_IMG_W; ?> px in maximum width.
                        <br />The height may vary with a maximum height of <?php echo BLOG_IMG_W; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product 
                        <br />If it is different than this then it will appear incorrectly.</span>
                        <?php
					}
					else
					{
						?>
                        Current Image:
                        <br /><img src="../<?php echo BLOG_IMG.$row_blog['blog_imagename']; ?>" width="150" />
                        <br /><br />
                        If you wish to change the image, browse the image below
                        <br /><input type="file" id="blog_imagename" name="blog_imagename" />
                         <br />The dimensions of the image should be <?php echo BLOG_IMG_W; ?> px in maximum width.
                        <br />The height may vary with a maximum height of <?php echo BLOG_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product 
                        <br />If it is different than this then it will appear incorrectly.
                        <br />Uploading a new image will replace the existing one.</span>
                        <?php	
					}
					?>
            	</div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">Downloadable File</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_file" class="blog_file" <?php if($row_blog['blog_file']==1) echo "checked"; ?> /> Do you wish to add a downloadable file to this news article?</label>
            <script>
			$(function(){
				$('.blog_file').click(function(){
					if($(this).is(':checked'))
						$('#blog_file').show();
					else
						$('#blog_file').hide();
				});
			});
			</script>
            <div id="blog_file" style="margin:10px 0 0 20px;display:<?php echo $row_blog['blog_file']==1?"display":"none"; ?>;">
        		Enter the title for the downloadable link
                <div style="margin:5px 0 15px 0;">
                    <input type="text" name="blog_filetitle" value="<?php echo stripslashes($row_blog['blog_filetitle']); ?>" class="mytextbox" />
                </div>    
                Which file do you wish to upload?
                <div style="margin:5px 0 0 0;">
                	<?php
                	if(empty($row_blog['blog_filename']))
                    {
                        ?>
                        <input type="file" id="blog_filename" name="blog_filename" />
                        <br /><span class="grey">Provided file appears as the downloadable document for news article.
                        <br />The file needs to be PDF or DOC and no larger than 2 MB in size.</span>
                        <?php
					}
					else
					{
						?>
                        Current File: <a href="../<?php echo BLOG_FILE.$row_blog['blog_filename']; ?>" target="_blank"><?php echo $row_blog['blog_filename']; ?></a>
                        <br /><br />
                        If you wish to change the file, browse the file below
                        <br /><input type="file" id="blog_filename" name="blog_filename" />
                        <br /><span class="grey">Provided file appears as the downloadable document for news article.
                        <br />The file needs to be PDF or DOC and no larger than 2 MB in size.
                        <br />Uploading a new file will replace the existing one.</span>
                        <?php	
					}
					?>
                </div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">Link to Nnews Article</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_link" class="blog_link" <?php if($row_blog['blog_link']==1) echo "checked"; ?> /> Do you wish to add a link to this news article?</label>
            <script>
			$(function(){
				$('.blog_link').click(function(){
					if($(this).is(':checked'))
						$('#blog_link').show();
					else
						$('#blog_link').hide();
				});
			});
			</script>
            <div id="blog_link" style="margin:10px 0 0 20px;display:<?php echo $row_blog['blog_link']==1?"display":"none"; ?>;">
        		Enter the title for the hyperlink
                <div style="margin:5px 0 15px 0;">
                    <input type="text" name="blog_linktitle" value="<?php echo stripslashes($row_blog['blog_linktitle']); ?>" class="mytextbox" />
                </div>    
                Where do you wish to link this news article to? Enter URL:
                <div style="margin:5px 0 0 0;">
                	<input type="text" name="blog_linkurl" value="<?php echo stripslashes($row_blog['blog_linkurl']); ?>" class="mytextbox" />
                	<br /><span class="grey">Provided URL will link to the news article and when clicked the entered link opens in a new tab.
                    <br />The provided link show start from http:// or https://.</span>
            	</div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">Nnews Article Date</td>
        <td class="formright">
        	<script>
			$(function(){
				$(".mydatepicker").datepicker({
					dateFormat: "yy-mm-dd",
					minDate: "<?php echo date("Y-m-d"); ?>"
				});
			});
			</script>
            <input type="text" name="blog_date" value="<?php echo substr($row_blog['blog_date'],0,10); ?>" class="mydatepicker" />
        	<br /><span class="grey">Provided text appears as the title of the news article.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_status" <?php if($row_blog['blog_status']==1) echo "checked"; ?> /> Publish this news article</label>
        	<br /><span class="grey">If you wish to publish this news article in the news article page, put a tick mark.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn blog_update" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>" />
    </form>
    <script>
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
	$(function(){
		$('.blog_update').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/blog_edit.php',
				type: 'post',
				data: $('#form_blog_edit').serialize(),
				success: function(){
					$("#blog_thumbimage").upload("ajax/blog_thumbimage_upload.php?id=<?php echo $blog_id; ?>",function(res){
						$("#blog_imagename").upload("ajax/blog_image_upload.php?id=<?php echo $blog_id; ?>",function(res){
							$("#blog_filename").upload("ajax/blog_file_upload.php?id=<?php echo $blog_id; ?>",function(res){
								$.fancybox.close();
							},function(data){});
						},function(data){});	
					},function(data){});
				}
			});
		});
	});
	</script>
</div>