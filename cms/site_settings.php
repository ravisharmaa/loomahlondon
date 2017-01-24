<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
if(isset($_POST['submitted']) and $_POST['submitted']=="Change Settings")
{
	$site_name=addslashes($_POST['site_name']);
	$site_url=addslashes($_POST['site_url']);
	$site_email=addslashes($_POST['site_email']);
	$site_timezone=$_POST['site_timezone'];
	$daylight_savingtme=0;
	if(isset($_POST['daylight_savingtme']))
		$daylight_savingtme=1;
	
	$business_name=addslashes($_POST['business_name']);
	$contact_address1=addslashes($_POST['contact_address1']);
	$contact_address2=addslashes($_POST['contact_address2']);
	$contact_mobile=addslashes($_POST['contact_mobile']);
	$contact_phone=addslashes($_POST['contact_phone']);
	$contact_fax=addslashes($_POST['contact_fax']);
	$contact_email=addslashes($_POST['contact_email']);
	
	$site_titletag=addslashes($_POST['site_titletag']);
	$site_metakeywords=addslashes($_POST['site_metakeywords']);
	$site_metadescription=addslashes($_POST['site_metadescription']);
	
	$site_currency=addslashes($_POST['site_currency']);
	$site_currencysign=addslashes($_POST['site_currencysign']);
	$site_lengthunit=addslashes($_POST['site_lengthunit']);
	$site_massunit=addslashes($_POST['site_massunit']);
	
	$site_status=addslashes($_POST['site_status']);
	$site_status_message=addslashes($_POST['site_status_message']);
	
	$myfun->setSettingsValue('site_name',$site_name);
	$myfun->setSettingsValue('site_url',$site_url);
	$myfun->setSettingsValue('site_email',$site_email);
	$myfun->setSettingsValue('site_timezone',$site_timezone);
	$myfun->setSettingsValue('daylight_savingtme',$daylight_savingtme);
	
	$myfun->setSettingsValue('business_name',$business_name);
	$myfun->setSettingsValue('contact_address1',$contact_address1);
	$myfun->setSettingsValue('contact_address2',$contact_address2);
	$myfun->setSettingsValue('contact_mobile',$contact_mobile);
	$myfun->setSettingsValue('contact_phone',$contact_phone);
	$myfun->setSettingsValue('contact_fax',$contact_fax);
	$myfun->setSettingsValue('contact_email',$contact_email);
	
	$myfun->setSettingsValue('site_titletag',$site_titletag);
	$myfun->setSettingsValue('site_metakeywords',$site_metakeywords);
	$myfun->setSettingsValue('site_metadescription',$site_metadescription);
	
	$myfun->setSettingsValue('site_currency',$site_currency);
	$myfun->setSettingsValue('site_currencysign',$site_currencysign);
	$myfun->setSettingsValue('site_lengthunit',$site_lengthunit);
	$myfun->setSettingsValue('site_massunit',$site_massunit);
	
	$myfun->setSettingsValue('site_status',$site_status);
	$myfun->setSettingsValue('site_status_message',$site_status_message);
	
	$msg="Site settings are successfully changed.";
}
else
	$msg="";
?>
<script type="text/javascript">
$(function(){
	$(".site_status").click(function(){
		if($(this).val()=="Online")
			$("#offline_msg").hide();
		else
			$("#offline_msg").show();
	});
});
</script>
<div class="right">
    <div class="myform1">
        <h1>Site Settings</h1>
        <?php
        if(isset($msg) and !empty($msg))
        {
            ?>
            <div class="ok"><?php echo $msg; ?></div>
            <?php
        }
        else
        {
            ?>
            <div class="info">Site settings provide you to configure your site attributes.</div>
            <?php
        }
        ?>	
        <form action="" method="post">
        <ul class="tabs">
            <li class="current"><a href="JavaScript:void(0);" rel="tab1">Site Info</a></li>
            <li><a href="JavaScript:void(0);" rel="tab2">Contact Info</a></li>
            <li><a href="JavaScript:void(0);" rel="tab3">Site SEO</a></li>
            <li><a href="JavaScript:void(0);" rel="tab4">Site Units</a></li>
            <li><a href="JavaScript:void(0);" rel="tab5">Site Status</a></li>
        </ul>
        <div class="clearboth"></div>
        <div id="tab1" class="tab">
            <h3>Site Information</h3>
            <div class="formleft">Site Name</div>
            <div class="formright"><input type="text" name="site_name" size="66" value="<?php echo $myfun->getSettingsValue('site_name'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Site URL</div>
            <div class="formright"><input type="text" name="site_url" size="66" value="<?php echo $myfun->getSettingsValue('site_url'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Site Email</div>
            <div class="formright"><input type="text" name="site_email" size="66" value="<?php echo $myfun->getSettingsValue('site_email'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Time Zone</div>
            <div class="formright">
                <select name="site_timezone">
                    <option value=""> - - Select Time Zone - - </option>
                    <?php
                    $site_timezone=$myfun->getSettingsValue('site_timezone');
                    $myquery_timezone=$mydb->select_sql(array("*"),"tbl_timezones","1 order by timezone_id");
                    while($row_timezone=$mydb->fetch_array($myquery_timezone))
                    {
                        ?>
                        <option value="<?php echo $row_timezone['timezone_id']; ?>" <?php if($site_timezone==$row_timezone['timezone_id']) echo "selected"; ?>><?php echo $row_timezone['timezone_gmt']; ?> <?php echo $row_timezone['timezone_location']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright">
                <label><input type="checkbox" name="daylight_savingtme" <?php if($myfun->getSettingsValue('daylight_savingtme')==1) echo "checked"; ?> /> Daylight Saving Time</label>
                <p style="font-size:10px;color:#C30;">NB: If you have just changed the time zone and found nothing changed in time, then <a href="">click here</a>.</p>
            </div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="submit" name="submitted" value="Change Settings" class="mybtn" /></div>
            <div class="clearboth"></div>
        </div>
        <div id="tab2" class="tab">
            <h3>Contact Information</h3>
            <div class="formleft">Business Name</div>
            <div class="formright"><input type="text" name="business_name" size="66" value="<?php echo $myfun->getSettingsValue('business_name'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Contact Address</div>
            <div class="formright"><input type="text" name="contact_address1" size="66" value="<?php echo $myfun->getSettingsValue('contact_address1'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="text" name="contact_address2" size="66" value="<?php echo $myfun->getSettingsValue('contact_address2'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Contact No.</div>
            <div class="formright"><input type="text" name="contact_mobile" size="66" value="<?php echo $myfun->getSettingsValue('contact_mobile'); ?>" /> (Mob)</div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="text" name="contact_phone" size="66" value="<?php echo $myfun->getSettingsValue('contact_phone'); ?>" /> (Off)</div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="text" name="contact_fax" size="66" value="<?php echo $myfun->getSettingsValue('contact_fax'); ?>" /> (Fax)</div>
            <div class="clearboth"></div>
            <div class="formleft">Contact Email</div>
            <div class="formright"><input type="text" name="contact_email" size="66" value="<?php echo $myfun->getSettingsValue('contact_email'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="submit" name="submitted" value="Change Settings" class="mybtn" /></div>
            <div class="clearboth"></div>
        </div>
        <div id="tab3" class="tab">
            <h3>Site SEO</h3>
            <div class="formleft">Title Tag</div>
            <div class="formright"><input type="text" name="site_titletag" size="66" value="<?php echo $myfun->getSettingsValue('site_titletag'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Meta Keywords</div>
            <div class="formright"><textarea name="site_metakeywords" cols="50" rows="5"><?php echo $myfun->getSettingsValue('site_metakeywords'); ?></textarea></div>
            <div class="clearboth"></div>
            <div class="formleft">Meta Description</div>
            <div class="formright"><textarea name="site_metadescription" cols="50" rows="5"><?php echo $myfun->getSettingsValue('site_metadescription'); ?></textarea></div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="submit" name="submitted" value="Change Settings" class="mybtn" /></div>
            <div class="clearboth"></div>
        </div>
        <div id="tab4" class="tab">
            <h3>Site Units</h3>
            <div class="formleft">Site Currency</div>
            <div class="formright"><input type="text" name="site_currency" size="66" value="<?php echo $myfun->getSettingsValue('site_currency'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Site Currency Sign</div>
            <div class="formright"><input type="text" name="site_currencysign" size="66" value="<?php echo $myfun->getSettingsValue('site_currencysign'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Lenght Unit</div>
            <div class="formright"><input type="text" name="site_lengthunit" size="66" value="<?php echo $myfun->getSettingsValue('site_lengthunit'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">Mass Unit</div>
            <div class="formright"><input type="text" name="site_massunit" size="66" value="<?php echo $myfun->getSettingsValue('site_massunit'); ?>" /></div>
            <div class="clearboth"></div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="submit" name="submitted" value="Change Settings" class="mybtn" /></div>
            <div class="clearboth"></div>
        </div>
        <div id="tab5" class="tab">
            <h3>Site Status</h3>
            <div class="formleft">Site Status</div>
            <div class="formright"><label><input type="radio" name="site_status" value="Online" <?php if($myfun->getSettingsValue('site_status')=="Online") echo "checked"; ?> class="site_status" /> Online</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="site_status" value="Offline" <?php if($myfun->getSettingsValue('site_status')=="Offline") echo "checked"; ?> class="site_status" /> Offline</label></div>
            <div class="clearboth"></div>
            <div id="offline_msg" style="padding:0 100px; display:<?php echo $myfun->getSettingsValue('site_status')=="Offline"?"block":"none"; ?>">
                <textarea name="site_status_message" class="myeditor"><?php echo $myfun->getSettingsValue('site_status_message'); ?></textarea>
            </div>
            <div class="formleft">&nbsp;</div>
            <div class="formright"><input type="submit" name="submitted" value="Change Settings" class="mybtn" /></div>
            <div class="clearboth"></div>
        </div>
        </form>
    </div>
</div>