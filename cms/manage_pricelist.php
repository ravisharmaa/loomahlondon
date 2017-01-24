<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
/*
error_reporting(E_ALL);
//$del=$_REQUEST["del"];
//$success=$_REQUEST["success"];
$plid=2;

if(isset($_POST['action_submit']) and $_POST['action_submit']==1){
	 function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
		}

     $filename = stripslashes($_FILES["thepdf"]["name"]);
	 $extension = getExtension($filename);
     $extension = strtolower($extension);
	  if ( $extension != "pdf"){
		 
		 echo '<script>alert("Invalid file type")</script>';
		
		
	     }else{
		 
		  $doc_name=$_FILES["thepdf"]["name"];
		  $doc_path=$_FILES["thepdf"]["tmp_name"];
		  if($doc_name!=""){
		  copy($doc_path, "../pdf/". basename($_FILES["thepdf"]["name"]));
		   echo '<script>alert("Trade pricelist has been uploaded sucessfully.")</script>';
		  
            }
			
	    }
}
*/
?>


<h1>Price Lists</h1>
<div class="clearboth"></div>
<div class="breadcrumb" style="border-bottom:none;"> <a href="login.php">Dashboard</a> &raquo; Price Lists</div>

<?php /*?><a href="download.php?plid=<?php echo $plid;?>" class="dashboard_btn">Download Price List as CSV</a>

<a href="upload.php?plid=<?php echo $plid;?>" class="dashboard_btn upload fancybox.ajax" >Upload Price List as CSV</a>
 	<script>
	$(function(){
		$('.upload').fancybox();
	});
	</script>
	<script>
$(document).ready(function() {
$('.pdf_upload').click(function(){
	if($('.uploader').css('display')=='none'){
		$('.uploader').slideDown();
	}
	else{
		$('.uploader').slideUp();
	}
});
});
</script>
	<?php */?>  

<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid #eee;
    border-collapse: collapse;
	
	
}
th, td {
    padding: 5px;
    text-align: left;
	
}
</style>
<script>
$(document).ready(function () {
	//$('.hide_on_start').hide();
	//$('.edit_price_listsss').click(function(){
		//$('.show_on_start').hide();
		//$('.hide_on_start').show();
	//})
});
</script>

<?php
$parent_cats=$cat->showAllCategories(0);
$i=0;
$sn=0;
if(count($parent_cats));
{
	?>
    <div class="show_on_start" style="display:none;">
        <div class="myadd">
            <a class="edit_price_list" href="javascript:void(0);">Edit Pricelist</a>
        </div>
        <div class="clearboth"></div>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" id="data">
        <tr>
        <?php /*?><td width="5%" class="title"><b>S.No. </b></td><?php */?>
        <td width="45%" class="title"><b>PRODUCTS</b></td>
        
        <td width="15%" class="title"><b>Price Per Metre</b></td>
        <td width="15%" class="title"><b>Sample Price </b></td>
       <?php /*?> <td width="15%" class="title"><b>Delivery Price </b></td>
        
        <td width="10%" class="title" style="text-align:center;"><b>Action </b></td><?php */?>
        </tr>
        <?php
        foreach($parent_cats as $parent_cat)
        {
            
        ?>
          <tr>
           <td colspan="5" class="title" style="text-align:center;"><b><h3><?php echo stripslashes($parent_cat['cat_name']);?></h3></b></td>
         </tr>
        
         <?php
         $cat_id=$parent_cat['cat_id'];
         $row_cats=$cat->showAllCategories($cat_id);
         if(count($row_cats));
        {
            foreach($row_cats as $row_cat)
            {
				
                 ?><tr>
                 <td colspan="5" class="title"><b><?php echo stripslashes($row_cat['cat_name']);?></b></td>
                </tr><?php
            
               $row_products=$pro->showProducts($row_cat['cat_id']);
               if(count($row_products))
               {
                   foreach($row_products as $row_product)
                   {
					   //$sn++;
                       if(!empty($row_product['product_name']))
                       {
                           $row_prices=$pro->getaProductPrice($row_product['product_id']);
                           if($row_product['multi_dimension']==1)
                           {
                               $getmultidimensions=$pro->getMultidimensions($row_product['product_id']);
                               if(count($getmultidimensions))
                               {
                                   foreach($getmultidimensions as $getmultidimension)
                                   {
                                    ?>
                                    <tr>
                                    	<?php /*?><td width="5%" class="title"><?php echo $sn; ?></td><?php */?>
                                        <td width="30%" class="title"><?php echo stripslashes($row_product['product_name']).' ('.$getmultidimension['dimension']; ?>)</td>
                                        <td class="title"><?php echo CURRENCY_SIGN; ?> <?php echo $getmultidimension['price']; ?></td>
                                        <td class="title"><?php echo CURRENCY_SIGN.' '.$row_prices['sample_price']; ?></td>
                                          <?php /*?><td class="title"> <?php echo CURRENCY_SIGN; ?> <?php echo $getmultidimension['delivery_price']; ?></td>
                                      <td class="title" style="text-align:center;"><a href="" style="text-align:center;"> Edit</a></td><?php */?>
                                    </tr>
                                   <?php
                                   }
                                }
                           }
                           else
                           {
                               ?>
                                <tr>
                                <?php /*?><td width="5%" class="title"><?php echo $sn; ?></td><?php */?>
                                <td class="title"><?php echo stripslashes($row_product['product_name']);?></td>
                                <td class="title"><?php echo CURRENCY_SIGN.' '.$row_prices['price_per_meter']; ?></td>
                                <td class="title"><?php echo CURRENCY_SIGN.' '.$row_prices['sample_price']; ?></td>
                                <?php /*?> <td class="title"><?php echo CURRENCY_SIGN.' '.$row_prices['delivery_price']; ?></td>
                               <td class="title" style="text-align:center;"><a href="" style="text-align:center;"> Edit</a></td><?php */?>
                            </tr>
                               <?php
                           }
                       }
                   }
               }
               ?>
               <tr>
               <td class="title" colspan="4">&nbsp;</td>
               </tr>
               
               <?php
             
            }
        }
        ?>
        
        <?php $i++;}?>
        </table>
    </div>
    
    <div class="hide_on_start">
    <div class="clearboth"></div>
    <form id="save_pricelist">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" id="data">
      <tr>
      <td class="tittle" colspan="4" style="border:0px;">
            <input type="button" value="Save" class="mybtn pricelist_save" style="float:right" />
              <div class="saving_detail" style="float:right">Saving...</div>
              <div class="saved_detail" style="float:right">Successfully Saved.</div>
     </td>

        
      
        <tr>
        
        <td width="45%" class="title"><b>PRODUCTS</b></td>
        <td width="15%" class="title"><b>Price Per Unit</b></td>
        <td width="15%" class="title"><b>Sample Price </b></td>
     <?php /*?><td width="15%" class="title"><b>Delivery Price </b></td>
        
        <td width="10%" class="title" style="text-align:center;"><b>Action </b></td><?php */?>
        </tr>
        <?php
        foreach($parent_cats as $parent_cat)
        {
            
        ?>
          <tr>
           <td colspan="4" class="title" ><b><h3><?php echo stripslashes($parent_cat['cat_name']);?></h3></b></td>
         </tr>
         <?php
         $cat_id=$parent_cat['cat_id'];
         $row_cats=$cat->showAllCategories($cat_id);
         if(count($row_cats));
        {
            foreach($row_cats as $row_cat)
            {
                 ?>
                 <tr>
                	 <td colspan="4" class="title"><b><?php echo stripslashes($row_cat['cat_name']);?></b></td>
                </tr>
				<?php
               $row_products=$pro->showProducts($row_cat['cat_id']);
			  
               if(count($row_products))
               {
                   foreach($row_products as $row_product)
                   { 
				       $sn++;
                       if(!empty($row_product['product_name']))
                       {
                           $row_prices=$pro->getaProductPrice($row_product['product_id']);
                           if($row_product['multi_dimension']==1)
                           {
                               $getmultidimensions=$pro->getMultidimensions($row_product['product_id']);
                               if(count($getmultidimensions))
                               {
								  
                                   foreach($getmultidimensions as $getmultidimension)
                                   {
									  
                                    ?>
                                    <tr>
                                        <td class="title"><?php echo stripslashes($row_product['product_name']).' ('.$getmultidimension['dimension']; ?>)</td>
                                        <td class="title"><?php echo CURRENCY_SIGN; ?> <input type="text" style="width:70px;"  name="price[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['price']; ?>"  /> <?php if(!empty($row_product['sold_by'])){ ?>(per <?php echo $row_product['sold_by'];?>)<?php } ?></td>
                                        <td class="title">&nbsp;</td>
                                        
                                       <?php /*?> <td class="title"> <?php echo CURRENCY_SIGN; ?> <input type="text" style="width:100px;" name="delivery_price[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['delivery_price']; ?>" /></td>
                                        <td class="title" style="text-align:center;"><a href="" style="text-align:center;"> Edit</a></td><?php */?>
                                     <input type="hidden" name="dimension_id" value="<?php echo $getmultidimension['dimension_id']; ?>">
                                    </tr>
                                  
                                   <?php
                                   }
                                }
                           }
						   
						   else
                           {
							   
                               ?>
                                <tr>
								 <input type="hidden" name="product_id" value="<?php echo $row_product['product_id']; ?>">
                                
                                <td class="title"><?php echo stripslashes($row_product['product_name']);?></td>
                                <td class="title"><?php echo CURRENCY_SIGN; ?> <input type="text" style="width:70px;" name="price_per_meter[<?php echo $row_product['product_id']; ?>]" value="<?php echo $row_prices['price_per_meter']; ?>" /> <?php if(!empty($row_product['sold_by'])){ ?>(per <?php echo $row_product['sold_by'];?>)<?php } ?></td>
                                <td class="title"><?php echo CURRENCY_SIGN; ?> <input type="text" style="width:100px;"  name="sample_price[<?php echo $row_product['product_id']; ?>]" value="<?php echo $row_prices['sample_price']; ?>" /></td>
                            
                               <?php /*?> <td class="title"><?php echo CURRENCY_SIGN; ?> <input type="text" style="width:100px;"  name="delivery_price[<?php echo $row_product['product_id']; ?>]" value="<?php echo $row_prices['delivery_price']; ?>" /></td><?php */?>
                                 
                             
                            </tr>
                             
                               <?php
							   
                           }
                         
                       }
                   }
               }
               ?>
               <tr>
               <td class="title" colspan="4">&nbsp;</td>
               </tr>
               
               
               <?php
             
            }
        }
        ?>
        <?php $i++;}?>
         <tr>
             <td class="title" colspan="4">
              <input type="button" value="Save" class="mybtn pricelist_save" style="float:right" />
              <div class="saving_detail" style="float:right">Saving...</div>
              <div class="saved_detail" style="float:right">Successfully Saved.</div>
             </td>
        </tr>
        </table>
        </form>
    </div>
	<?php
}
?>
<script>
	$(function(){
		$('.pricelist_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving_detail').show();
			$.ajax({
				url: 'ajax/price_list_save.php',
				type: 'post',
				data: $('#save_pricelist').serialize(),
				success: function(){
					$('.saving_detail').fadeOut(function(){
						//$('.saved').show().delay(1000).hide(function(){
							t.show();	
						//});	
					});
					alertify.success('Successfully Saved.');
					//window.location = "login.php?p_id=manage_pricelist";
				}
			})
		});
	});
	</script>