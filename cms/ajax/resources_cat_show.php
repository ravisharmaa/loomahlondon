<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$cat_sn=0;
$row_blog_cats=$blg->showResourcesCategories();
if(count($row_blog_cats))
{
	?>
	<ul id="sorter_blog_cat" class="polaroid">
    	<?php    
    	foreach($row_blog_cats as $row_blog_cat)
		{
			?>
            <li id="sortdata_<?php echo $row_blog_cat['resources_cat_id']; ?>">
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="cat_sn"><?php echo ++$cat_sn; ?></span>. <?php echo stripslashes($row_blog_cat['resources_cat_name']); ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="login.php?p_id=manage_resource&id=<?php echo $row_blog_cat['resources_cat_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="resources_cat_del" rel="<?php echo $row_blog_cat['resources_cat_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                </div>
            </li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter_blog_cat").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/resources_cat_sort.php", order, function(theResponse){
                    var cat_sn=0;
                    $('.cat_sn').each(function(){
                        $(this).html(++cat_sn);
                    });
                }); 															 
            }								  
        });
        $('.blog_cat_edit').fancybox({
            beforeClose: function(){
                $.ajax({
                    url: 'ajax/resourrces_cat_show.php',
                    type: 'post',
                    data: {},
                    success: function(data){
                        $('#blog_cat_block').html(data);
                    }
                });	
            }
        });
        $('.resources_cat_del').click(function(){
            if(confirm("Are you sure that you wish to delete this resources?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/resources_cat_delete.php',
                    type: 'post',
                    data: { id: t.attr('rel') },
                    success: function(data){
                        t.parent().parent().hide();
                    }
                });	
            }
        });
    });
    </script>
    <?php
}
else
{
	?>
    <div class="unavailable">No categories are available in resources page. If you wish to add, click the "Add a category" button above.</div>
    <?php	
}
?>