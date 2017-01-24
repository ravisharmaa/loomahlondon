<?php 
if(isset($_POST['submitted']) and $_POST['submitted']=="Save")
{
	$legal_id=$_POST['legal_id'];
	$cnt->updateLegalDetails();
	echo "<script language='javascript'>document.location='login.php?p_id=manage_legal&page=".$legal_id."&saved=yes'</script>";
}


if(isset($_REQUEST['page']) and $_REQUEST['page']==1)
{
	$legal_id=1;
	$row_content = $cnt->getLegalDetails($legal_id);
	 ?>
	 <h1><?php echo stripslashes($row_content['legal_title']); ?></h1>
	<div class="clearboth"></div>
	<div class="breadcrumb"><a href="login.php" >Dashboard</a> &raquo; <?php echo stripslashes($row_content['legal_title']); ?></div>
	<div id="contact_page">
    <?php
    if(isset($_REQUEST['saved']) and $_REQUEST['saved']=="yes")
	{
		?>
        <div class="ok">successfully updated.</div>
        <?php
	}
	else
	{
	?>
	 <div class="info">Provide the information and SEO that you wish to have on terms & conditions page.</div>
     <?php
	}
	?>
	<form action="" method="post" enctype="multipart/form-data">
	<table border="0" class="myform">
	<tr>
		<td colspan="2" class="formright"><b>Page contents</b></td>
	</tr>
	<tr>
		<td class="formleft">Title</td>
		<td class="formright"><input type="text" name="legal_title" class="mytextbox" value="<?php echo stripslashes($row_content['legal_title']); ?>" /></td>
	</tr>
	<tr>
		
		<td class="formright" colspan="2"><textarea rows="4" name="legal_desc" class="myeditor" ><?php echo stripslashes($row_content['legal_desc']); ?></textarea></td>
	</tr>
	<?php /*?>  <?php
		if(empty($row_content['banner_image']))
		{
			?>
			<tr>
				<td class="formleft">Upload Banner Image</td>
				<td class="formright"><input type="file" id="cat_banner_image" name="banner_image" value="" />
							 <b class="line_height"><br />The uploaded image will appear on the top of contact us page.
				<br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
				<br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
				</b></td>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
				<td class="formleft">Banner Image</td>
				<td class="formright"><img src="../<?php echo BANNER_IMG.$row_content['banner_image']; ?>" alt="Banner Image" title="Banner Image" width="695" /></td>
			</tr>
			<tr>
				<td class="formleft">Replace Image</td>
				<td class="formright"><input type="file" id="cat_banner_image" name="banner_image" />
					   <b class="line_height"><br />The uploaded image will appear on the top of contact us page.
				<br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
				<br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
				<br /><br />If you decide to upload a new image, it will replace the existing one. 
				</b></td>
			</tr>
			<?php
		}
		?>
	
	<tr>
		<td class="formleft">Description</td>
		<td class="formright"><input type="text" name="contact_desc" class="mytextbox" value="<?php echo stripslashes($row_content['contact_desc']); ?>" /></td>
	</tr><?php */?>
	
	
	<tr>
		<td colspan="2" class="formright"><b>Search engine optimisation</b></td>
	</tr>
	<tr>
		<td class="formleft">Title tag</td>
		<td class="formright"><input type="text" name="meta_titletag" class="mytextbox" value="<?php echo stripslashes($row_content['meta_titletag']); ?>" /></td>
	</tr>
	<tr>
		<td class="formleft">Meta keywords</td>
		<td class="formright"><textarea name="meta_keywords" class="mytextarea"><?php echo stripslashes($row_content['meta_keywords']); ?></textarea></td>
	</tr>
	<tr>
		<td class="formleft">Meta description</td>
		<td class="formright"><textarea name="meta_description" class="mytextarea"><?php echo stripslashes($row_content['meta_description']); ?></textarea></td>
	</tr>
	<tr>
		<td class="formleft">&nbsp;</td>
		<td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /> &nbsp; &nbsp;
	 <!--   <a href="login.php?p_id=manage_handles" class="cancel_btn">Cancel</a>-->
		</td>
	</tr>
	</table>
	<input type="hidden" name="legal_id" id="legal_id" value="<?php echo stripslashes($row_content['legal_id']); ?>" />
	
	</form>
	
	</div>
<?php
}

if(isset($_REQUEST['page']) and $_REQUEST['page']==2)
{
	$legal_id=2;
	$row_content = $cnt->getLegalDetails($legal_id);
	 ?>
	 <h1><?php echo stripslashes($row_content['legal_title']); ?></h1>
	<div class="clearboth"></div>
	<div class="breadcrumb"> <a href="login.php" >Dashboard</a> &raquo; Privacy Policy </div>
	<div id="contact_page">
	    <?php
    if(isset($_REQUEST['saved']) and $_REQUEST['saved']=="yes")
	{
		?>
        <div class="ok">successfully updated.</div>
        <?php
	}
	else
	{
	?>
	 <div class="info">Provide the information and SEO that you wish to have on terms and condition page.</div>
     <?php
	}
	?>
	<form action="" method="post" enctype="multipart/form-data">
	<table border="0" class="myform">
	<tr>
		<td colspan="2" class="formright"><b>Page contents</b></td>
	</tr>
	<tr>
		<td class="formleft">Title</td>
		<td class="formright"><input type="text" name="legal_title" class="mytextbox" value="<?php echo stripslashes($row_content['legal_title']); ?>" /></td>
	</tr>
	<tr>
		<td class="formright" colspan="2"><textarea rows="4" name="legal_desc" class="myeditor" ><?php echo stripslashes($row_content['legal_desc']); ?></textarea></td>
	</tr>
	<?php /*?>  <?php
		if(empty($row_content['banner_image']))
		{
			?>
			<tr>
				<td class="formleft">Upload Banner Image</td>
				<td class="formright"><input type="file" id="cat_banner_image" name="banner_image" value="" />
							 <b class="line_height"><br />The uploaded image will appear on the top of contact us page.
				<br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
				<br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
				</b></td>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
				<td class="formleft">Banner Image</td>
				<td class="formright"><img src="../<?php echo BANNER_IMG.$row_content['banner_image']; ?>" alt="Banner Image" title="Banner Image" width="695" /></td>
			</tr>
			<tr>
				<td class="formleft">Replace Image</td>
				<td class="formright"><input type="file" id="cat_banner_image" name="banner_image" />
					   <b class="line_height"><br />The uploaded image will appear on the top of contact us page.
				<br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
				<br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
				<br /><br />If you decide to upload a new image, it will replace the existing one. 
				</b></td>
			</tr>
			<?php
		}
		?>
	
	<tr>
		<td class="formleft">Description</td>
		<td class="formright"><input type="text" name="contact_desc" class="mytextbox" value="<?php echo stripslashes($row_content['contact_desc']); ?>" /></td>
	</tr><?php */?>
	
	
	<tr>
		<td colspan="2" class="formright"><b>Search engine optimisation</b></td>
	</tr>
	<tr>
		<td class="formleft">Title tag</td>
		<td class="formright"><input type="text" name="meta_titletag" class="mytextbox" value="<?php echo stripslashes($row_content['meta_titletag']); ?>" /></td>
	</tr>
	<tr>
		<td class="formleft">Meta keywords</td>
		<td class="formright"><textarea name="meta_keywords" class="mytextarea"><?php echo stripslashes($row_content['meta_keywords']); ?></textarea></td>
	</tr>
	<tr>
		<td class="formleft">Meta description</td>
		<td class="formright"><textarea name="meta_description" class="mytextarea"><?php echo stripslashes($row_content['meta_description']); ?></textarea></td>
	</tr>
	<tr>
		<td class="formleft">&nbsp;</td>
		<td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /> &nbsp; &nbsp;
	 <!--   <a href="login.php?p_id=manage_handles" class="cancel_btn">Cancel</a>-->
		</td>
	</tr>
	</table>
	<input type="hidden" name="legal_id" id="legal_id" value="<?php echo stripslashes($row_content['legal_id']); ?>" />
	
	</form>
	
	</div>
<?php
}
?>
