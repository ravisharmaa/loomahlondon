<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$cat_url=$_POST['url'];
$slideshow_id=$_REQUEST['id'];
$row_slide=$cnt->showSlideImage($slideshow_id);

$row_cats=$cat->showCategoryFromAlias($cat_url);
$cat_id=$row_cats['cat_id'];

$decorative_p_id=3;
$row_firstcat=$cat->showFirstCategory($decorative_p_id);
if($cat_url=='textiles' or $cat_url=='wallpapers' or $cat_url=='decorative-pieces'."/".$row_firstcat['cat_alias'])
{
	if($cat_url=='textiles'){
	$parent_id=1;
	}
	else if($cat_url=='wallpapers'){
	$parent_id=2;
	}
	else
	{
	$parent_id=3;
	}
	

				
				?>
	      <select name="slideshow_link"  class="selecting_val myselectbox" style="width:200px;">
            	<option value="home" <?php if($cat_url=='home') echo "selected"; ?>>Home Page</option>
                <option value="about-us" <?php if($cat_url=='about-us') echo "selected"; ?> >About</option>
                <option value="textiles" <?php if($cat_url=='textiles') echo "selected"; ?>>Textiles</option>
                <option value="wallpapers" <?php if($cat_url=='wallpapers') echo "selected"; ?>>Wallpapers</option>
                <?php
				$decorative_p_id=3;
			    $row_firstcat=$cat->showFirstCategory($decorative_p_id);
				?>
                <option value="decorative-pieces/<?php echo $row_firstcat['cat_alias']; ?>" <?php if($cat_url=='decorative-pieces'."/".$row_firstcat['cat_alias']) echo "selected"; ?>>Decorative Pieces</option>
            
                <option value="terms-and-conditions" <?php if($cat_url=='terms-and-conditions') echo "selected"; ?> >Terms and Conditions</option>
                <option value="contact-us" <?php if($cat_url=='contact-us') echo "selected"; ?> >Contact</option>
                <option value="site-map" <?php if($cat_url=='site-map') echo "selected"; ?>>Site Map</option>
          </select>
            
		<select name="slideshow_link"  class="selecting_nextval myselectbox" style="width:200px;">
       	<option value="<?php echo stripslashes($cat_url); ?>">Please select</option>
			 <?php    
            $row_cats=$cat->showAllCategories($parent_id);
            if(count($row_cats))
            {
                foreach($row_cats as $row_cat)
                {
                   $cat_id=$row_cat['cat_id'];
                    ?>
                    <option value="<?php echo stripslashes($cat_url); ?>/<?php echo stripslashes($row_cat['cat_alias']); ?>"><?php echo stripslashes($row_cat['cat_name']); ?></option>
                    <?php
                }
            }
            ?>
	
		</select>
        	
<?php
}
else
{
?>

	      <select name="slideshow_link"  class="selecting_val myselectbox" style="width:200px;">
            	<option value="home" <?php if($cat_url=='home') echo "selected"; ?>>Home Page</option>
                <option value="about-us" <?php if($cat_url=='about-us') echo "selected"; ?> >About</option>
                <option value="textiles" <?php if($cat_url=='textiles') echo "selected"; ?>>Textiles</option>
                <option value="wallpapers" <?php if($cat_url=='wallpapers') echo "selected"; ?>>Wallpapers</option>
                <option value="decorative-pieces" <?php if($cat_url=='decorative-pieces') echo "selected"; ?>>Decorative Pieces</option>
                <option value="the-edit" <?php if($cat_url=='the-edit') echo "selected"; ?>>The Edit</option>
                <option value="terms-and-conditions" <?php if($cat_url=='terms-and-conditions') echo "selected"; ?> >Terms and Conditions</option>
                <option value="contact-us" <?php if($cat_url=='contact-us') echo "selected"; ?> >Contact</option>
                <option value="site-map" <?php if($cat_url=='site-map') echo "selected"; ?>>Site Map</option>
            </select>
            
<?php
}

?>
<script>
$(function(){
	$('.selecting_val').change(function(){
	//alert('hellow');
		var url=$(this).val();
		$.ajax({
			url: 'ajax/select_link.php?id=<?php echo $slideshow_id; ?>',
			type: 'post',
			data: { url: url },
			success: function(data){
				$('#internal_link').html(data);	
			}
		});
	});	   
});
</script>

<script>
$(function(){
	$('.selecting_nextval').change(function(){
	//alert('hellow');
		var url=$(this).val();
		$.ajax({
			url: 'ajax/select_nextlink.php?id=<?php echo $slideshow_id; ?>',
			type: 'post',
			data: { url: url },
			success: function(data){
				$('#internal_link').html(data);	
			}
		});
	});	   
});
</script>


