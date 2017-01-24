<?php
$myroot="../";
include_once($myroot."config/config.php");
$sale_id=$_REQUEST['id'];
$row_sale_bs=$pro->showSaleBillingShippingAddress($sale_id);
$row_sale=$pro->showEachSales($sale_id);
?>
<style>
body{
font-family:"BrandonGM";
font-size:11px;
}
.pad-left{
padding-left:10px;
text-transform:capitalize;
padding-top:10px;
}
.border{
 border:#000 solid 1px; 
}
.left-text{
font-size:13px;
color:#9a9a9a;
padding-top:10px;
}
.font-colour{
color:#9a9a9a;
}
#table-example-1 { 
   border-collapse: collapse; 
}
#table-example-1 td { 
border: #9A9A9A  thin 1px;
  vertical-align: top; 
  padding: 5px; 
}
#table-example-1 th { 
 border: #9A9A9A  thin 1px;
 
  padding: 5px; 
  vertical-align: middle; 
  text-align: center; 
}
.padding-top{
padding-top:10px;

}

</style>

<table border="0" width="600" style="min-height:800px;" align="center">
<tr>
	<td align="center" style="padding:30px;"><img src="<?php echo SITE_URL; ?>img/nicola-lawrence.png" width="400" /></td>
</tr>
<tr>
	<td align="center" class="invoice" style="color:#c1c1c1; font-size:20px;" >ORDER CONFIRMATION/RECEIPT</td>
</tr>
</table>


<table border="0" width="600" style="min-height:800px;" align="center">


<tr>
	<td>
    <table border="0">
      <tr>
    	<td  align="left" class="left-text">Invoice Number:</td>
        <td align="left"  class="pad-left"><?php /*?> <?php echo rand(9999999,99999999); ?>-<?php */?><?php echo $sale_id; ?></td>
     
    </tr>
    <tr>
    	<td align="left" class="left-text">Date: </td>
        <td  align="left"  class="pad-left"><?php $o_date = strtotime($row_sale['sale_date']); echo date("j F Y",$o_date); ?></td>
    </tr>
 	<tr>
        <td align="left" class="left-text">To:</td>
		<td align="left" class="pad-left"><?php echo stripslashes($row_sale_bs['shipping_firstname']." ".$row_sale_bs['shipping_lastname']); ?>			        </td>
    </tr>
	<tr>
       <td align="left" class="left-text" style=" vertical-align:text-top;">Shipping Details:</td>
       <td align="left" class="pad-left" style="text-transform:capitalize;">
		<?php echo stripslashes($row_sale_bs['shipping_add1']); ?>, 
        <?php
        if(!empty($row_sale_bs['shipping_add2']))
        {
            ?>
          <?php echo stripslashes($row_sale_bs['shipping_add2']); ?>, 
            
            <?php
        }
        ?>
      <?php echo stripslashes($row_sale_bs['shipping_city']); ?>, 
     
        <?php
        if(!empty($row_sale_bs['shipping_state']))
        {
            ?>
           <?php echo stripslashes($row_sale_bs['shipping_state']); ?><br /> 
            
            <?php
        }
        ?>
		 <?php echo stripslashes($row_sale_bs['shipping_country']); ?><br />
          <?php echo stripslashes($row_sale_bs['shipping_phone']); ?><br />
         <span style="text-transform:lowercase;"><?php echo stripslashes($row_sale_bs['shipping_email']); ?></span>
       </td>
       </tr>
   </table>
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

<tr>
	<td>
    	<table id="table-example-1" width="100%">
        <tr>
            <th width="60" align="center" class="font-colour" >QTY</th>
            <th width="280" align="center" class="font-colour" >CODE / DESCRIPTION</th>
            <th width="120" align="center" class="font-colour" >UNIT PRICE (<?php echo CURRENCY_SIGN; ?>)</th>
            <th width="120" align="center" class="font-colour" >TOTAL (<?php echo CURRENCY_SIGN; ?>)</th>
        </tr>
       
        <?php
		$i=0;     
		$order_sum=0;
        $subtotal=0;
	    $total_delivery_charge_order=0;
		$total_delivery_charge_order_less=0;
		$total_delivery_charge_order_more=0;
		$total_delivery_charge_order_less_nz=0;
		$total_delivery_charge_order_more_nz=0;
		$total_delivery_charge_order=array();
		$total_delivery_charge_order_less=array();
		$total_delivery_charge_order_more=array();
		$total_delivery_charge_order_less_nz=array();
		$total_delivery_charge_order_more_nz=array();
        $row_orders=$pro->showAllSaleOrders($sale_id);
		$tot_fabricswallpapers=0;
			$tot_rugs=0;
			$tot_cushionslampshades=0;
		if(count($row_orders))
		{
			
			foreach($row_orders as $row_order)
			{
				$i++;
				$colourways_id=$row_order['cproduct_id'];
				if($colourways_id!=0)
				{
                $products_colourways=$pro->ColourwaysImage($colourways_id);
				$product_id=$products_colourways['product_id'];
				}
				else
				{
				$product_id=$row_order['product_id'];
				}
				$row_product=$pro->showProduct($product_id);
				$cat_id=$row_product['cat_id'];
				$row_category=$cat->showCategory($cat_id);
                $parent_id=$row_category['parent_id'];
				$row_parent=$cat->showCategory($parent_id);
				
				
			    $row_product_price=$pro->getaProductPrice($product_id);
			  
			    $each_total_order=$row_product_price['price_per_meter'] * $row_order['order_qty'];
			    $order_sum+= $each_total_order;
			    //$total_delivery_charge_order+=$row_product_price['delivery_price'];
				
				$dimension_price=$pro->getEachdimensions($row_order['dimension_id']);
				$total_delivery_charge_order_less[]=$dimension_price['delivery_price'];
			  	$total_delivery_charge_order_more[]=$dimension_price['delivery_price_more_than_three'];
			 	$total_delivery_charge_order_less_nz[]=$dimension_price['delivery_price_nz'];
			 	$total_delivery_charge_order_more_nz[]=$dimension_price['delivery_price_nz_more_than_three'];
				
				if($parent_id==3){
					
					if($cat_id==26){
						$tot_rugs+=$row_order['order_qty'];
					}
					else{
						$tot_cushionslampshades+=$row_order['order_qty'];
					}
				}
				else{
						$tot_fabricswallpapers+=count($parent_id);
				}
				?>
				<tr>
                <td align="center" valign="top"  style="border-bottom:none;" ><?php echo (float)$row_order['order_qty']; ?></td>
                <td align="left"  style="border-bottom:none;">
                   <?php
                  if($colourways_id!=0)
					{
					?>
                    <?php /*?>  <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$products_colourways['colourways_image_sm']; ?>" width="135" alt=""><?php */?>
                    <?php if($parent_id!=3){ echo stripslashes($row_parent['cat_name']).' - '; }?><?php echo stripslashes($row_category['cat_name']).' - '.stripslashes($row_product['product_name'])." - ".stripslashes($products_colourways['colourways_img_name']); ?>
                	<?php
                  	}
                 	else
                 	{
                  	?>
                    <?php /*?>  <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_product['product_image_sm']; ?>" width="135" alt=""><?php */?>
                     <?php if($parent_id!=3){ echo stripslashes($row_parent['cat_name']).' - '; }?><?php echo stripslashes($row_category['cat_name']).': '.stripslashes($row_product['product_name']); ?>
                     <?php
					 }
					 ?>
				
                </td>
					<td align="right" valign="top"  style="border-bottom:none;"><?php echo sprintf("%0.2f",$row_order['price']); ?></td>
					<td align="right" valign="top" style="border-bottom:none;" ><?php echo $t=sprintf("%0.2f",$row_order['order_qty']*$row_order['price']); ?></td>
				</tr>
      
			
				<?php
				$subtotal+=$t;
			 }

			 $total_delivery=$row_sale['delivery_amount'];;
			 $total=$subtotal+$total_delivery;
			 $gst=$total/11;
		 
		 }
			
		for($j=1;$j<=20-$i;$j++){
		//echo $j;
			?>
            <tr>
            	<td align="right" valign="top" <?php if($j!=20-$i){?> style="border-bottom:none;"<?php } ?>>&nbsp;</td>
                <td align="right" valign="top" <?php if($j!=20-$i){?> style="border-bottom:none;"<?php } ?>>&nbsp;</td>
                <td align="right" valign="top" <?php if($j!=20-$i){?> style="border-bottom:none;"<?php } ?>>&nbsp;</td>
                <td align="right" valign="top" <?php if($j!=20-$i){?> style="border-bottom:none;"<?php } ?>>&nbsp;</td>
            </tr>
            <?php	
		}
		
		
        ?>
      
   
    <tr  class="border">
       <td colspan="2" style="border-bottom:none; border-left:none;">&nbsp;</td>
        <td align="right"  class="font-colour">Sub-total:</td>
        <td align="right"  class="border"><?php echo sprintf("%0.2f",$subtotal); ?></td>
    </tr>
     <tr>
        <td colspan="2"  style="border-bottom:none; border-left:none;" class="font-colour " >&nbsp;</td>
        <td  align="right" class="border font-colour">Delivery:</td>
        <td align="right"  class="border"><?php echo sprintf("%0.2f",$total_delivery); ?></td>
    </tr>
     <tr>
       
          <td colspan="2" style="border-bottom:none; border-left:none;" class="font-colour" >&nbsp;</td>
        <td  align="right" class="border font-colour">Total:</td>
        <td align="right" ><?php echo sprintf("%0.2f",$total); ?></td>
    </tr>
    <tr>
        <td colspan="2"  style="border-bottom:none; border-left:none;">&nbsp;</td>
        <td  align="right"  class="border font-colour">Tax(GST):</td>
        <td align="right"  class="border"> <?php echo sprintf("%0.2f",$gst); ?></td>
    </tr>
        </table>
	</td>
</tr>  
<tr>
	<td style="text-align:center">&nbsp;</td>
</tr>   

<?php /*?><?php
if(!empty($row_sale_bs['billingshipping_comment']))
{
	?>
	<tr>
        <td><b>Additional Information/Comment:</b></td>
    </tr>
    <tr>
        <td><?php echo stripslashes($row_sale_bs['billingshipping_comment']); ?></td>
    </tr>
    <?php
}
 <?php if($i!=count($row_orders)){ ?>style="border-bottom:none;" <?php } ?>
?><?php */?>
<tr>
	<td>&nbsp;</td>
</tr>
</table>

<page_footer>
<table border="0" width="600" style="min-height:800px;" align="center">
<tr>
	<td style="text-align:center; color:#9a9a9a; ">Email: info@nicolalawrence.com.au <span style="color:#E3158F;">|</span> ABN: 13 584 735 714</td>
</tr> 
<tr>
	<td style="text-align:center">&nbsp;</td>
</tr>     
<tr>
	<td style="text-align:center; color:#E3158F;">N I C O L A L A W R E N C E . C O M . A U</td>
</tr>
</table>
</page_footer>