<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$dimension_id=$_REQUEST['id'];
$getmultidimension=$pro->getEachdimensions($dimension_id);
?>
<div class="container" style="margin:0;">
    <h1>Edit Dimension</h1>
    <div class="clearboth"></div>
    
     <div class="info">
      If you wish to edit a dimension, please provide it's price and delivery price below and click the "Save" button
    </div>


    <form id="form_blog_edit" method="post">
    <table border="0" class="myform">
    <tr>
                        <td class="formleft" style="width:440px;">Dimension</td>
                        <td  class="formright"><input style="width:136px;"  id='dimension' type="text" name="dimension" class="mytextbox" value="<?php echo $getmultidimension['dimension']; ?>"  /></td>
                    </tr>
                    <tr>
                        <td class="formleft">Price </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;"  id="price" type="text"  name="price" class="mytextbox" value="<?php echo $getmultidimension['price']; ?>"></td>
                    </tr>
                     <tr>
                        <td class="formleft">1 or 2 (Australia) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price" type="text" name="delivery_price" class="mytextbox" value="<?php echo $getmultidimension['delivery_price']; ?>"/></td>
                    </tr>
                     <tr>
                        <td class="formleft">3 and above (Australia) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price_more_than_three" type="text" name="delivery_price_more_than_three" class="mytextbox" value="<?php echo $getmultidimension['delivery_price_more_than_three']; ?>"/></td>
                    </tr>
                     <tr>
                        <td class="formleft">1 or 2 (New Zealand) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price_nz" type="text" name="delivery_price_nz" class="mytextbox" value="<?php echo $getmultidimension['delivery_price_nz']; ?>"/></td>
                    </tr>
                     <tr>
                        <td class="formleft">3 and above (New Zealand) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price_nz_more_than_three" type="text" name="delivery_price_nz_more_than_three" class="mytextbox" value="<?php echo $getmultidimension['delivery_price_nz_more_than_three']; ?>"/></td>
                    </tr>
					
        
                  <tr>
                      <td class="formleft">&nbsp;</td>
                      <td class="formright"><input type="submit" value="Save" class="mybtn" /></td>
                      <input type="hidden" value="<?php echo $getmultidimension['dimension_id']; ?>" name="dimension_id" />
                        <input type="hidden" name="submitted" value="update_multi_dimension" />
                  </tr>
    </table>

    </form>
    
</div>