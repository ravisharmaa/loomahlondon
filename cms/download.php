<?php
set_time_limit(0);
$plname = "price_list";
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("db_nicola_lawrence") or die(mysql_error());
//mysql_connect("localhost", "user_nicola", "Orrm32?2") or die(mysql_error());
//mysql_select_db("db_nicola") or die(mysql_error());
$result = mysql_query("SELECT * FROM tbl_product_price") 
or die(mysql_error());  
$csv_output="product Id, product Name, Price Per Metre, Sample Price, Delivery Price";
$csv_output .= "\n";
//$getprice2=$pro->getProductPrices();//tep_db_query("select * from tbl_product_price");
$sn=0;
//foreach($getprice2 as $getprice)
while($getprice = mysql_fetch_array( $result )) 
{
	$product_id=$getprice["product_id"];
	//$pro_name=$pro->showProduct($product_id);
	$pro_name = mysql_query("SELECT * FROM tbl_products where product_id='".$product_id."'") ;
	$row = mysql_fetch_array( $pro_name );
	if(!empty($row["product_name"]))
	{
	$sn++;
	//$csv_output .= $sn.",";
	$csv_output .= stripslashes($row["product_id"]).",";
	$csv_output .= stripslashes($row["product_name"]).",";
	$csv_output .= $getprice["price_per_meter"].",";
	$csv_output .= $getprice["sample_price"].",";
	$csv_output .= $getprice["delivery_price"];
	$csv_output .= "\n";
	}
}
$filename = $plname."_".date("d-m-Y_H-i",time()); 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv"); 
print $csv_output; 
exit;

?>