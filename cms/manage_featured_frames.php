<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=2;
$row_content=$cnt->getFeaturedPageContent($content_id);
$show_tab="cat_list";
?>
<h1 style="width:500px;">Featured Items</h1>
<div class="myadd_links" style="margin-right:0;"><a href="login.php?p_id=manage_cat_seo">Search Engine Optimisation</a></div>
<div class="myadd_links"><a href="login.php?p_id=manage_other_category">Product Categories and Products</a></div>


<div class="clearboth"></div>
<div class="breadcrumb">
<a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_category">Mirror gallery</a> &raquo; <?php echo ucfirst(strtolower(stripslashes($row_content['content_title'])));?>
</div>
	<div class="info">
    	Please overwrite the title and head paragraph for the mirror gallery page that you wish to have.
    </div>
    <form id="form_page_content">
    <table border="0" class="myform">
    <tr>
       <!-- <td class="formleft" style="width:50%">Title</td>-->
        <td class="formright" colspan="2" style="text-align:center;"><input style="text-transform:uppercase;width:98%;color: #565656; font-family:Cinzel,serif; text-align:center; font-size: 22px; font-weight: 100;letter-spacing: 0.5px;" type="text" name="content_title" value="<?php echo stripslashes($row_content['content_title']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
    <td class="formleft" style="width:23%">First Line Description</td>
        <td class="formright">
      <input type="text" name="content_desc" style="width:99%;  margin-right:20px;  padding:5px 0; color: #757374; font-family: Ubuntu,sans-serif;font-size: 14px;font-weight: normal;text-rendering: optimizelegibility; text-align:center" class="mytextbox" value="<?php echo stripslashes($row_content['content_desc']); ?>">
        </td>
    </tr>
    <tr>
    <td class="formleft" style="width:23%">Second Line Description</td>
        <td class="formright">
    <input type="text" name="content_desc_line2" style="width:99%; margin-right:20px; padding:5px 0; color: #757374; font-family: Ubuntu,sans-serif;font-size: 14px;font-weight: normal;text-rendering: optimizelegibility; text-align:center" value="<?php echo stripslashes($row_content['content_desc_line2']); ?>" class="mytextbox">
        </td>
    </tr>

    <tr>
        <td class="formleft" style="border-right:0">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input style="float:right;" type="button" value="Save" class="mybtn save_content" />
        	<div class="saving" style="float:right;">Saving...</div>
            <div class="saved" style="float:right;">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_content').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/featured_content_save.php',
				type: 'post',
				data: $('#form_page_content').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
				}
			})
		});
	});
	</script>
    <div class="hr"></div>
    <div class="clearboth"></div>
    <div id="featured_block">
        <div class="info">

        Please select three categories that you wish to add as featured frames.<br /><br />
        Please note that you do not need to click save for this to change.
 <!--       <br /><br />
        Click the 'Save' button at the foot when you are happy with your selection. -->
    </div>
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/featured_cat_add.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#featured_block').html(data);
				}
			});
		});
		</script>
         <div class="clearboth"></div>
         </div>
         
             <div class="info">
    	Please overwrite the title and head paragraph for the other categories section that you wish to have.
    </div>
    <?php
	//$row_content2=$cnt->getPageContent(4);
	$row_content2=$cnt->getFeaturedPageContent(4);
	?>
    <form id="form_page_content2">
    <table border="0" class="myform">
      <tr>
       <!-- <td class="formleft" style="width:50%">Title</td>-->
        <td class="formright" colspan="2" style="text-align:center;"><input style="text-transform:uppercase;width:98%;color: #565656; font-family:Cinzel,serif; text-align:center; font-size: 22px; font-weight: 100;letter-spacing: 0.5px;" type="text" name="content_title" value="<?php echo stripslashes($row_content2['content_title']); ?>" class="mytextbox" /></td>
    </tr>
        <tr>
    <td class="formleft" style="width:23%">First Line Description</td>
        <td class="formright">
      <input type="text" name="content_desc" style="width:99%;  margin-right:20px;  padding:5px 0; color: #757374; font-family: Ubuntu,sans-serif;font-size: 14px;font-weight: normal;text-rendering: optimizelegibility; text-align:center" class="mytextbox" value="<?php echo stripslashes($row_content2['content_desc']); ?>">
        </td>
    </tr>
    <tr>
    <td class="formleft" style="width:23%">Second Line Description</td>
        <td class="formright">
    <input type="text" name="content_desc_line2" style="width:99%; margin-right:20px; padding:5px 0; color: #757374; font-family: Ubuntu,sans-serif;font-size: 14px;font-weight: normal;text-rendering: optimizelegibility; text-align:center" value="<?php echo stripslashes($row_content2['content_desc_line2']); ?>" class="mytextbox">
        </td>
    </tr>
    
    <tr>
        <td class="formleft" style="border-right:0">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input style="float:right;" type="button" value="Save" class="mybtn save_content2" />
        	<div style="float:right;" class="saving_other_cat">Saving...</div>
            <div style="float:right;" class="saved_other">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="4" />
    </form>
    <script>
	$(function(){
		$('.save_content2').click(function(){
			var t=$(this);
			t.hide();
			$('.saving_other_cat').show();
			$.ajax({
				url: 'ajax/featured_content_save.php',
				type: 'post',
				data: $('#form_page_content2').serialize(),
				success: function(){
					$('.saving_other_cat').fadeOut(function(){
						$('.saved_other').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
				}
			})
		});
	});
	</script>
        