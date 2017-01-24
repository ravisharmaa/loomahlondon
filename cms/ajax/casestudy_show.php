<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$row_casestudies=$csd->showCaseStudies();
if(count($row_casestudies))
{
	?>
	<ul id="sorter" class="polaroid">
		<?php
		$csd_sn=0;
		foreach($row_casestudies as $row_casestudy)
		{
			?>
			<li id="sortdata_<?php echo $row_casestudy['casestudy_id']; ?>">
				<div class="polaroidimg">
					<a href="login.php?p_id=manage_casestudy&id=<?php echo $row_casestudy['casestudy_id']; ?>"><img src="../<?php echo CASESTUDY_IMG.$row_casestudy['casestudy_image']; ?>" width="200" height="280" border="0" /></a>
				</div>
				<div class="polaroidlabel">
                	<div class="tr">
                    	<div class="td">
							<span class="csd_sn"><?php echo ++$csd_sn; ?></span>. <?php echo stripslashes($row_casestudy['casestudy_name']); ?>
						</div>
                	</div>        
                </div>
				<div class="polaroidoption">
					<a href="login.php?p_id=manage_casestudy&id=<?php echo $row_casestudy['casestudy_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
					<a href="JavaScript:void(0);" class="casestudy_del_link" rel="<?php echo $row_casestudy['casestudy_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/casestudy_sort.php", order, function(theResponse){
                    var csd_sn=0;
					$('.csd_sn').each(function(){
						$(this).html(++csd_sn);
					});
                }); 															 
            }								  
        });
        $('.casestudy_del_link').click(function(){
            if(confirm("Are you sure that you wish to delete this case study?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/casestudy_delete.php',
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
    <div class="unavailable">No case studies are available. If you wish to add a case study, click the "Add a case study" button above.</div>
    <?php
}
?>