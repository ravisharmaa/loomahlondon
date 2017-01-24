<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['bespoke_content_title']))
{
	$cnt->addBespokeContent();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add Content</h1>
    <div class="clearboth"></div>
    <div class="info">
    	Provide the title and the paragraph for the block.
    </div>
    <form id="form_bespoke_content_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="bespoke_content_title" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Paragraph</td>
        <td class="formright"><textarea name="bespoke_content_desc" class="myeditor"></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn bespoke_content_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    </form>
    <script>
	$('.myeditor').ckeditor({
		langCode: 'en', 
		width : '100%',
		height : '200',
		toolbar:
		[
			['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
			['Image', 'Link', 'Unlink', 'Flash'],
			['Cut','Copy','Paste','PasteText','PasteFromWord','-','Find','Replace'],
			['SelectAll','RemoveFormat'],
			'/',
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Table','NumberedList','BulletedList'],
			['Format'],
			['TextColor','BGColor'],
			['Font','FontSize'],
		],
		filebrowserBrowseUrl:'ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
	});
    $(function(){
		$('.bespoke_content_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/bespoke_content_add.php',
				type: 'post',
				data: $('#form_bespoke_content_add').serialize(),
				success: function(){
					$('.saving').hide();
					t.show();
					$.fancybox.close();
				}
			});
		});
	});
	</script>
</div>