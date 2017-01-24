<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
ini_set('display_errors', 1);
//error_reporting(E_ALL);
$myroot="../";
include_once($myroot."config/config.php");
if(isset($_REQUEST['id']))
{
	$sale_id=$_REQUEST['id'];
	$row_sale_bs=$pro->showSaleBillingShippingAddress($sale_id);
	$row_sale=$pro->showEachSales($sale_id);
	
?>
<script>
$(function(){
	$('.closeme').click(function(){
		//$.fancybox.close();	
		$(location).attr('href','login.php?p_id=manage_sales');					 
	});
	
	$('.void_order').click(function(){
		var sale_id=$(this).attr('rel');
		var mynote=prompt("You are about to change the order status to VOID.\n\nPlease ensure that you have tallied this order with PayPal.\n\nThis record will not appear in the list after making it void.\n\nYou may enter the reason for voiding this order.");
		if(mynote===null){
			return;	
		}else{
			$.ajax({
				url: 'ajax/void-order.php',
				type: 'post',
				data: { id: sale_id, mynote: mynote },
				success: function(data){
					//$('.closeme').trigger('click');
					$(location).attr('href','login.php?p_id=manage_sales');
				}
			});
		}
	});
	
	$('.dispatch_order').click(function(){
		var sale_id=$(this).attr('rel');
		if(sale_id!=""){
			if(confirm("You are about to change the order status to DISPATCHED.\n\nPlease ensure that you have received payment before dispatching the goods.\n\nPlease note that this customer will be notified of the dispatch by an email.")){
				$('.dispatch_order').html('Please wait...');
				$.ajax({
					url: 'ajax/dispatch-order.php',
					type: 'post',
					data: { id: sale_id, mynote: '' },
					success: function(data){
						//console.log(data);
						$('.change_status').html('Dispatched');
						$('.dispatch_order').html('View Invoice (PDF)').attr('rel','').attr('href',data).attr('target','_blank');
					}
				});
			}
		}
	});
});
</script>
<style>
.give_style{
	vertical-align:top;
	text-align:left;
	padding-left:10px;
	padding-top:10px;
}
</style>

<h3>Order Details</h3><br />
<div class="myshoppingcart">
    <table class="orderlist">
    <tr bgcolor="#CCCCCC">
        <th width="35%"  align="center" style="padding-left:10px;">IMAGE</th>
         <th width="35%"  align="left" style="padding-left:10px;">NAME</th>
        <th width="10%"  align="left" style="padding-left:10px;">QTY</th>
        <th width="10%"  align="left" style="padding-left:10px;">PRICE</th>
        <th width="10%" align="left" style="padding-left:10px;">AMOUNT</th>
    </tr>
    <?php
	$order_type='item_order';
	$subtotal1=0;
	$subtotal2=0;
	$total=0;
	$gst=0;
	$total_order=0;
    $myquery_order=$pro->showAllSaleOrdersWithType($sale_id,$order_type);
	//echo count($myquery_order);
	if(count($myquery_order))
	{
	  
	?>
     <tr>
   		
         <td colspan="6" style="padding-top:10px; border-left:none; border-right:none;">Purchase Order<?php if(count($myquery_order)>1)echo "s"; ?></td>
    </tr>
        <?php
        foreach($myquery_order as $row_order)
        {
        ?>
        <tr>
            
                <?php
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
			    $each_total_order=$row_order['price'] * $row_order['order_qty'];
			
			   
													
			
                    if($colourways_id!=0)
					{
					?>
                    <td align="center" style="border-left:none; width:200px; padding:5px;"><img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$products_colourways['colourways_image_sm']; ?>" width="135" alt=""></td>
                    <td class="give_style"><?php echo stripslashes($row_product['product_name'])." - ".stripslashes($products_colourways['colourways_img_name']); ?>
                    <?php
                if($row_order['small_order_fee']!=0){
				?><br><br>
                Small Order Fee
                <?php
				}
				?></td>
                	<?php
                  	}
                 	 else
                 	 {
                  	?>
                     <td align="center" style="border-left:none; width:200px; padding:5px;"><img src="<?php echo SITE_URL.PRO_IMG_TH.$row_product['product_image_sm']; ?>" width="135" alt=""></td>
                      <td class="give_style"><?php echo stripslashes($row_product['product_name']); ?>
                      <?php
                if($row_order['small_order_fee']!=0){
				?><br><br>
                Small Order Fee
                <?php
				}
				?>
                </td>
                     <?php
					 }
					 ?>
                <?php /*?>  <td align="center"><?php echo $row_product['product_name']." - ".$products_colourways['colourways_img_name']; ?></td>   <img src="../<?php echo ACQUIRE_SMALL_IMG.$acquire_image; ?>" width="200" height="160" /><br /><?php */?>
                
           
          
            <td class="give_style"><?php echo (float)$row_order['order_qty']; ?> (<?php echo stripslashes($row_product['sold_by']) ?>)
            
            
            </td>
             
            <td class="give_style"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$row_order['price']); ?></td>
            <td class="give_style"><?php echo CURRENCY_SIGN; ?> <?php echo $t=sprintf("%0.2f",$row_order['order_qty']*$row_order['price']); ?>
            <?php
            if($row_order['small_order_fee']!=0)
				{
					$small_order_fee=$row_order['small_order_fee'];
					?>
                     <br><br>
					<?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$small_order_fee);?> 
                    <?php

					$subtotal1+= $t+$small_order_fee;
				}
				else
				{
					$subtotal1+=$t;
				}
				?>
           
            </td>
           
        </tr>
        <?php
			
        
		}
				
    }
	
   ?>
  
    <?php
	$order_type_s='sample_order';
	$subtotal=0;
	$total_sample=0;
   //$myquery_order=$pro->showAllSaleOrders($sale_id);
    $myquery_order_s=$pro->showAllSaleOrdersWithType($sale_id,$order_type_s);
	//echo count($myquery_order);
	if(count($myquery_order_s))
	{
	?>
     <tr>
   	
        <td colspan="6" style="padding-top:10px; border-left:none; border-right:none;">Sample Order<?php if(count($myquery_order_s)>1)echo "s"; ?></td>
     </tr>
    <?php
	
        foreach($myquery_order_s as $row_order)
        {
        ?>
        <tr>
            
                <?php
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
			    $each_total_order=$row_order['price'] * $row_order['order_qty'];
			    if($colourways_id!=0)
				{
					?>
                    <td align="center" style="border-left:none; width:200px; padding:5px;"><img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$products_colourways['colourways_image_sm']; ?>" width="135" alt=""></td>
                    <td class="give_style"><?php echo stripslashes($row_product['product_name'])." - ".stripslashes($products_colourways['colourways_img_name']); ?></td>
                	<?php
                  	}
                 	 else
                 	 {
                  	?>
                     <td align="center" style="border-left:none; width:200px; padding:5px;"><img src="<?php echo SITE_URL.PRO_IMG_TH.$row_product['product_image_sm']; ?>" width="135" alt=""></td>
                      <td class="give_style"><?php echo stripslashes($row_product['product_name']); ?></td>
                     <?php
					 }
					 ?>
            <td class="give_style"><?php echo (float)$row_order['order_qty']; ?></td>
            <td class="give_style"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$row_order['price']); ?></td>
            <td class="give_style"><?php echo CURRENCY_SIGN; ?> <?php echo $t=sprintf("%0.2f",$row_order['order_qty']*$row_order['price']); ?></td>
              
        </tr>
        <?php
        $subtotal2+=$t;
		}
		
		
    }

$total_delivery=$row_sale['delivery_amount'];
$gst=$row_sale['tax_amount'];
$total=$subtotal1+$subtotal2+$total_delivery;
?>
    <tr>
        <td colspan="4" align="right" style="border-left:none;">Sub-total:</td>
        <td align="right"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$subtotal1+$subtotal2); ?></td>
        
    </tr>
    <?php
     if(count($myquery_order)>=1)
 {
?>
     <tr>
        <td colspan="4" align="right" style="border-left:none;">Delivery:</td>
        <td align="right"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$total_delivery); ?></td>
      
    </tr>
    <?php
 }
 ?>
     <tr>
        <td colspan="4" align="right" style="border-left:none;">Total:</td>
        <td align="right"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$total); ?></td>
         
    </tr>
    <tr>
        <td colspan="4" align="right" style="border-left:none;">Tax(GST):</td>
        <td align="right"><?php echo CURRENCY_SIGN; ?> <?php echo sprintf("%0.2f",$gst); ?></td>
         
    </tr>
    
     
    </table>
</div>
    
<div class="mybillingshipping">
    <div class="mybilling">
        <h3>Billing Address</h3>
        <table>
        <tr>
            <td width="180">First Name:</td>
            <td><input type="text" id="billing_firstname" name="billing_firstname" size="30" value="<?php echo stripslashes($row_sale_bs['billing_firstname']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input type="text" id="billing_lastname" name="billing_lastname" size="30" value="<?php echo stripslashes($row_sale_bs['billing_lastname']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Address 1:</td>
            <td><input type="text" id="billing_add1" name="billing_add1" size="30" value="<?php echo stripslashes($row_sale_bs['billing_add1']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Address 2:</td>
            <td><input type="text" id="billing_add2" name="billing_add2" size="30" value="<?php echo stripslashes($row_sale_bs['billing_add2']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>City/Town:</td>
            <td><input type="text" id="billing_city" name="billing_city" size="30" value="<?php echo stripslashes($row_sale_bs['billing_city']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>County:</td>
            <td><input type="text" id="billing_county" name="billing_county" size="30" value="<?php echo stripslashes($row_sale_bs['billing_state']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Postcode:</td>
            <td><input type="text" id="billing_postcode" name="billing_postcode" size="30" value="<?php echo stripslashes($row_sale_bs['billing_postcode']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Country:</td>
            <td><input type="text" id="billing_country" name="billing_country" size="30" value="<?php echo stripslashes($row_sale_bs['billing_country']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Telephone:</td>
            <td><input type="text" id="billing_phone" name="billing_phone" size="30" value="<?php echo stripslashes($row_sale_bs['billing_phone']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Email Address:</td>
            <td><input type="text" id="billing_email" name="billing_email" size="30" value="<?php echo stripslashes($row_sale_bs['billing_email']); ?>" disabled /></td>
        </tr>
        </table>
    </div>
    <div class="myshipping">
        <h3>Delivery Address</h3>
        <table>
        <tr>
            <td width="180">First Name:</td>
            <td><input type="text" id="shipping_firstname" name="shipping_firstname" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_firstname']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input type="text" id="shipping_lastname" name="shipping_lastname" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_lastname']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Address 1:</td>
            <td><input type="text" id="shipping_add1" name="shipping_add1" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_add1']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Address 2:</td>
            <td><input type="text" id="shipping_add2" name="shipping_add2" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_add2']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>City/Town:</td>
            <td><input type="text" id="shipping_city" name="shipping_city" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_city']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>County:</td>
            <td><input type="text" id="shipping_county" name="shipping_county" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_state']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Postcode:</td>
            <td><input type="text" id="shipping_postcode" name="shipping_postcode" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_postcode']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Country:</td>
            <td><input type="text" id="shipping_country" name="shipping_country" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_country']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Telephone:</td>
            <td><input type="text" id="shipping_phone" name="shipping_phone" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_phone']); ?>" disabled /></td>
        </tr>
        <tr>
            <td>Email Address:</td>
            <td><input type="text" id="shipping_email" name="shipping_email" size="30" value="<?php echo stripslashes($row_sale_bs['shipping_email']); ?>" disabled /></td>
        </tr>
        </table>
    </div>
    <div class="clearboth"></div>
</div>
<?php
if(!empty($row_sale_bs['billingshipping_comment']))
{
    ?>
    <div class="mybillingshipping">
        <h3>Additional Information / Comment.</h3>
        <div class="mycomment"><?php echo stripslashes($row_sale_bs['billingshipping_comment']); ?></div>
    </div>    
    <?php
}
?>
<div class="mybillingshipping">
    <h3>Purchase Order Details.</h3>
    <div class="mycomment">
    <table>
    <tr>
        <td>Sale Record ID:</td>
        <td><?php echo $sale_id; ?></td>
    </tr>    	
    <tr>
        <td>Order Date:</td>
        <td><?php $o_date = strtotime($row_sale['sale_date']); echo date("j F Y",$o_date); ?></td>
    </tr>    	
    <tr>
        <td>Payment Status:</td>
        <td><?php echo $row_sale['payment_status']==1?"Successfully paid through Paypal":"Pending"; ?></td>
    </tr>
    <?php
    if($row_sale['payment_date']!='0000-00-00 00:00:00')
    {
        ?>
    <tr>
        <td>Payment Date:</td>
        <td><?php $p_date = strtotime($row_sale['payment_date']); echo date("j F Y",$p_date); ?></td>
    </tr>
    <?php
	}
	?>
    <tr>
        <td>Dispatch Status:</td>
        <td  class='change_status'><span><?php echo $row_sale['dispatch_status']==1?"Dispatched":"Pending"; ?></span></td>
    </tr>
    <?php
    if($row_sale['dispatch_status']==1)
    {
        ?>
        <tr>
            <td>Dispatch Date:</td>
            <td><?php $d_date = strtotime($row_sale['dispatch_date']); echo date("j F Y",$d_date); ?></td>
        </tr>
        <tr>
            <td>Dispatch Note:</td>
            <td><?php echo stripslashes($row_sale['dispatch_note']); ?></td>
        </tr>
        <?php
    }
    if($row_sale['cancel_status']==1)
    {
        ?>
        <tr>
            <td>Cancel Status:</td>
            <td>Cancelled</td>
        </tr>
        <tr>
            <td>Cancel Date:</td>
            <td><?php $_date = strtotime($row_sale['cancel_date']); echo date("j F Y",$c_date); ?></td>
        </tr>
        <tr>
            <td>Cancel Note:</td>
            <td><?php echo stripslashes($row_sale['cancel_note']); ?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    </div>
</div> 
<style>
.myadd a {
    background-color: #f2f2f2;
    background-image: -moz-linear-gradient(center top , #fbfbfb 0%, #e8e8e8 90%);
    border: 1px solid #d0d0d0;
    border-radius: 3px;
    color: #000000;
    display: block;
    float: left;
    font-size: 11pt;
    font-weight: bold;
    margin: 0 15px 10px 0;
    padding: 5px 12px;
    text-decoration: none;
    text-shadow: 0 1px 0 #fbfbfb;
}
.myadd a:hover {
    background: #e1e1e1;
	}
</style>
<div class="myadd">
    <?php
    if($row_sale['dispatch_status']==1)
    {
        ?>
        <a href="<?php  echo SITE_URL;?>invoices/<?php echo $row_sale['dispatch_pdf']; ?>" target="_blank">View Invoice (PDF)</a>
        <?php
    }
    else
    {
        ?>
        <a href="JavaScript:void(0);" rel="<?php echo $sale_id; ?>" class="dispatch_order">Dispatch Order</a>
        &nbsp;&nbsp;&nbsp;
        <a href="JavaScript:void(0);" rel="<?php echo $sale_id; ?>" class="void_order">Void this Order</a>
        <?php
    }
    ?>
    &nbsp;&nbsp;&nbsp;
    <a href="JavaScript:void(0);" class="closeme">Back to List</a>
    <div class="clearboth"></div>
</div>
<?php

}
?>