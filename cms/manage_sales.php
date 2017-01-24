<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
?>
<style>
.order_name, .order_date, .order_status{
	color: #000;
	text-decoration: none;
	outline: none;
}
.order_name:hover, .order_date:hover, .order_status:hover{
	color: #666;
}

</style>
<script>
$(function(){
	$('.fancybox').fancybox();
	
	$('.order_name').click(function(){
		var myorder=$(this).attr('rel');
		var myorder_next="";
		if(myorder=="asc")
			myorder_next="desc";
		else
			myorder_next="asc";
		$.ajax({
			url: 'ajax/sale_records.php',
			type: 'post',
			data: { order_by: 'names', my_order:myorder },
			success: function(data){
				if(myorder_next=="desc"){
					$('#img_name img').attr('src','images/sort_up.png');
				}
				else{
					$('#img_name img').attr('src','images/sort_down.png');
				}
				$('#img_date img').attr('src','images/sort.png');
				$('#img_status img').attr('src','images/sort.png');
				$('.order_name').attr('rel',myorder_next);
				$('#sale_records').html(data);
				$('#searchname').val('');
			}
		});
	});
	
	$('.order_date').click(function(){
		var myorder=$(this).attr('rel');
		var myorder_next="";
		if(myorder=="asc")
			myorder_next="desc";
		else
			myorder_next="asc";
		$.ajax({
			url: 'ajax/sale_records.php',
			type: 'post',
			data: { order_by: 'dates', my_order:myorder },
			success: function(data){
				if(myorder_next=="desc"){
					$('#img_date img').attr('src','images/sort_up.png');
				}
				else{
					$('#img_date img').attr('src','images/sort_down.png');
				}
				$('#img_name img').attr('src','images/sort.png');
				$('#img_status img').attr('src','images/sort.png');
				$('.order_date').attr('rel',myorder_next);
				$('#sale_records').html(data);
				$('#searchname').val('');
			}
		});
	});
	
	$('.order_status').click(function(){
		var myorder=$(this).attr('rel');
		var myorder_next="";
		if(myorder=="pending")
			myorder_next="dispatch";
		else
			myorder_next="pending";
		$.ajax({
			url: 'ajax/sale_records.php',
			type: 'post',
			data: { order_by: 'status', my_order:myorder },
			success: function(data){
				if(myorder_next=="pending"){
					$('#img_status img').attr('src','images/sort_up.png');
				}
				else{
					$('#img_status img').attr('src','images/sort_down.png');
				}
				$('#img_name img').attr('src','images/sort.png');
				$('#img_date img').attr('src','images/sort.png');
				$('.order_status').attr('rel',myorder_next);
				$('#sale_records').html(data);
				$('#searchname').val('');
			}
		});
	});
	
	$('#searchname').keyup(function(){
		var mysearch=$(this).val();
		//$('#searching').show();
		$.ajax({
			url: 'ajax/show_sale_records.php',
			type: 'post',
			data: { mysearch: mysearch },
			success: function(data){
				$('#img_name img').attr('src','images/sort.png');
				$('#img_date img').attr('src','images/sort.png');
				$('#img_status img').attr('src','images/sort.png');
				$('#sale_records').html(data);
				//$('#searching').hide();
			}
		});
	});
});
</script>
<h1>Sales Order</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
    <a href="login.php">Dashboard</a> &raquo; Sales Order
</div>
<div class="info">List of Sales order.</div>
<?php
$page=1;
$myquery_sale=$pro->join_sales_bs_sucess();

if(count($myquery_sale))
{

    ?>
    <table class="mytab">
    <tr>
        <th width="30">SN</th>
        <th align="left">Customer Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search <input type="text" id="searchname" name="mysearch" value="" size="30" /></th>
        <th width="150">Order Date</th>
        <th width="120">Dispatch Status</th>
        <th width="120">Action</th>
    </tr>
    
     <?php /*?> <tr>
        <th width="30">SN</th>
        <th align="left"><a href="JavaScript:void(0);" rel="asc" class="order_name">Customer Name <span id="img_name"><img src="images/sort.png" width="11" height="11" border="0" /></span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search <input type="text" id="searchname" name="mysearch" value="" size="30" /> <span id="searching" style="display:none;"><img src="../images/opc-ajax-loader.gif" width="11" height="11" border="0" /></span></th>
        <th width="150"><a href="JavaScript:void(0);" rel="asc" class="order_date">Order Date <span id="img_date"><img src="images/sort.png" width="11" height="11" border="0" /></span></a></th>
        <th width="120"><a href="JavaScript:void(0);" rel="pending" class="order_status">Dispatch Status <span id="img_status"><img src="images/sort.png" width="11" height="11" border="0" /></span></a></th>
        <th width="120">Action</th>
    </tr><?php */?>
    <tbody id="sale_records">
    <?php
	
    $sn=0;
	foreach($myquery_sale as $row_sale)
    { 


	$sale_id=$row_sale['sale_id'];
    $row_sale_bs=$pro->showSaleBillingShippingAddress($sale_id);
	$date = strtotime($row_sale['sale_date']);
    ?>
        <tr>
            <td align="center"><?php echo ++$sn; ?>.</td>
            <td><?php echo ucfirst(stripslashes($row_sale_bs['billing_firstname'])); ?> <?php echo ucfirst(stripslashes($row_sale_bs['billing_lastname'])); ?></td>
            <td align="center"><?php echo date("j F Y",$date); ?></td>
            <td align="center"><?php echo $row_sale['dispatch_status']==0?"Pending":"Dispatched"; ?></td>
            <td align="center"><a href="manage_orders.php?id=<?php echo $row_sale['sale_id']; ?>" class="fancybox fancybox.ajax">View Details</a></td>
        </tr>
        <?php
	
    }
    ?>
    </tbody>
    </table>
    <?php
}
else
{
    ?>
    <div style="padding:20px 10px;">Currently no sale records are available.</div>
    <?php	
}
?>
<script>
$(function(){
	$(".fancybox").fancybox({
    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
       //$(location).attr('href','login.php?p_id=manage_sales');	
		 parent.location.reload(true);
    }
	});
});
</script>