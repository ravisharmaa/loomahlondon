<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['casestudy_name']))
{
	echo $csd->addCaseStudy();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add Case Study</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the case study detail that you wish to add.
    </div>
    <form id="form_casestudy_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Case Study Name</td>
        <td class="formright"><input type="text" name="casestudy_name" value="" class="mytextbox" /></td>
    </tr>
 <?php /*?>   <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="casestudy_desc" class="mytextarea"></textarea></td>
    </tr><?php */?>
    <input type="hidden" name="casestudy_desc" />
    <tr>
        <td class="formleft">Upload Image</td>
        <td class="formright"><input type="file" id="casestudy_image" name="casestudy_image" />
          <b class="line_height"><br />The uploaded image will appear as the case study on the bespoke service page.
            <br /> <br />The dimension of this image should be <?php echo CASESTUDY_IMG_W ?> px in width and <?php echo CASESTUDY_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                        </b>
                        </td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn casestudy_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    </form>
    <script>
	$(function(){
		$('.casestudy_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/casestudy_add.php',
				type: 'post',
				data: $('#form_casestudy_add').serialize(),
				success: function(id){
					$("#casestudy_image").upload("ajax/casestudy_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_casestudy&id='+id);
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>