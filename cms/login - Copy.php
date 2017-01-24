<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
error_reporting(E_ALL);
$myroot="../";
include_once($myroot."config/config.php");
if(isset($_REQUEST['p_id']))
{
	switch($_REQUEST['p_id'])
	{
		case "admin_users":
			$page_link="admin_users.php";
			break;
		case "manage_legal":
			$page_link="manage_legal.php";
			break;
		case "manage_contactus":
			$page_link="manage_contactus.php";
			break;
		case "manage_homepage":
			$page_link="manage_homepage.php";
			break;
		case "manage_finishes":
			$page_link="manage_finishes.php";
			break;
		case "manage_finishes_category":
			$page_link="manage_finishes_category.php";
			break;
		case "manage_finishes_products":
			$page_link="manage_finishes_products.php";
			break;
		case "manage_cats":
			$page_link="manage_cats.php";
			break;
		case "manage_category":
			$page_link="manage_category.php";
			break;
		case "manage_featured_frames":
			$page_link="manage_featured_frames.php";
			break;
		case "manage_other_category":
			$page_link="manage_other_category.php";
			break;
		case "manage_cat_seo":
			$page_link="manage_cat_seo.php";
			break;
		case "manage_products":
			$page_link="manage_products.php";
			break;
		case "manage_product":
			$page_link="manage_product.php";
			break;
		case "manage_bespokes":
			$page_link="manage_bespokes.php";
			break;
		case "manage_casestudy":
			$page_link="manage_casestudy.php";
			break;
		case "manage_refine_groups":
			$page_link="manage_refine_groups.php";
			break;
		case "manage_refine_tags":
			$page_link="manage_refine_tags.php";
			break;
		case "manage_aboutus":
			$page_link="manage_aboutus.php";
			break;
		case "manage_content":
			$page_link="manage_content.php";
			break;
		case "manage_blog_categories":
			$page_link="manage_blog_categories.php";
			break;	
		case "manage_blogs":
			$page_link="manage_blogs.php";
			break;	
		case "manage_blog_replies":
			$page_link="manage_blog_replies.php";
			break;
		case "manage_blog_emails":
			$page_link="manage_blog_emails.php";
			break;
		case "manage_otherservices":
			$page_link="manage_otherservices.php";
			break;
		
		
		case "site_settings":
			$page_link="site_settings.php";
			break;
		case "change_password":
			$page_link="change_password.php";
			break;
		default:
			$page_link="dashboard.php";
	}
}
else
{
	$page_link="dashboard.php";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Content Management System :: <?php echo SITE_NAME; ?></title>
	<link rel="shortcut icon" href="images/favicon.ico" />
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script src="js/myscript.js" type="text/javascript"></script>
    <link href="superfish/css/superfish.css" rel="stylesheet" type="text/css">
	<script src="superfish/js/hoverIntent.js"></script>
	<script src="superfish/js/superfish.js"></script>
    <script>
	$(function(){
		$('.sf-menu').superfish();	   
	});
	</script>
	<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="ckeditor/adapters/jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
		$(".myeditor").each(function() {
			if($(this).attr('rel')=="basic"){
				var config = {
					langCode: 'en', 
					width : $(this).attr('cols')*100,
					height : $(this).attr('rows')*100,
					toolbar:
					[
						['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
						['TextColor','BGColor'],
						['Image', 'Link', 'Unlink'],
						['Cut','Copy','Paste'],
						['SelectAll'],
						'/',
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Table','NumberedList','BulletedList'],
						['Format'],
						['Font','FontSize'],
					],
					disableNativeSpellChecker: true,
					filebrowserBrowseUrl:'ckfinder/ckfinder.html',
					filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
					filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
					filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
				};
			}
			else{
				var config = {
					langCode: 'en', 
					width : $(this).attr('cols')*100,
					height : $(this).attr('rows')*100,
					toolbar:
					[
						['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
						['Image', 'Link', 'Unlink'],
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
				};
			}
			$(this).ckeditor(config);
		});
	});
	</script>
	<link rel="stylesheet" type="text/css" href="fancybox/css/jquery.fancybox.css" />
	<script type="text/javascript" src="fancybox/js/jquery.fancybox.js"></script>
    <link rel="stylesheet" href="jquery-ui-calendar/css/jquery-ui-1.10.3-smoothness.css">
	<script src="jquery-ui-calendar/js/jquery-ui-1.10.3.js"></script>
    <script>
    $(function(){
        $(".mydatepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true
        });
        
		
		$("#datepicker-from").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
            /*,onClose: function(selectedDate){
                $("#datepicker-to").datepicker("option","minDate",selectedDate);
            }*/
        });
        $("#datepicker-to").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
            /*,onClose: function(selectedDate) {
                $("#datepicker-from").datepicker("option","maxDate",selectedDate);
            }*/
        });
    });
    </script>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
    <script type="text/javascript">
	$.fn.upload = function(remote,successFn,progressFn) {
		return this.each(function() {
			var formData = new FormData();
			formData.append($(this).attr("name"), $(this)[0].files[0]);
			$.ajax({
				url: remote,
				type: 'POST',
				xhr: function() {
					myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload && progressFn){
						myXhr.upload.addEventListener('progress',progressFn, false);
					}
					return myXhr;
				},
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				complete : function(res) {
					if(successFn) successFn(res);
				}
			});
		});
	}
	</script>
    <link rel="stylesheet" href="tinycarousel/css/tinycarousel.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="tinycarousel/js/jquery.tinycarousel.js"></script>
    <script>
	$(function(){
		$('a.accordiontab').click(function(){
			var t=$(this);
			var id=$(this).prop('rel');
			if($('#'+id).css('display')=="none"){
				$('.accordionblock').each(function(){
					if($(this).css('display')=="block"){
						$(this).slideUp();
						$('.accordiontab').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
					}
				});
				$('#'+id).slideDown();
				t.css({'background':'url(images/tgup.png) no-repeat right #E30B5D'});
				$('html, body').animate({ scrollTop: t.offset().top },1000);	   
			}
			else{
				$('#'+id).slideUp();
				t.css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
			}
		});	   
	});
	</script>
</head>
<body style="background:#E7E2D3;">
<?php include_once "includes/header.php"; ?>
<div class="container" style="margin-bottom:0;">
	<?php include_once $page_link; ?>
	<div class="clearboth"></div>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>
