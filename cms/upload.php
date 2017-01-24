<?php
$connect = mysql_connect('localhost','root','');
//$connect = mysql_connect('localhost','user_nicola','Orrm32?2');
if (!$connect) {
 die('Could not connect to MySQL: ' . mysql_error());
}

//your database name
$cid =mysql_select_db('db_nicola_lawrence',$connect);
//$cid =mysql_select_db('db_nicola',$connect);
if(isset($_POST['action_submit']) and $_POST['action_submit']=="Upload file")
{
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

		 $col1 = $col[0];
		 $col2 = $col[2];
		 $col3 = $col[3];
		 $col4 = $col[4];
    	 $query = "INSERT INTO tbl_product_price(product_price_id, product_id, price_list_id, price_per_meter, sample_price, delivery_price, delivery_price_more_than_three, delivery_price_nz, delivery_price_nz_more_than_three, price_list_status) VALUES('','".$col1."','2','".$col2."','".$col3."','".$col4."','','','','')";
		$s     = mysql_query($query, $connect );
		 }
   }
		fclose($handle);
	//echo "File data successfully imported to database!!";
	mysql_close($connect);
	}
?>
<div  class="info">
You are about to upload a CSV file for the price list.<br>
 Please ensure that you are uploading the correct file for this price list.
</div>
<div class="spacer20"></div>

<table border="0" cellpadding="4" cellspacing="0" class="myform" style="min-height:200px;">
<form id="price_list" method="post" enctype="multipart/form-data" >
 <tr>
  <td class="formleft">Browse CSV File:</td>
  <td class="formright"><input name="thecsvfile" type="file" size="38" /></td>
  </tr>

 <tr>
      <td class="formleft">&nbsp;</td>
      <td class="formright">
        <input type="submit" value="Upload file"  name="action_submit"  class="dashboard_btn upload_pl">
      </td>
  </tr>
</form>
</table>
  <?php /*?><script>
	$(function(){
		$('.upload_pl').click(function(){
			var t=$(this);
			t.hide();
			$('.saving_detail').show();
			$.ajax({
				url: 'upload.php',
				type: 'post',
				data: $('#price_list').serialize(),
				success: function(){
				//console.log('asdkjds');
						$('.saving_detail').fadeOut(function(){
							$('.saved_detail').show().delay(2000).hide(function(){
								t.show();
							});	
						});
						//window.location = "login.php?p_id=manage_pricelist";
						//alertify.success('Successfully Saved.');
				}
			
			})
		});
	});
	</script><?php */?> 