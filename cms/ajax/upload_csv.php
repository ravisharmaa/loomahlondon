<?php
if(isset($_POST['file_submit']) and $_POST['file_submit']=="1")
{
	echo "hellow000";
	$action_submit=$_POST["action_submit"];

	$file_name=$_FILES["thecsvfile"]["name"];
	$file_path=$_FILES["thecsvfile"]["tmp_name"];
	$uniquename=date("ldShisA");
	$newcsvfilename="$uniquename"."_"."$file_name";
	if($file_name!=""){
	copy($file_path, "csvfiles/$newcsvfilename");
	}
	$new_row8=0;
	$row8 = 1;
	$handle = fopen("csvfiles/$newcsvfilename", "r");

  
   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
	    $new_row8++;
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
          $col[$c] = $data[$c];
        }
		if($new_row8 > 1)
		{

		echo  $col1 = $col[0];
		echo $col2 = $col[2];
		 $col3 = $col[3];
		 $col4 = $col[4];
    	  echo $query = "INSERT INTO tbl_product_price(product_price_id, product_id, price_list_id, price_per_meter, sample_price, delivery_price, delivery_price_more_than_three, delivery_price_nz, delivery_price_nz_more_than_three, price_list_status) VALUES('','".$col1."','2','".$col2."','".$col3."','".$col4."','','','','')";
		$s     = mysql_query($query, $connect );
		 }
   }
		fclose($handle);

	}
?>