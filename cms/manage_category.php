<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}

$content_id=2;
$row_content=$cnt->getPageContent($content_id);
$parent_id=0;
$row_cats=$cat->showFeaturedCategories($parent_id);
$row_content2=$cnt->getPageContent(4);
$row_unfeaturecats=$cat->showUnFeaturedCategories($parent_id);
?>
<h1>Mirror Gallery</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; Mirror gallery
</div>
<div class="dashboard">
	<ul>
		<li style="margin-left:0; height:132px;">
            <div class="left">
                <a href="login.php?p_id=manage_featured_frames"><img src="images/dashboard/portfolio.png" height="54" border="0" /></a>
            </div>
            <div class="right">
                <h3><a href="login.php?p_id=manage_featured_frames">Featured Items</a></h3>
                <p>Manage featured items.</p>
                <a href="login.php?p_id=manage_featured_frames">Click here >></a>
            </div>
            <div class="clearboth"></div>
		</li>
        <li>
            <div class="left">
                <a href="login.php?p_id=manage_other_category"><img src="images/dashboard/cat.png" height="54" border="0" /></a>
            </div>
            <div class="right">
                <h3><a href="login.php?p_id=manage_other_category">Product Categories and Products</a></h3>
                <p>Manage product categories and products</p>
                <a href="login.php?p_id=manage_other_category">Click here >></a>
            </div>
            <div class="clearboth"></div>
		</li>
        <li>
            <div class="left">
                <a href="login.php?p_id=manage_cat_seo"><img src="images/dashboard/approach.png" height="54" border="0" /></a>
            </div>
            <div class="right" style="height:112px;">
                <h3><a href="login.php?p_id=manage_cat_seo">Search engine optimisation</a></h3>
                <p>Manage search engine optimisation.</p>
                <a href="login.php?p_id=manage_cat_seo">Click here >></a>
            </div>
            <div class="clearboth"></div>
		</li>
    </ul>            
	<div class="clearboth"></div>
</div>