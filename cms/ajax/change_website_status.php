<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['change_status']))
{
	echo $cnt->updateWebsiteStatus();
	exit;
}
?>
<style>
.myform .formright {
    border-bottom: 1px solid #eee;
    border-right: 1px solid #eee;
    color: #000;
    font: 16px/25px Arial,Helvetica,sans-serif;
    padding: 8px 10px;
    width:220px;
}
.myform {
    border-left: 1px solid #eee;
    border-top: 1px solid #eee;
}
.myform .formleft {
    border-bottom: 1px solid #eee;
    border-right: 1px solid #eee;
    color: #000;
    font: 16px/40px Arial,Helvetica,sans-serif;
    height: 40px;
    padding: 0 10px;
    text-align: right;
    vertical-align: top;
    width: 120px;
}
</style>
<div class="containerss" style="margin:0;">

    <h2>Change Website Status</h2>
 
    <br />
    <div class="clearboth"></div>

    <form id="form_cat_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Online</td>
        <td class="formright"><input type="checkbox" name="change_status" value="online" <?php if($cnt->getSettingsValue('site_status','online')){ echo 'checked'; }?> class="chb" /></td>
    </tr>
   <tr>
        <td class="formleft">Offline</td> 
        <td class="formright"><input type="checkbox" name="change_status" value="offline" <?php if($cnt->getSettingsValue('site_status','offline')){ echo 'checked'; }?> class="chb" /></td>
    </tr>
   
   
    
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn changestatus" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>

    </form>
    <script>
	$(function(){
		$(".chb").change(function() {
			var checked = $(this).is(':checked');
			$(".chb").prop('checked',false);
			if(checked) {
				$(this).prop('checked',true);
			}
		});
		$('.changestatus').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/change_website_status.php',
				type: 'post',
				data: $('#form_cat_add').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						t.show();	
					});
						// $(location).attr('href','login.php');
						alertify.success('Successfully Saved.');
				}
			})
		});
	});
	</script>
</div>