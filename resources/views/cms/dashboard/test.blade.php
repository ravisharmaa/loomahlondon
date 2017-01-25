<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
@include($header)
<body style="background:#f3f3f3;">
<div class="header">
    <div class="wrapper">
        <div class="left">
            <h1>Welcome {{Auth::user()->name}}</h1>
            <h2> {{Auth::user()->username}}  </h2>
            <div class="plate">
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="../" target="_blank" class="visitsite">Visit Site</a> |
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="login.php" class="dashboard">Dashboard</a> |

                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="login.php?p_id=admin_users" class="adminuser">User Profile</a> |
                {{--<a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="login.php?p_id=change_password" class="changepassword">Change Password</a> | */?>--}}
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="logout.php" class="logout">Logout</a>
            </div>
        </div>
        <div class="right"></div>
        <div class="clearboth"></div>
        <div class="nav">
            <ul class="sf-menu">
                <li><a href="login.php?p_id=manage_home">Home</a></li>
                <li><a href="login.php?p_id=manage_about">About</a></li>
                <li><a href="login.php?p_id=manage_textiles&id=1">Textiles</a></li>
                <li><a href="login.php?p_id=manage_wallpapers&id=2">Wallpapers</a></li>
                <li><a href="login.php?p_id=manage_decorative_pieces&id=3">Decorative Pieces</a></li>

                <li><a href="JavaScript:void(0);">The Edit</a>
                    <ul>
                        <li><a href="JavaScript:void(0);">News</a>
                            <ul>
                                <li><a href="login.php?p_id=manage_blogs">All News</a></li>
                                <li><a href="login.php?p_id=manage_blog_categories">News Categories</a></li>
                            </ul>
                        </li>
                        <li> <a href="login.php?p_id=manage_resources">Resources</a></li>
                        <li> <a href="login.php?p_id=manage_instagram">Instagram</a></li>
                        <li> <a href="login.php?p_id=manage_gallery">Gallery</a></li>
                        <li> <a href="login.php?p_id=manage_subscribers">News Subscribers</a></li>
                    </ul>
                </li>
                <li><a href="login.php?p_id=manage_legal&page=1" >Terms & Conditions</a></li>
                <li><a href="login.php?p_id=manage_contactus">Contact</a></li>
                <li><a href="JavaScript:void(0);">Sales</a>
                    <ul>
                        <li><a href="login.php?p_id=manage_sales">Sales Order</a>
                        <li><a href="login.php?p_id=manage_deliverycharges">Delivery Charges</a></li>
                        <li><a href="login.php?p_id=manage_pricelist">Pricelist</a></li>
                    </ul>
                </li>



            </ul>
        </div>
    </div>
</div>
<div class="container" style="margin-bottom:0;">

    <div class="clearboth"></div>
</div>

</body>
</html>