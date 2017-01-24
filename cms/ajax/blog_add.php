<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['blog_title']))
{
	echo $blg->addBlog();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add News Article</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the news article details that you wish to add.
    </div>
    <form id="form_blog_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">News Article Title</td>
        <td class="formright">
        	<input type="text" name="blog_title" value="" class="mytextbox" />
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
						<label><input type="checkbox" name="blog_cats[<?php echo $row_blog_cat['blog_cat_id']; ?>]" /> <?php echo stripslashes($row_blog_cat['blog_cat_name']); ?></label>
                    </div>
            		<?php
				}
				?>
            	<?php /*?><br /><span class="grey">Put a tick mark to the categories those you wish to have as its categories.</span><?php */?>
            </td>
        </tr>
		<?php
	}
	?>
    <tr>
        <td class="formleft">Upload Thumbnail Image</td>
        <td class="formright">
        	<input type="file" id="blog_thumbimage" name="blog_thumbimage" />
            <br /><span class="grey">Upload a thumbnail image for the news article which appears in the index page of the news.
            <br />The dimension of the image should be <?php echo BLOG_IMG_TH_W; ?> px in width and <?php echo BLOG_IMG_TH_H; ?> px in height.
            <br />If it is different than this then it will appear incorrectly.</span>
       	</td>
    </tr>
    <tr>
        <td class="formleft">News Article Content</td>
        <td class="formright">
        	<textarea name="blog_desc" class="myeditor"></textarea>
        	<span class="grey">Provided text appears as the content for the news article.</span>    
       	</td>
    </tr>
    <tr>
        <td class="formleft">Upload News Article Image</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_image" class="blog_image" /> Do you wish to upload an image to this news article?</label>
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
            <div id="blog_image" style="margin:10px 0 0 20px;display:none;">
        		Where do you wish to align the image to the paragraph?
                <div style="margin:5px 0 10px 20px;">
                    <label><input type="radio" name="blog_image_alignment" value="T" checked /> Top of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="B" /> Bottom of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="L" /> Left of the paragraph</label>
                    <br /><label><input type="radio" name="blog_image_alignment" value="R" /> Right of the paragraph</label>
                </div>    
                Which image do you wish to upload?
                <div style="margin:5px 0 0 20px;">
                	<input type="file" id="blog_imagename" name="blog_imagename" />
                	<br /><span class="grey">Provided image appears as the image for news article.
                	 <br />The dimensions of the image should be <?php echo BLOG_IMG_W; ?> px in maximum width.
                        <br />The height may vary with a maximum height of <?php echo BLOG_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product 
                        <br />If it is different than this then it will appear incorrectly.
            	</div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">Downloadable File</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_file" class="blog_file" /> Do you wish to add a downloadable file to this news article?</label>
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
            <div id="blog_file" style="margin:10px 0 0 20px;display:none;">
        		Enter the title for the downloadable link
                <div style="margin:5px 0 15px 0;">
                    <input type="text" name="blog_filetitle" value="" class="mytextbox" />
                </div>    
                Which file do you wish to upload?
                <div style="margin:5px 0 0 0;">
                	<input type="file" id="blog_filename" name="blog_filename" />
                	<br /><span class="grey">Provided file appears as the downloadable document for news article.
                    <br />The file needs to be PDF or DOC and no larger than 2 MB in size.</span>
            	</div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">Link to News Article</td>
        <td class="formright">
        	<label><input type="checkbox" name="blog_link" class="blog_link" /> Do you wish to add a link to this news article?</label>
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
            <div id="blog_link" style="margin:10px 0 0 20px;display:none;">
        		Enter the title for the hyperlink
                <div style="margin:5px 0 15px 0;">
                    <input type="text" name="blog_linktitle" value="" class="mytextbox" />
                </div>    
                Where do you wish to link this news article to? Enter URL:
                <div style="margin:5px 0 0 0;">
                	<input type="text" name="blog_linkurl" value="http://" class="mytextbox" />
                	<br /><span class="grey">Provided URL will link to the news article and when clicked the entered link opens in a new tab.
                    <br />The provided link show start from http:// or https://.</span>
            	</div>
        	</div>
        </td>
    </tr>
    <tr>
        <td class="formleft">News Article Date</td>
        <td class="formright">
        	<script>
			$(function(){
				$(".mydatepicker").datepicker({
					dateFormat: "yy-mm-dd",
					minDate: "<?php echo date("Y-m-d"); ?>"
				});
			});
			</script>
            <input type="text" name="blog_date" value="<?php echo date("Y-m-d"); ?>" class="mydatepicker" />
        	<br /><span class="grey">Provided text appears as the title of the news article.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<label><input type="checkbox" id="publish" name="blog_status" /> Publish this news article</label>
        	<br /><span class="grey">If you wish to publish this news article in the news article page, put a tick mark.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn blog_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
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
		$('.blog_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/blog_add.php',
				type: 'post',
				data: $('#form_blog_add').serialize(),
				success: function(id){
					$("#blog_thumbimage").upload("ajax/blog_thumbimage_upload.php?id="+id,function(res){
						$("#blog_imagename").upload("ajax/blog_image_upload.php?id="+id,function(res){
							$("#blog_filename").upload("ajax/blog_file_upload.php?id="+id,function(res){
								 if($('#publish').is(':checked'))
								  {
									 $(location).attr('href','login.php?p_id=manage_blog_emails&id='+id);
								  }
								  else
								  {
									 $.fancybox.close();
								   }
								
								//
							},function(data){});
						},function(data){});	
					},function(data){});
				}
			});
		});
	});
	</script>
</div>