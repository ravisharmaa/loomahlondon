<?php session_start();
include("../includes/link.php");
include("sessionfile.php");

$pageid=$_REQUEST["pageid"];
$plid=$_REQUEST["plid"];

$action_submit=$_POST["action_submit"];

if($action_submit == 1){

$file_name=$_FILES["thecsvfile"]["name"];
$file_path=$_FILES["thecsvfile"]["tmp_name"];


$uniquename=date("ldShisA");

$newcsvfilename="$uniquename"."_"."$file_name";
if($file_name!=""){
copy($file_path, "csvfiles/$newcsvfilename");
}

$del_previous_record=mysql_query("delete from tbl_prices");

//Start of CSV Import
$new_row8=1;
$row8 = 1;

$handle8 = fopen("csvfiles/$newcsvfilename", "r");
//$handle8 = fopen("csvfiles/Price_List__07-02-2013_04-57.csv", "r");

while (($data8 = fgetcsv($handle8, 1000000, ",")) !== FALSE) {
$num8 = count($data8);


if($new_row8 > 1){

$sql8="insert into tbl_prices values('','1'";


for ($c8=0; $c8 < $num8; $c8++)
{

if($c8 == 0){
$sql8 .=",'".$data8[$c8]."'";
}

if($c8 > 2){
$sql8 .=",'".$data8[$c8]."'";
}

}

$sql8 .=")";


$insert_data8=tep_db_query($sql8);

}

$row8++;
$new_row8++;


}

fclose($handle8);
//End of CSV Import




print"<script>window.location='pricelists.php?pageid=".$pageid."&pupload=yes'</script>";
die();

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="stylespop.css" rel="stylesheet" type="text/css">
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<table border="0" cellpadding="4" cellspacing="0" width="100%">

<tr>
<td class="maintitle">
<b>UPLOAD CSV FILE</b>
</td>
</tr>
<tr>
<td class="content">
<div  class="scrollable" style="width:720px; height:300px;">
<div  class="contentdiv" style="min-height:268px;">

You are about to upload a CSV file for the price list. Please ensure that you are uploading the correct file for this price list.

<br><br>

<form enctype="multipart/form-data" name="formadd" action="" method="post" target="_parent">

<div class="common">
Browse CSV File:
<br>
<input name="thecsvfile" type="file" size="38" />

</div>
<div class="spacer20"></div>
<div class="spacer10"></div>
<input type="hidden" name="action_submit" value="1">
<input type="submit" value="upload file" class="brown">

</form>


</div></div></td></tr></table>