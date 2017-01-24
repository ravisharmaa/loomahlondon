<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
 error_reporting(0);
 $myroot="../";
include_once($myroot."config/config.php");
$colourways_image_id=$_REQUEST['id'];

if(isset($_POST['submitted']) and $_POST['submitted']=="Submit")
{
 $update=$pro->UpdateColourwaysImages($colourways_image_id);
 $product_id=$_POST['product_id'];
 ?>
    <script src="fancybox/js/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script src="fancybox/js/jquery.fancybox.js" type="text/javascript"></script>
    <script>
	$(function(){
		parent.$.fancybox.close();
	});
	</script>
    
	<?php
	
}
 $row_colourways_img=$pro->getSingleColourwaysImage($colourways_image_id);
 ?>  
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
.myform {
    border-left: 1px solid #eee;
    border-top: 1px solid #eee;
}
.info {
    background: #dce3ff url("../images/info.gif") no-repeat scroll 5px 8px;
    border: 1px solid #a3b3ee;
    color: #333;
    font: bold 15px/17px Arial,Helvetica,sans-serif;
    margin: 10px 0;
    padding: 8px 10px 8px 28px;
}

.myform .formleft {
    border-bottom: 1px solid #eee;
    border-right: 1px solid #eee;
    color: #000;
    font: 16px/40px Arial,Helvetica,sans-serif;
    height: 40px;
    padding: 0 10px;
    text-align: right;
    vertical-align: top;
    width: 220px;
}
.myform .formright {
    border-bottom: 1px solid #eee;
    border-right: 1px solid #eee;
    color: #000;
    font: 16px/25px Arial,Helvetica,sans-serif;
    padding: 8px 10px;
    width: 205px;
}
.mybtn {
    background: #3a3a3a none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    cursor: pointer;
    font: 16px Arial,Helvetica,sans-serif;
    padding: 6px 20px;
    text-decoration: none;
}
.mytextbox {
    border: 1px solid #eee;
    font: 16px/22px Arial,Helvetica,sans-serif;
    padding: 3px 5px;
    width: 670px;
}
.fancybox-skin {
    background: #fff none repeat scroll 0 0;
	}
	.container {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #c2beb1;
    margin: 10px auto;
    min-height: 350px;
    padding: 5px;
 
}


	  </style> 
      <div class="container" style="margin:0;">

    <div class="clearboth"></div>
    <div class="info"> 
        Provide the colourways title and the images that you wish to update.
    </div>

 <div class="spacer10"></div>
 <form method="post" action="" enctype="multipart/form-data" name="available_handle">
<table border="0" class="myform">

  <tr>
         <td class="formleft">Colourways title</td>
        <td class="formright"><input type="text" name="colourways_img_name" class="mytextbox" value="<?php echo $row_colourways_img['colourways_img_name']; ?>"/></td>
  </tr>
  <?php if(!empty($row_colourways_img['colourways_image_sm']))
  {
	  ?>
	     <tr>
         <td class="formleft">Thumbnail Image</td>
        <td class="formright">
        	<div style="border:#DDD 1px solid;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:150px">
            	<img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_colourways_img['colourways_image_sm']; ?>" width="150" border="0" />
            </div>
        </td>
  </tr>
  <?php
  }
  ?>
    <tr>
      
        <td class="formleft"> Replace thumbnail image</td>
		<td class="formright">
		<input type="file" name="theimageth" size="25">
                  	<b>
                    <br />Provided image will appear as a thumbnail in the product detail page below the main image.
                    <br />The dimensions of the image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. 
                    <br />If it is different than this then it will appear incorrectly.
                    <br />Uploading the new image will replace the existing above one.
                                
                   
                                </b>
</td>
</tr>
  <?php if(!empty($row_colourways_img['colourways_image_md']))
  {
	  ?>
	     <tr>
         <td class="formleft">Large Image</td>
        <td class="formright">
        	<div style="border:#DDD 1px solid;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:200px">
        		<img src="<?php echo SITE_URL.ALTERNATIVE_IMG_MD.$row_colourways_img['colourways_image_md']; ?>" width="200px" border="0" />
            </div>
        </td>
  </tr>
  <?php
  }
  ?>
<tr>
<td  class="formleft">Replace large image</td>
<td class="formright">
<input type="file" name="theimagemd" size="25">
			<b>
          		  <br />Provided image will appear in the product detail page.
          		  <br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width and height may vary with maximum height of <?php echo PRO_IMG_H;?> px.
              	  <br />If it is different than this then it will appear incorrectly.
          	     <br />Uploading the new image will replace the existing above one.
            </b>
</td>
</tr>

         <input type="hidden" name="imagetype" value="2" />
        <input type="hidden" name="colourways_image_id" value="<?php echo $_REQUEST['id']; ?>" />
       <input type="hidden" name="product_id" value="<?php echo $row_colourways_img['product_id']; ?>"/></td>
       <tr>
         <td class="formleft">&nbsp;</td> 
          <td class="formright">  <input type="submit"  value="Save" class="mybtn" />
          <input type="hidden" name="submitted"  value="Submit"  /></td>
          </tr>
 </table>
 </form> 
</div>