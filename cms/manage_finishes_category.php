<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
?>
<?php
if(isset($_POST['submitted']) and $_POST['submitted']=="Save")
{
	$fincatid=$finishes->addCategory();
	echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&cat_id=".$fincatid."'</script>";
}
?>
<?php
if(isset($_POST['submitted']) and $_POST['submitted']=="Update")
{
	$cat_id=$_REQUEST['cat_id'];
	$allcnt->updateContent();
	 echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_category&cat_id=".$cat_id."&parent_id=1&act=subpage'</script>";
}
?>
<?php
if(isset($_REQUEST['act']))
{
	switch($_REQUEST['act'])
	{
		case "add":
			?>
            <h1>Finishes</h1>
            <h2 class='goback'><a href="login.php?p_id=manage_finishes">Back to finishes</a></h2>
            <div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php" >Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes">Finishes</a>
 &raquo; Add new category</div>
 

<div class="info">Provide the category information that you wish to add.</div>
			<form action="" method="post" enctype="multipart/form-data">
<table border="0" class="myform">
<tr>
    <td colspan="2" class="formright"><b>Category information</b></td>
</tr>
<tr>
    <td class="formleft">Category name</td>
    <td class="formright"><input type="text" name="content_title" class="mytextbox"  /></td>
</tr>
<!--<tr>
    <td colspan="2" class="formright">Descriptions<br /><textarea name="content_desc" rows="4" class="myeditor"></textarea></td>
</tr>
<tr>
    <td colspan="2" class="formright"><b>Search Engine Optimization</b></td>
</tr>
<tr>
    <td class="formleft">Title Tag</td>
    <td class="formright"><input type="text" name="content_titletag" size="110" /></td>
</tr>
<tr>
    <td class="formleft">Meta Keywords</td>
    <td class="formright"><textarea name="content_metakeywords" cols="83" rows="5"></textarea></td>
</tr>
<tr>
    <td class="formleft">Meta Description</td>
    <td class="formright"><textarea name="content_metadescription" cols="83" rows="5"></textarea></td>
</tr>-->
<tr>
    <td class="formleft">&nbsp;</td>
    <td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /> &nbsp; &nbsp;
    
    </td>
</tr>
</table>
<input type="hidden" name="content_id" id="content_id" value="<?php echo stripslashes($row_content['content_id']); ?>" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo stripslashes($row_content['parent_id']); ?>" />
</form>
<?php
break;
case "edit":
$cat_id=$_REQUEST['cat_id'];
$row_content = $allcnt->getContent($cat_id);

?>
       <h2>Finishes</h2>
<div class="breadcrumb">You are here: <a href="login.php" class="bclink">Dashboard</a> &gt; <a href="login.php?p_id=manage_finishes" class="bclink">Finishes</a>
 &gt; <a href="login.php?p_id=manage_finishes_category&cat_id=<?php echo $_REQUEST['cat_id'];?>&parent_id=<?php echo $_REQUEST['parent_id'];?>&act=subpage" class="bclink" ><?php echo stripslashes($row_content['content_title']); ?></a> &gt; Edit <?php echo stripslashes($row_content['content_title']); ?></div>
<div class="spacer20"></div>
<form action="" method="post" enctype="multipart/form-data">
<table border="0" class="myform">
<tr>
    <td colspan="2" class="formright"><b>Category Information</b></td>
</tr>
<tr>
    <td class="formleft">Title</td>
    <td class="formright"><input type="text" name="content_title" size="110" value="<?php echo stripslashes($row_content['content_title']); ?>" /></td>
</tr>
<tr>
    <td colspan="2" class="formright"><textarea name="content_desc" rows="4" class="myeditor"><?php echo stripslashes($row_content['content_desc']); ?></textarea></td>
</tr>
<tr>
    <td colspan="2" class="formright"><b>Search Engine Optimization</b></td>
</tr>
<tr>
    <td class="formleft">Title Tag</td>
    <td class="formright"><input type="text" name="content_titletag" size="110" value="<?php echo stripslashes($row_content['title_tag']); ?>" /></td>
</tr>
<tr>
    <td class="formleft">Meta Keywords</td>
    <td class="formright"><textarea name="content_metakeywords" cols="83" rows="5"><?php echo stripslashes($row_content['meta_keywords']); ?></textarea></td>
</tr>
<tr>
    <td class="formleft">Meta Description</td>
    <td class="formright"><textarea name="content_metadescription" cols="83" rows="5"><?php echo stripslashes($row_content['meta_descriptions']); ?></textarea></td>
</tr>
<tr>
    <td class="formleft">&nbsp;</td>
    <td class="formright"><input type="submit" name="submitted" value="Update" class="mybtn" /> &nbsp; &nbsp;
    <a href="login.php?p_id=manage_finishes&content_id=<?php echo $content_id;?>" class="cancel_btn">Cancel</a>
    </td>
</tr>
</table>
<input type="hidden" name="content_id" id="content_id" value="<?php echo stripslashes($row_content['content_id']); ?>" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo stripslashes($row_content['parent_id']); ?>" />
</form>
<?php
   break;
 case "del":
 $cat_id=$_REQUEST['cat_id'];
  $allcnt->delCategory($cat_id);
   echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes'</script>";
 break;
   
 case "subpage":
 $cat_id=$_REQUEST['cat_id'];
 $row_cats=$allcnt->getContent($cat_id);
   ?> 
<div class="lText">Finishes</div>
<div class="pnav">You are here: <a href="login.php" class="bclink">Dashboard</a> &gt; <a href="login.php?p_id=manage_finishes" class="bclink">Finishes</a> &gt; <a href="login.php?p_id=manage_finishes_category" class="bclink">Categories</a> &gt; <?php echo $row_cats['content_title']; ?> </div>
<div class="spacer20"></div>
 <div class="mpleft">
		<div class="maintitle" style="padding-left: 10px;"><b>Descriptions and SEO</b></div>
		<div class="maincont" style="padding: 10px; text-align: left;">Manage descriptions and SEO<br /><br />
			<a href="login.php?p_id=manage_finishes_category&act=edit&cat_id=<?php  echo  $_REQUEST['cat_id'];?>&parent_id=<?php echo $_REQUEST['cat_id'];?>" class="brown">Click Here</a>
		</div>
	</div>
     <div class="mpright">
		<div class="maintitle" style="padding-left: 10px;"><b>Products</b></div>
		<div class="maincont" style="padding: 10px; text-align: left;">Manage Products<br /><br />
			<a href="login.php?p_id=manage_products&cat_id=<?php echo $_REQUEST['cat_id'];?>" class="brown">Click Here</a>
		</div>
	</div>
    <?php

	}
	
	
}
else
{
?>
<div class="lText">Finishes</div>
<div class="pnav">You are here: <a href="login.php" class="bclink">Dashboard</a> &gt; <a href="login.php?p_id=manage_finishes" class="bclink">Finishes</a> &gt; Categories</div>
<div class="spacer20"></div>
<a href="login.php?p_id=manage_finishes_category&act=add" class="add_btn" >ADD NEW CATEGORY</a>
<div class="spacer20"></div>
<?php
$row_cats=$allcnt->getCategories();
count($row_cats);
$j=0;
?>
<ul id='mysorter'>
<?php
foreach($row_cats as $row_cat)
{
	?>	
    <li id="recordsArray_<?php echo $row_cat['finishes_cat_id']; ?>" style="margin:0;">
<?php /*?>    <div  class="<?php if($j%2==0){ echo"mpleft"; } else{ echo"mpright"; } ?>"><?php */?>
      <div  class="categories">
		<div class="maintitle"><b><?php echo $row_cat['finishes_cat_name'];?></b></div>
		<div class="maincont">Manage <?php echo $row_cat['finishes_cat_name'];?><br /><br />
			<a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $row_cat['finishes_cat_id'];?>" class="brown">Click Here</a>
		</div>
	</div>
  </li>
	<?php 
	if($j%2!=0){
		?><div class="spacer20"></div>
        <?php
	}
	$j++;
}
?>
</ul>
<?php
}
?>
<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
<script>
$(function(){
	$("#mysorter").sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
		$.post("ajax/finishes_categories_sort.php", order, function(theResponse){
			//$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
		}); 															 
	}								  
	});
});
</script>