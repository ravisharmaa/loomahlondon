<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=11;
$show_tab="sub_pages";
?>
<h1>All News</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; News &raquo; All News
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="sub_pages" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="sub_pages") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE THE LIST OF NEWS FOR THE NEWS PAGE</a></div>
<div id="sub_pages" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="sub_pages")?"block":"none"; ?>;">
    <div class="info">
        Provided below are the news that feature within the news page.
        <br /><br />
        Click the "Add news article" button below if you wish to add a news article.
        <br /><br />
        Click on the pencil icon to manage its detail.
        <br /><br />
        In the unlikely event that you wish to delete a news article, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        The order of the list shown below is the most recent at first or the oldest at last.
    </div>
    <div class="myadd">
        <a href="ajax/blog_add.php" class="blog_add fancybox.ajax">Add news article</a>
    </div>
    <div class="clearboth"></div>
    <script>
    $(function(){
        $('.blog_add').fancybox({
            beforeClose: function(){
                $.ajax({
                    url: 'ajax/blog_show.php',
                    type: 'post',
                    data: {},
                    success: function(data){
                        $('#blog_block').html(data);
                    }
                });	
            }
        });	
    });
    </script>
    <div id="blog_block">
        <div class="pleasewait">Please wait...</div>
        <script>
        $(function(){
            $.ajax({
                url: 'ajax/blog_show.php',
                type: 'post',
                data: {},
                success: function(data){
                    $('#blog_block').html(data);
                }
            });
        });
        </script>
    </div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE NEWS PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the news page that you wish to have.
    </div>
    <?php
	$row_seo=$cnt->getPageSEO($content_id);
	?>
    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="content_titletag" value="<?php echo stripslashes($row_seo['content_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="content_metakeywords" class="mytextarea"><?php echo stripslashes($row_seo['content_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="content_metadescription" class="mytextarea"><?php echo stripslashes($row_seo['content_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/content_seo_save.php',
				type: 'post',
				data: $('#form_page_seo').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
				}
			})
		});
	});
	</script>
</div>    