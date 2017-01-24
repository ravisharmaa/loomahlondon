<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$d_prices=$pro->getDeliveryPrices();
?>
<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid #eee;
    border-collapse: collapse;
	text-align:center;
	
}
th, td {
    padding: 5px;
    text-align: left;
	text-align:center;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}

</style>
<h1>Delivery Charges</h1>
<div class="clearboth"></div>
<div class="breadcrumb"><a href="login.php">Dashboard</a> &raquo; Delivery Charges</div>

<div class="info">
 Please overwrite the delivery charges as you wish.
</div>
<div>
<form id="form_page_price" action="" method="post" enctype="multipart/form-data">
<table>
    <thead>
        <tr>
            <th rowspan="2" style="text-align:left;">Products</th>
            <th colspan="2" style="text-align:center;">Australia</th>
            <th colspan="2" style="text-align:center;">New Zealand</th>
        </tr>
        <tr>
            <th>1 or 2</th>
            <th>3 and above</th>
            <th>1 or 2</th>
            <th>3 and above</th>
        </tr>
    </thead>
    <tbody>
    <?php
	if(count($d_prices))
	{
		foreach($d_prices as $d_price)
		{
			if($d_price['d_id']!=3 and $d_price['d_id']!=4)
			{
		?>
			<tr>
				<td style="text-align:left;"><?php echo stripslashes($d_price['products']); ?></td>
				<td><input type="text" name="delivery_price_aus_less_than_three[<?php echo stripslashes($d_price['d_id']); ?>]" value="<?php echo stripslashes($d_price['delivery_price_aus_less_than_three']); ?>"></td>
				<td><input type="text" name="delivery_price_aus_more_than_three[<?php echo stripslashes($d_price['d_id']); ?>]" value="<?php echo stripslashes($d_price['delivery_price_aus_more_than_three']); ?>"></td>
				<td><input type="text" name="delivery_price_nz_less_than_three[<?php echo stripslashes($d_price['d_id']); ?>]" value="<?php echo stripslashes($d_price['delivery_price_nz_less_than_three']); ?>"></td>
				<td><input type="text" name="delivery_price_nz_more_than_three[<?php echo stripslashes($d_price['d_id']); ?>]" value="<?php echo stripslashes($d_price['delivery_price_nz_more_than_three']); ?>"></td>
			 </tr>
          <input type="hidden" name="d_id" value="<?php echo stripslashes($d_price['d_id']); ?>">
          
			
		 <?php
			}
		}
    }
    ?>
   			 <tr>
				<td colspan="4" style="text-align:left;">Rugs</td>
             </tr>
    
    <?php
	$getmultidimensions=$pro->getAllDimensions();
	if(count($getmultidimensions))
	{
		foreach($getmultidimensions as $getmultidimension)
		{
			$product_id=$getmultidimension['product_id'];
			$pro_name=$pro->showProduct($product_id);
		
			?>
			<tr>
				<td style="text-align:left;"><?php echo stripslashes($pro_name['product_name']);?>-<?php echo $getmultidimension['dimension']; ?></td>
				<td><input type="text" name="delivery_price[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['delivery_price']; ?>" /></td>
				<td><input type="text" name="delivery_price_more_than_three[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['delivery_price_more_than_three']; ?>" /></td>
				<td><input type="text" name="delivery_price_nz[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['delivery_price_nz']; ?>" /></td>
				<td><input type="text" name="delivery_price_nz_more_than_three[<?php echo $getmultidimension['dimension_id']; ?>]" value="<?php echo $getmultidimension['delivery_price_nz_more_than_three']; ?>" /></td>
                <input type="hidden" name="dimension_id" value="<?php echo $getmultidimension['dimension_id']; ?>">
			</tr>
			<?php
		}
	}
	?>
          <tr>
            <th colspan="5" style="text-align:right;">
            <input type="button" value="Save" class="mybtn save_price" />
            <div class="saving" style="display:none; float:right;">Saving...</div>
          <div class="saved"  style="display:none;">Successfully Saved.</div>
          </th>
        </tr>
    </tbody>
</table>
 </form>
</div>
<div class="clearboth"></div>
<script>
	$(function(){
		$('.save_price').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/delivery_price_save.php',
				type: 'post',
				data: $('#form_page_price').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						//$('.saved').show().delay(1000).hide(function(){
							t.show();	
						//});	
					});
					alertify.success('Successfully Saved.');
				}
			})
		});
	});
	</script>
