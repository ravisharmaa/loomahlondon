<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$parent_id=0;
?>
<?php /*?>if(isset($_POST['featured_cat_add']))
{
 	$parent_id=0;
	$row_cats=$cat->showFeaturedCategories($parent_id);
	if(count($row_cats)>2)
	{
		echo "error";
	}
	else{
	$cat->addFeaturedCategory();
	}
	exit;
}<?php */?>

    <div class="info">

        Please select three categories that you wish to add as featured frames.<br /><br />
        Please note that you do not need to click save for this to change.
 <!--       <br /><br />
        Click the 'Save' button at the foot when you are happy with your selection. -->
    </div>
    <form id="form_featured_cat_add" name="form">
    <ul id="featured_sorter" class="polaroid">
		<?php    
        $row_cats=$cat->showCategories($parent_id);
        if(count($row_cats))
        {
            foreach($row_cats as $row_cat)
            {
                ?>
                <li style="width:230px;" id="featured_sortdata_<?php echo $row_cat['cat_id']; ?>">
                    <div class="polaroidimg">
                        <img src="../<?php echo CAT_IMG.$row_cat['cat_image']; ?>" width="210" height="150" border="0" />
                    </div>
                    <div class="polaroidlabel">
                    	<div class="tr">
                        	<div class="td"><label><input class="chk_cat_featured" type="checkbox" <?php if($row_cat['cat_featured']==1){?> checked="checked" <?php } ?>  name="cat_featured[<?php echo $row_cat['cat_id']; ?>]" /> <?php echo $row_cat['cat_name']; ?></label></div>
                        </div>    
                    </div>
                </li>

                <?php
            }
        }
        ?>
    </ul>
    <div class="clearboth"></div>
<script type="text/javascript">
  $(document).on("click", "input[type=checkbox]", function(e) {
    var num_checked = $("input[type=checkbox]:checked").length;
    if (num_checked > 3) {
      alert("You are only allowed to select three categories as featured frames. Please uncheck one of the featured frame and chose another");        
      $(e.target).prop('checked', false);
    }
	else{
			var t=$(this);
			$.ajax({
				url: 'ajax/chk_cat_featured.php',
				type: 'post',
				data: $('#form_featured_cat_add').serialize(),
				success: function(){
					t.show();
				}
			})
	}
  });
</script>
  <?php /*?>  <script>
	$(function(){
		$('.chk_cat_featured').click(function(){
			var t=$(this);
			$.ajax({
				url: 'ajax/chk_cat_featured.php',
				type: 'post',
				data: $('#form_featured_cat_add').serialize(),
				success: function(){
					t.show();
				}
			})
		});
	});
	</script>
    

   <table class="myform" width="99%">
    <tr>
   		 <td class="formleft" style="border-right:0;">&nbsp;</td>
        <td class="formright" style="padding-left:0; float:right;">
        	<input style="float:right;" type="button" value="Save" class="mybtn featured_cat_save" />
        	<div class="saving_featured_cat" style="float:right;">Saving...</div>
        </td>
    </tr>
    </table>
     <div class="hr"></div>
    <input type="hidden" name="featured_cat_add" value="1" />
    </form>
    <script>
		$("#featured_later_sorter").sortable({ 
		opacity: 0.6, cursor: 'move', update: function(){
			var order=$(this).sortable('serialize'); 
			$.post("ajax/featured_cat_sort.php", order, function(theResponse){
			}); 															 
		}								  
	});
	$(function(){
		$('.featured_cat_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving_featured_cat').show();
			$.ajax({
				url: 'ajax/featured_cat_add.php',
				type: 'post',
				data: $('#form_featured_cat_add').serialize(),
				success: function(data){
						if (data=="error"){
							alert ("Please select only three categories");
						}
					$('.saving_featured_cat').hide();
					t.show();
					$.fancybox.close();
				}
			})
		});
	});
	</script><?php */?>
 