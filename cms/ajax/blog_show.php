<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$sn_blog=0;
$row_blogs=$blg->showBlogs();
if(count($row_blogs))
{
	?>
    <table class="mytab" style="width:950px;">
    <thead>
        <tr>
            <th width="30">SN</th>
            <th align="left">News Article Title</th>
           <?php /* <th width="100">Replies</th> */?>
            <th width="120">Publish Date</th>
            <th width="100">Status</th>
            <th width="140">Action</th>
        </tr>    
	</thead>
    <tbody id="sorter_blog">
    	<?php    
    	foreach($row_blogs as $row_blog)
		{
			?>
            <tr id="sortdata_blog_<?php echo $row_blog['blog_id']; ?>">
            	<td align="center"><?php echo ++$sn_blog; ?>.</td>
                <td>
					<?php echo $row_blog['blog_title'];
					$c1=$blg->countNewReplies($row_blog['blog_id']);
					if($c1>0)
					{
						?>
                    	 - <a href="login.php?p_id=manage_blog_replies&id=<?php echo $row_blog['blog_id']; ?>"><?php echo $c1; ?> repl<?php echo $c1==1?"y":"ies"; ?></a>
                        <?php
					}
					?>
                </td>
                <?php /*
                <td align="center">
					<?php 
					$c2=$blg->countReplies($row_blog['blog_id']);
					if($c2==0)
					{
						?>
                        0
                        <?php
					}
					else
					{
						?>
                        <a href="login.php?p_id=manage_blog_replies&id=<?php echo $row_blog['blog_id']; ?>"><?php echo $c2; ?></a>
                        <?php	
					}
					?>
                </td> */?>
                <td align="center"><?php echo $fun->myDateTime("d M, Y",$row_blog['blog_date']); ?></td>
                <td align="center"><?php echo $row_blog['blog_status']==0?"Unpublished":"Published"; ?></td>
                <td align="center">
                	<a href="ajax/blog_edit.php?id=<?php echo $row_blog['blog_id']; ?>" title="Edit" class="blog_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="blog_delete" rel="<?php echo $row_blog['blog_id']; ?>" title="Delete"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                    <a href="login.php?p_id=manage_blog_emails&id=<?php echo $row_blog['blog_id']; ?>" title="Email"><img src="images/icon_email.png" width="24" height="24" border="0" /></a>
                </td>    
            </tr>
			<?php
		}
		?>
	</tbody>
    </table>
    <div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter_blog").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/blog_sort.php", order, function(theResponse){
                    var sn_blog=0;
                    $('.sn_blog').each(function(){
                        $(this).html(++sn_blog);
                    });
                }); 															 
            }								  
        });
        $('.blog_edit').fancybox({
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
		$('.blog_delete').click(function(){
			   if(confirm("Are you sure that you wish to delete this blog?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/blog_delete.php',
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
    <div class="unavailable">No blogs are available in this page. If you wish to add, click the "Add a blog" button above.</div>
    <?php	
}
?>