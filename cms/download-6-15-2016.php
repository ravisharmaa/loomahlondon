<?php
include("../includes/link.php");
//include("sessionfile.php");
set_time_limit(0);
$plname = "product_list";

$csv_output="product_id, product_name, product_alias, care_order, product_image_sm, product_image_lg, product_desc, composition, width, min_order_qty, cat_id, pro_repeat, 	origin,	product_order, product_status, product_titletag, product_metakeywords, product_metadescription";
$csv_output .= "\n";
$getprice2=tep_db_query("select * from tbl_products");
while($getprice=tep_db_fetch_array($getprice2)){

$csv_output .= $getprice["product_id"].",";
$csv_output .= $getprice["product_name"].",";
$csv_output .= $getprice["product_alias"].",";
$csv_output .= $getprice["care_order"].",";
$csv_output .= $getprice["product_image_sm"].",";
$csv_output .= $getprice["product_image_lg"].",";
$csv_output .= $getprice["product_desc"].",";
$csv_output .= $getprice["composition"].",";
$csv_output .= $getprice["width"].",";
$csv_output .= $getprice["min_order_qty"].",";
$csv_output .= $getprice["cat_id"].",";
$csv_output .= $getprice["pro_repeat"].",";
$csv_output .= $getprice["origin"].",";
$csv_output .= $getprice["product_order"].",";
$csv_output .= $getprice["product_status"].",";
$csv_output .= $getprice["product_titletag"].",";
$csv_output .= $getprice["product_metakeywords"].",";
$csv_output .= $getprice["product_metadescription"];
$csv_output .= "\n";
}
$filename = $plname."_".date("d-m-Y_H-i",time()); 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv"); 
print $csv_output; 
exit;

?>