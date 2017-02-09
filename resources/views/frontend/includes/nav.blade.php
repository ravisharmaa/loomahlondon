<header class="header">
    <div class="mp-section">
        <div id="menu-toggle">
            <div id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="cross">
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <nav class="mp-nav pull-left fadeIn overlay" id="overlay">
                    <div class="mob-nav">
                        <ul>
                            <li class="<?php if(isset($page)&&$page=="rug-designs"){echo 'active';}?>">
                                <a href="rug-designs.php" class="anchor">Rug Designs</a>
                            </li>
                            <li class="<?php if(isset($page)&&$page=="bespoke-rug-service"){echo 'active';}?>">
                                <a href="bespoke-rug-service.php" class="anchor">Bespoke Rug Service</a>
                            </li>
                            <li class="visible-xs visible-sm <?php if(isset($page)&&$page=="about-us"){echo 'active';}?>">
                                <a href="about-us.php" class="anchor">About Us</a>
                            </li>
                            <li class="visible-xs visible-sm <?php if(isset($page)&&$page=="contact-us"){echo 'active';}?>">
                                <a href="contact-us.php" class="anchor">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="logo fadeIn">
                    <a href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL; ?>img/<?php echo (isset($page) and $page=="home")?"mp-logo-w":"mp-logo"; ?>.png" alt="Marcus Paul Hand Woven Rugs" title="Marcus Paul Hand Woven Rugs"></a>
                </div>
            </div>

            <div class="col-md-4 hidden-xs hidden-sm">
                <nav class="mp-nav pull-right fadeIn">
                    <ul>
                        <li class="<?php if(isset($page)&&$page=="about-us"){echo 'active';}?>">
                            <a href="about-us.php">About Us</a>
                        </li>
                        <li class="<?php if(isset($page)&&$page=="contact-us"){echo 'active';}?>">
                            <a href="contact-us.php">Contact us</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</header>