<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
 error_reporting(0);
 $cat_id=$_REQUEST['cat_id'];
?>
<?php
if(isset($_POST['change_name'])and $_POST['change_name']=='Save'){
	$category_id=$_POST['cat_id'];
	$new_category_name=$_POST['finishes_category'];
	$finishes->updateCategoryName($new_category_name,$category_id);
	 echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&cat_id=".$category_id."'</script>";
	
	
}
if(isset($_POST['submitted']) and $_POST['submitted']=="Save")
{
  
  $product=$finishes->addProducts();
 // echo "Processing...";
  echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&cat_id=".$cat_id."&id=".$product."'</script>";
}
if(isset($_POST['action_update']) and $_POST['action_update']=='Save')
{
	$fin_id=$_REQUEST['id'];
	$cats_id=$finishes->getaProduct($fin_id);
	$fin_cat_id=$cats_id['cat_id'];
	$finishes->updateProducts();
	echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&cat_id=".$fin_cat_id."'</script>";
}
?>
<script language="javascript">
function form_validation(){
if(document.formadd.product_name.value==""){
alert("Please enter the product name")
document.formadd.product_name.focus();
return false;
}




}

function edit_form_validation(){

if(document.editform.finishes_category.value==""){
alert("Please enter the new name")
document.editform.finishes_category.focus();
return false;
}

}
</script>
<script language="JavaScript" type="text/javascript">
if (!document.getElementById)
{
if (document.all)
{
document.getElementById = function(p_id) { return document.all[p_id]; };
}
}


function hideElement()
{

for (var i = arguments.length - 1; i >= 0; --i)
{
if (document.getElementById(arguments[i]).className != "hideElement")
{
document.getElementById(arguments[i]).className = "hideElement";
}
}
}

function showElement()
{

for (var i = arguments.length - 1; i >= 0; --i)
{
if (document.getElementById(arguments[i]).className != "showElement")
{
document.getElementById(arguments[i]).className = "showElement";
//document.cclform.rdodonate[0].checked = false;
//document.cclform.rdodonate[1].checked = false;
}
}
}
</script>
<style>
.showElement { display: default;}
.hideElement { display: none;}
.showElement1 { display: default;}
.hideElement1 { display: none;}
</style>

<!--/*################################################################################STAGE ONE ########################################################################-->
<!--/*################################################################################STAGE ONE ########################################################################-->
<!--/*################################################################################STAGE ONE ########################################################################-->
<?php
if(isset($_REQUEST['act']))
{
	switch($_REQUEST['act'])
	{
		case "add":
		$row_cats=$finishes->getEachFinishesCategory($cat_id);
?>

<h1><?php echo $row_cats['finishes_cat_name']; ?></h1>
<h1 class="goback"><a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $cat_id; ?>">Back to <?php echo strtolower($row_cats['finishes_cat_name']); ?></a></h1>
<div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes">Finishes</a> &raquo; <?php echo $row_cats['finishes_cat_name']; ?> &raquo; Add new finish</div>
<div class="info">Provide the product information that you wish to add.</div>
<form name="formadd" action="" method="post" enctype="multipart/form-data" onsubmit="return form_validation();">
<table border="0" class="myform">
<tr>
    <td colspan="2" class="formright"><b>Add new finish</b></td>
</tr>
<tr>
    <td class="formleft">Title</td>
    <td class="formright"><input type="text" name="product_name"  class="mytextbox"   /></td>
</tr>
<tr>
    <td class="formleft">Description</td>
    <td class="formright"><textarea class="myeditor"  name="product_desc"></textarea></td>
</tr>
                <tr>
                <td colspan="2" class="formright"><b>Image</b></td>
                </tr>
                         <tr>
                            <td class="formleft">Thumbnail:</td>
                            <td class="formright">
                                <input type="file" name="theimagemd" />
                            	
                                <b>
                                <br /><br />The uploaded thumbnail image will appear on the finish category index page.
								<br /><br />
                                The dimensions of this image should be <?php echo FIN_IMG_MD_W;?> px in width and <?php echo FIN_IMG_MD_H;?> px in height.
                                <br />Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                </b>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="formleft">Large:</td>
                            <td class="formright">
                                <input type="file" name="theimagelg" />
                            	<b>
                                
                                <br /><br />
                                These also used for the enlarged image when clicked.
                                <br /><br />
                                The dimensions of the image should be <?php echo FIN_IMG_LG_W;?> px in width and <?php echo FIN_IMG_LG_H;?> px in height.
								<br />Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                
                                <br /><br />Whilst these dimensions may be large, the reason we do this is to make allowances for high definition (retina) display.
                                
                                </b>
                            </td>
                        </tr>
<?php /*?><tr>
    <td class="formleft">Main Image</td>
    <td class="formright">
 
    
    
  You can either upload a single image and let the system create the required thumbnails or you can upload the images separtely.
<br><br>

<input type="radio" name="imagetype" value="1" checked onClick="showElement('singleimage');hideElement('multiimage');"> Upload Single Image
&nbsp;&nbsp;&nbsp;
<input type="radio" name="imagetype" value="2" onClick="showElement('multiimage');hideElement('singleimage');"> Upload Separate Images

<div class="spacer20"></div>


<div id="singleimage" class="showElement">

<input type="file" name="theimage" size="38"><br>
<span class="cnotes">image size: <?php echo FIN_IMG_LG_W;?>px * <?php echo FIN_IMG_LG_H;?>px</span>

</div>


<div id="multiimage" class="hideElement">

<table>
<tr>
<td valign="top" style="padding-right: 10px;">Thumbnail:</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimageth" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_TH_W;?>px * <?php echo FIN_IMG_TH_H;?>px</span>
</td>
</tr>
<tr>
<td valign="top" style="padding-right: 10px;">Medium:</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimagemd" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_MD_W;?>px * <?php echo FIN_IMG_MD_H;?>px</span>
</td>
</tr>
<tr>
<td valign="top" style="padding-right: 10px;">Large</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimagelg" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_LG_W;?>px * <?php echo FIN_IMG_LG_H;?>px</span>
</td>
</tr>
</table>

</div>
 </td>
</tr><?php */?>

<tr>
    <td class="formleft">&nbsp;</td>
    <td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /> &nbsp; &nbsp;
    
    </td>
</tr>
</table>
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo stripslashes($_REQUEST['cat_id']); ?>" />
</form>

<!--/*################################################################################STAGE EDIT ########################################################################--><!--/*################################################################################STAGE EDIT ########################################################################-->
<!--/*################################################################################STAGE EDIT ########################################################################-->
<?php
break;
case "edit":
	 $product_id=$_REQUEST['id'];
	 $detail_products=$finishes->getaProduct($product_id);
	 $cat_id=$detail_products['cat_id'];
	 $row_cats=$finishes->getEachFinishesCategory($cat_id);

 ?>

 
 <h1><?php echo stripslashes($detail_products['product_name']); ?></h1>
 <h1 class="goback"><a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $cat_id;?>">Back to <?php echo strtolower($row_cats['finishes_cat_name']); ?></a></h1>
<div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes">Finishes</a> &raquo; <a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $cat_id;?>"><?php echo $row_cats['finishes_cat_name']; ?></a> &raquo; <?php echo stripslashes($detail_products['product_name']); ?> </div>

<div class="info">Please overwrite the contents below to edit.</div>
<!--##################################################################################################################################################-->
<form name="formadd" action="" method="post" enctype="multipart/form-data" onsubmit="return form_validation();">
<table border="0" class="myform">

<tr>
    <td class="formleft">Title</td>
    <td class="formright"><input type="text" name="product_name" value="<?php echo stripslashes($detail_products["product_name"]);?>" class="mytextbox"  /></td>
</tr>
<tr>
<tr>
    <td class="formleft">Description</td>
    <td class="formright"><textarea class="myeditor"  name="product_desc"><?php echo stripslashes($detail_products["product_desc"]);?></textarea></td>
</tr>
<td colspan="2" class="formright"><b>Image</b></td>
</tr>
  <?php
					if(!empty($detail_products['main_image_md']))
                    {
						?>
                        <tr>
                            <td class="formleft">Thumbnail image</td>
                            <td class="formright">
                                <img src="<?php echo SITE_URL.FINISHES_IMG_MD.$detail_products['main_image_md']; ?>" width="200" border="0" />
                            </td>
                        </tr>
                    	<tr>
                            <td class="formleft">Upload image</td>
                            <td class="formright">
                                <input type="file" name="theimagemd" />
                            	
                                
                                <b>
                                <br /><br />The uploaded thumbnail image will appear on the finish category index page.
								<br /><br />
                                The dimensions of this image should be <?php echo FIN_IMG_MD_W;?> px in width and <?php echo FIN_IMG_MD_H;?> px in height.
                                <br />
                                Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                <br /><br />                          
                                If you decide to upload a new image, it will replace the existing one.
                                </b>
                            </td>
                        </tr>
                    	<?php
					}
					else
					{
						?>
                        <tr>
                            <td class="formleft">Thumbnail image</td>
                            <td class="formright">
                                <input type="file" name="theimagemd" />
                            	<b>
                                <br /><br />The uploaded thumbnail image will appear on the finish category index page.
								<br /><br />
                                The dimensions of this image should be <?php echo FIN_IMG_MD_W;?> px in width and <?php echo FIN_IMG_MD_H;?> px in height.
                                <br />Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                </b>
                            </td>
                        </tr>
                    	<?php
					}
if(!empty($detail_products['main_image_lg']))
                    {
						?>
                        <tr>
                            <td class="formleft">Large image</td>
                            <td class="formright">
                                <img src="<?php echo SITE_URL.FINISHES_IMG_LG.$detail_products['main_image_lg']; ?>" width="200" border="0" />
                            </td>
                        </tr>
                    	<tr>
                            <td class="formleft">Upload image</td>
                            <td class="formright">
                                <input type="file" name="theimagelg" />
                            	<b>
                                <br /><br />
                                These also used for the enlarged image when clicked.
                                <br /><br />
                                The dimensions of the image should be <?php echo FIN_IMG_LG_W;?> px in width and <?php echo FIN_IMG_LG_H;?> px in height.
								<br />Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                <br /><br />                          
                                If you decide to upload a new image, it will replace the existing one.
                                <br /><br />Whilst these dimensions may be large, the reason we do this is to make allowances for high definition (retina) display.
                                
                                </b>
                            </td>
                        </tr>
                    	<?php
					}
					else
					{
						?>
                        <tr>
                            <td class="formleft">Large image</td>
                            <td class="formright">
                                <input type="file" name="theimagelg" />
                            	<b>
                                <br /><br />
                                These also used for the enlarged image when clicked.
                                <br /><br />
                                The dimensions of the image should be <?php echo FIN_IMG_LG_W;?> px in width and <?php echo FIN_IMG_LG_H;?> px in height.
								<br />Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                                
                                <br /><br />Whilst these dimensions may be large, the reason we do this is to make allowances for high definition (retina) display.
                                
                                </b>
                            </td>
                        </tr>
                    	<?php
					}
?>


<?php /*?>
<tr>
    <td class="formleft">Main Image</td>
    <td class="formright">
     <img src="<?php echo SITE_URL.FINISHES_IMG_MD.$detail_products['main_image_md']; ?>" width="200" height="200" border="0" /><br /><br />
  You can either upload a single image and let the system create the required thumbnails or you can upload the images separtely.
<br><br>
<input type="radio" name="imagetype" value="1" checked onClick="showElement('singleimage');hideElement('multiimage');"> Upload Single Image
&nbsp;&nbsp;&nbsp;
<input type="radio" name="imagetype" value="2" onClick="showElement('multiimage');hideElement('singleimage');"> Upload Separate Images
<div class="spacer20"></div>
<div id="singleimage" class="showElement">

<input type="file" name="theimage" size="38"><br>
<span class="cnotes">image size: <?php echo FIN_IMG_LG_W;?>px * <?php echo FIN_IMG_LG_H;?>px</span>

</div>


<div id="multiimage" class="hideElement">

<table>
<tr>
<td valign="top" style="padding-right: 10px;">Thumbnail:</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimageth" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_TH_W;?>px * <?php echo FIN_IMG_TH_H;?>px</span>
</td>
</tr>
<tr>
<td valign="top" style="padding-right: 10px;">Medium:</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimagemd" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_MD_W;?>px * <?php echo FIN_IMG_MD_H;?>px</span>
</td>
</tr>
<tr>
<td valign="top" style="padding-right: 10px;">Large</td>
<td valign="top" style="padding-bottom: 10px;">
<input type="file" name="theimagelg" size="25">
<br>
<span class="cnotes">image size: <?php echo FIN_IMG_LG_W;?>px * <?php echo FIN_IMG_LG_H;?>px</span>
</td>
</tr>
</table>
</div>
 </td>
</tr>
<?php */?>
<tr>
    <td class="formright" colspan="2"><b>If you wish to change the category of this finish, please select the category.</b>
   	 <select name="fin_category" id="fin_category" class="myselectbox">
     <?php
	 $row_cats=$finishes->getCategories();
	 foreach($row_cats as $row_fin_cat)
	{
		$finish_cat_id=$row_fin_cat["finishes_cat_id"];
		$current_fin_cat=$finishes->getaProduct($product_id);
		$idoffin_cat=$current_fin_cat['cat_id'];
	 ?>
    	<option value="<?php echo $finish_cat_id;?>" <?php if($idoffin_cat==$finish_cat_id){?> selected="selected" <?php } ?>>
		  <?php echo $row_fin_cat["finishes_cat_name"];?>
        </option>
        <?php
	}
	?>
       </select>
    </td>
 </tr>
<tr>
    <td class="formleft">&nbsp;</td>
    
    <td class="formright"><input type="submit" name="action_update" value="Save" class="mybtn" /> &nbsp; &nbsp;
   
    </td>
</tr>
</table>
<input type="hidden" name="product_id" id="product_id" value="<?php echo stripslashes($_REQUEST['id']); ?>" />
</form>
 <?php
    break;
	case "del":
	$cat_id=$_REQUEST['cat_id'];
    $id=$_REQUEST['id'];
	$product=$finishes->delProducts($id);
	$delall=$finishes->getFinishesProductsFromRelation($id);
	if(count($delall)){
		foreach($delall as $deleach){
			$pro_id=$deleach['product_id'];
			$finishes->delProductFinishesInRelationTable($pro_id,$id);
		}
	}
	echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&cat_id=".$cat_id."'</script>";
    break;
	case "del_alt_img":
    $alt_id=$_REQUEST['alt_id'];
	$id=$_REQUEST['id'];
	$product=$finishes->delAltImage($alt_id);
	echo "<script language='javascript'>document.location='login.php?p_id=manage_finishes_products&act=edit&id=".$id."'</script>";
    break;
	}
}
else
{
     $row_products=$finishes->getProducts($cat_id);
	 $row_cats=$finishes->getEachFinishesCategory($cat_id);
	 $count=count($row_products);

			 ?> 
		  <h1><?php echo $row_cats['finishes_cat_name']; ?></h1>
          <h1 class="goback"><a href="login.php?p_id=manage_finishes">Back to finishes</a></h1>
          <div class="clearboth"></div>
		  <div class="breadcrumb">You are here: <a href="login.php" >Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes" >Finishes</a> &raquo; <?php echo $row_cats['finishes_cat_name']; ?></div>
		  
          <div class="info">If you want to update the category name, please overwrite the name below and click the "Save" button.</div>
          
           <div id="product_img_block" style="padding:20px 20px 20px 20px;">
           
           <form action=""  name="editform" onsubmit="return edit_form_validation();" method="post">
           <table>
           <tr>
           <td style="padding-right: 20px;"><b>Category name:</b></td>
           <td><input type="text" name="finishes_category" value="<?php echo $row_cats['finishes_cat_name']; ?>" class="mytextbox" style="width:500px;"></td>
           <td style="padding-left:40px;">
           <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
           <input type="submit" name="change_name" value="Save" class="mybtn"></td>
           </tr>
           </table>
           </form>
          
           
          </div>
         
          
                      <style>
						.tab_1{
							margin: 10px 0 0 0;
						}
						.toggle{
							display: block;
							background: url(images/tgdown.png) no-repeat right #747d7d ;
							padding: 10px 20px;
							font: bold 16px Arial, Helvetica, sans-serif;
							color: #FFF;
							text-decoration: none;
						}
						.toggle:hover{
							background: url(images/tgup.png) no-repeat right #E30B5D !important;
						}
						</style> 
						<script>
						$(function(){
							$('a.toggle').click(function(){
								var t=$(this);
								var id=$(this).prop('rel');
								if($('#'+id).css('display')=="none"){
									$('.tabblock').each(function(){
										if($(this).css('display')=="block"){
											$(this).slideUp();
											$('.toggle').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
										}
									});
									$('#'+id).slideDown();
									t.css({'background':'url(images/tgup.png) no-repeat right #E30B5D'});
								}
								else{
									$('#'+id).slideUp();
									t.css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
								}
							});	   
						});
						</script>
                                 <?php
		  	  if($count>0)
		{
			?>

         <?php /*?> <div class="tab_1"><a href="JavaScript:void(0);" rel="finishes_products" class="toggle">CLICK HERE TO MANAGE THE PRODUCTS WITHIN <?php echo strtoupper($row_cats['finishes_cat_name']); ?></a></div><?php */?>
          
          
 
          
          <div id="finishes_products">
           
          
          <div class="info">
                Provided below is the list of finishes within <?php echo $row_cats['finishes_cat_name']; ?>.
                <br /><br />Click the "Add new <?php echo $row_cats['finishes_cat_name']; ?>" button below if you wish to add a finish.
                <br /><br />Click on the image or pencil icon of a finish to manage its detail.
                <br /><br />In the unlikely event that you wish to delete a finish, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
                <br /><br />If you wish to change the order in which finishes are displayed, you can drag and drop a finish to an alternative position.
          </div>
		  
		
        <div class="myadd"> <a href="login.php?p_id=manage_finishes_products&act=add&cat_id=<?php echo $_REQUEST['cat_id'];?>" class="myadd" >Add new <?php echo $row_cats['finishes_cat_name']; ?></a></div>
        <div class="clearboth"></div>
		   <div style="height:10px;"></div>
			  <div id="product_img_block" style="padding:10px 15px 20px 15px;">
					  <ul id='mysorter'>
					  <?php
					  	$sn=0;
					  foreach($row_products as $row_product)
					 {
					?>
						  <li id="recordsArray_<?php echo $row_product['product_id']; ?>" style="margin:0;">
							  <div class='mybb' style="position:relative;">
								  <div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
								    <a href="login.php?p_id=manage_finishes_products&act=edit&id=<?php echo $row_product['product_id']; ?>" title="Edit"><img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="200" border="0" /></a>
									  <p style="line-height:30px;color:#333;"><b><span class="sn"><?php echo ++$sn; ?></span>. <?php echo substr(stripslashes($row_product['product_name']),0,25); ?></b></p>
								  </div>
								  <div class="mybb-btns">
									  <a href="login.php?p_id=manage_finishes_products&act=edit&id=<?php echo $row_product['product_id']; ?>" title="Edit"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a> 
									  <a href="JavaScript:delRecord('login.php?p_id=manage_finishes_products&act=del&cat_id=<?php echo $_REQUEST['cat_id']; ?>&id=<?php echo $row_product['product_id']; ?>','Are you sure that you want to delete this products ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
									  </div>
							   </div>
						  
						  </li>	
					  <?php
					  }
			
					  ?>
				  
					  </ul>
					  <div class="clearboth"></div>
					  </div>
                      </div>
				  <?php
			}
		else
		{
			?>
              <div class="clearboth"></div>
         <div class="myadd" style="padding-top:20px;"> <a href="login.php?p_id=manage_finishes_products&act=add&cat_id=<?php echo $_REQUEST['cat_id'];?>" class="myadd" >Add new <?php echo $row_cats['finishes_cat_name']; ?></a></div>
          <div class="clearboth"></div>
            <div style="padding:10px;">Currently no finishes are available.</div>
            <?php	
		}
   }
		?>

<script>
$(function(){
	$("#mysorter").sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
		$.post("ajax/finishes_products_sort.php", order, function(theResponse){
                            //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                        	var sn=0;
							$('.sn').each(function(){
								$(this).html(++sn);
							});
						}); 															 
	}								  
	});
});
</script>