<?php include("cmsheader.php");

$del=$_REQUEST["del"];
$success=$_REQUEST["success"];
$plid=$_REQUEST["plid"];

if($del == 1){
$deletefromusers=tep_db_query("delete from tbl_plist where plid=".$plid);
print"<script>window.location='pricelists.php?pageid=".$pageid."&psub=".$psub."'</script>";
die();
}
?>


<div class="lText"><b>PRICE LISTS</b></div>
<div class="pnav">
You are here: 
<a href="firstpage.php" class="bclink">Dashboard</a> 
&gt; Price Lists
</div>
<div class="spacer20"></div>

<a href="downloadplascsv.php?pageid=<?php echo $pageid;?>&plid=<?php echo $plid;?>" class="brown">Download Price List as CSV</a>

<span id="jpop"><a href="uploadplascsv.php?pageid=<?php echo $pageid;?>&plid=<?php echo $plid;?>" class="brown" toptions="type = iframe,width =750, height = 420, overlayClose = 1">Upload Price List as CSV</a></span>

<a href="assignpltoaccountholders.php?pageid=<?php echo $pageid;?>" class="brown">Assign Price List to Account Holders</a>

<div class="spacer20"></div>

<?php if($_REQUEST["pupload"] == "yes"){?>
<p class="success">The CSV file has been uploaded successfully and the prices have been changed.</p>
<div class="spacer20"></div>
<?php }?>


<?php if($mcid){$mcid= $mcid;}else{$mcid = 1;}?>


<ul class="css-tabs">
<?php
$maincatlist2=tep_db_query("select * from tbl_maincats where mcid = '1' order by mcid");
while($maincatlist=tep_db_fetch_array($maincatlist2)){
?>
<li><a href="pricelists.php?pageid=<?php echo $pageid;?>&mcid=<?php echo $maincatlist["mcid"];?>"<?php if($maincatlist["mcid"]== $mcid){?> class="current"<?php }?>><?php echo $maincatlist["mcname"];?></a></li>
<?php }?>

</ul>

<div class="spacer20"></div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" id="data">
<tr>
<td width="30%" class="title"><b>PRODUCT</b></td>
<?php 
$allplt2=tep_db_query("select * from tbl_plist order by plid");
while($allplt=tep_db_fetch_array($allplt2)){
?>
<td width="7%" class="title" align="center"><b>List <?php echo $allplt["plid"];?></b></td>
<?php }?>
</tr>
<?php
$designname2=mysql_query("SELECT fbdid,fbdname,mcid FROM tbl_fabric_designs where fbddisp=0 and mcid=".$mcid." order by mcid,fbdname");
$i=1;
while($designname=mysql_fetch_array($designname2)){	
if($i%2){$theclass="odd";}else{$theclass="even";}
?>

<tr>
<td class="<?php echo $theclass;?>" valign="top">
<span id="jpop"><a href="editprprice.php?pageid=<?php echo $pageid;?>&mcid=<?php echo $mcid;?>&fbdid=<?php echo $designname["fbdid"];?>" toptions="type = iframe,width = 1000, height = 350, overlayClose = 1, scrollbar = 1"><?php echo $designname["fbdname"];?></a></span>
</td>
<?php 
$allpl2=tep_db_query("select * from tbl_plist order by plid");
while($allpl=tep_db_fetch_array($allpl2)){

$sql = "select ".$allpl["plist"]." as thisprice from tbl_prices where fbdid='".$designname["fbdid"]."'";

$chkpricelist2=tep_db_query($sql);
$chkpricelist=tep_db_fetch_array($chkpricelist2);
?>
<td class="<?php echo $theclass;?>" align="center"><?php echo $chkpricelist["thisprice"];?></td>
<?php }?>
</tr>

<?php $i++;}?>
</table>



<?php include("cmsfooter.php");?>
