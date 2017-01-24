<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=3;
$show_tab="casestudy_parts";
$casestudy_id=$_REQUEST['id'];
$row_casestudy=$csd->showCaseStudy($casestudy_id);
?>
<h1><?php echo stripslashes($row_casestudy['casestudy_name']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_bespokes">Back to Bespoke Servies</a></div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_bespokes">Bespoke Services</a> &raquo; <?php echo stripslashes($row_casestudy['casestudy_name']); ?>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="casestudy_detail" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="casestudy_detail") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE CASE STUDY DETAIL</a></div>
<div id="casestudy_detail" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="casestudy_detail")?"block":"none"; ?>;">
	<div class="info">
        Provide the case study detail that you wish to update.
    </div>
    <form id="form_casestudy_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Case Study Name</td>
        <td class="formright"><input type="text" name="casestudy_name" value="<?php echo stripslashes($row_casestudy['casestudy_name']); ?>" class="mytextbox" /></td>
    </tr>
  <?php /*?>  <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="casestudy_desc" class="mytextarea"><?php echo stripslashes($row_casestudy['casestudy_desc']); ?></textarea></td>
    </tr><?php */?>
    <input type="hidden" name="casestudy_desc" value="" />
    <?php
	if(empty($row_casestudy['casestudy_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Image</td>
            <td class="formright"><input type="file" id="casestudy_image" name="casestudy_image" value="" />
              <b class="line_height"><br />The uploaded image will appear as the case study on the bespoke service page.
            <br /> <br />The dimension of this image should be <?php echo CASESTUDY_IMG_W ?> px in width and <?php echo CASESTUDY_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                        </b>
            </td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Image</td>
            <td class="formright"><img src="../<?php echo CASESTUDY_IMG.$row_casestudy['casestudy_image']; ?>" width="200" />
            <b class="line_height"><br />The uploaded image will appear as the case study on the bespoke service page.
            <br /><br />The dimension of this image should be <?php echo CASESTUDY_IMG_W ?> px in width and <?php echo CASESTUDY_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
            <br /><br />If you decide to upload a new image, it will replace the existing one. 
            </b></td>
        </tr>
		<tr>
            <td class="formleft"></td>
            <td class="formright"><input type="file" id="casestudy_image" name="casestudy_image" /></td>
        </tr>
		<?php
	}
	?>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn casestudy_edit" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="casestudy_id" value="<?php echo $casestudy_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.casestudy_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/casestudy_edit.php',
				type: 'post',
				data: $('#form_casestudy_edit').serialize(),
				success: function(){
					$("#casestudy_image").upload("ajax/casestudy_image_upload.php?id=<?php echo $casestudy_id; ?>",function(res){
						$('.saving').fadeOut(function(){
							$('.saved').show().delay(1000).hide(function(){
								t.show();
								$(location).attr('href','login.php?p_id=manage_casestudy&id=<?php echo $casestudy_id; ?>');	
							});	
						});
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="casestudy_parts" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="casestudy_parts") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE CONTENT FOR THE CASE STUDY</a></div>
<div id="casestudy_parts" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="casestudy_parts")?"block":"none"; ?>;">
    <div class="insert_options">
        <h3>Add more content to your page</h3>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Title" class="add_part fancybox.ajax"><img src="images/icons/title.png" border="0" /><br />Title</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Text" class="add_part fancybox.ajax"><img src="images/icons/text.png" border="0" /><br />Text Only</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Image" class="add_part fancybox.ajax"><img src="images/icons/image.png" border="0" /><br />Image Only</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=TextImage" class="add_part fancybox.ajax"><img src="images/icons/textimage.png" border="0" /><br />Text &amp; Image</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Gallery" class="add_part fancybox.ajax"><img src="images/icons/gallery.png" border="0" /><br />Gallery</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Link" class="add_part fancybox.ajax"><img src="images/icons/link.png" border="0" /><br />Link</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=File" class="add_part fancybox.ajax"><img src="images/icons/file.png" border="0" /><br />File</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=Video" class="add_part fancybox.ajax"><img src="images/icons/video.png" border="0" /><br />Video</a>
        <a href="ajax/casestudy_part_add.php?id=<?php echo $casestudy_id; ?>&type=FAQ" class="add_part fancybox.ajax"><img src="images/icons/faq.png" border="0" /><br />FAQs</a>
        <div class="clearboth"></div>
        <script>
        $(function(){
            $('.add_part').fancybox({
                'beforeClose': function(){
                    $.ajax({
                        type: 'post',
                        url: 'ajax/casestudy_part_show.php',
                        data: { id: '<?php echo $casestudy_id; ?>' },
                        success: function(data){
                            $('#casestudy_paragraph_block').html(data);
                            $('.saving').hide();
                        }   
                    });	
                }						
            });
            $('.youtube_video').fancybox();
        });
        </script>
    </div>
	<div id="casestudy_paragraph_block">
    	<script>
		$(function(){
			$.ajax({
				type: 'post',
				url: 'ajax/casestudy_part_show.php',
				data: { id: '<?php echo $casestudy_id; ?>' },
				success: function(data){
					$('#casestudy_paragraph_block').html(data);
				}   
			});	
        });
		</script>
	</div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="casestudy_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="casestudy_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE CASE STUDY PAGE</a></div>
<div id="casestudy_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="casestudy_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the case study page that you wish to have.
    </div>
    <form id="form_casestudy_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="casestudy_titletag" value="<?php echo stripslashes($row_casestudy['casestudy_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="casestudy_metakeywords" class="mytextarea"><?php echo stripslashes($row_casestudy['casestudy_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="casestudy_metadescription" class="mytextarea"><?php echo stripslashes($row_casestudy['casestudy_metadescription']); ?></textarea></td>
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
    <input type="hidden" name="casestudy_id" value="<?php echo $casestudy_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/casestudy_seo_save.php',
				type: 'post',
				data: $('#form_casestudy_seo').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
				}
			})
		});
	});
	</script>
</div>