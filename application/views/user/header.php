<?php date_default_timezone_set('Europe/London'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"></META>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/style.css">
            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/css.css">    
                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/buttons.css">
                    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/jquery-ui.css">    
                        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/pagenavi-css.css">
                            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/pagenavi-css.css">
                             <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css"/>-->
                            <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/share.css">-->
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/widgets.css">
                                    <link rel="stylesheet/less" href="<?= base_url(); ?>assets/css/user/body.less">

                                        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-responsive.css">


                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/less-1.js"></script>
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery.js"></script>
                                            <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/buttons.js"></script>-->
                                            <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/custom.js"></script>-->
                                            <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/devicepx-jetpack.js"></script>-->
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/gprofiles.js"></script>
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery-1.js"></script>

                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/loader.js"></script>
                                            <!--<script type="text/javascript" src="<? //=base_url(); ?>assets/js/user/st.js"></script>-->

<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/stcommon.js"></script>-->
<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/superfish.js"></script>-->
<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/wpgroho.js"></script>-->
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/custom/custom.js"></script>

                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery-ui-1.10.1.custom.js"></script>
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootstrap.min.js"></script>
                                            <script src="<?= base_url(); ?>assets/js/gallery/load-image.js"></script>
                                            <script src="<?= base_url(); ?>assets/js/gallery/bootstrap-image-gallery.js"></script>
                                            <script src="<?= base_url(); ?>assets/js/gallery/main.js"></script>
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery_002.js"></script>
                                    <!--         <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery_003.js"></script>
                                             <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery_004.js"></script>-->
                                            <script type="text/javascript" src="<?= base_url(); ?>assets/js/user/jquery-ui.js"></script>
                                            <style>
                                                .contain { background-size: contain; }
                                            </style>
                                            <?php
                                            if (isset($fb)) {
                                                $_SESSION['fb'] = "fb";
                                                echo '<style>
         .contain { background-size: contain; }
         
         #wrapper {
    margin: 0 auto;
    width: 760px;
    
     border-color: #DADADA;
    border-image: none;
    border-style: solid solid none;
    border-width: 3px 3px 0;
}


#topbg {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);

}


#latestjob .textwidget {
    margin-left: 22px;
    margin-top: -52px;
    width: 65%;
}

#left {
    float: left;
    margin-top: 25px;
    width: 495px;
}

.title {
    margin-bottom: 20px;
    width: 390px;
}



#right {
    background: none repeat scroll 0 0 #DCEBF1;
    border-left: 7px solid #DCEBF1;
    border-top: 7px solid #DCEBF1;
    float: right;
    margin-right: 0;
    margin-top: 20px;
    width: 240px;
}

#date {

    top: -45px;
     margin-left: 0!important;
    position: relative;
}

.title h1 {

   padding-left:83px!important;

}

.sidebar .widget_text .sidetitl {
    background: #9CD5EE;
}

#year {

    position: relative;
    top: 5px;
}


.sidebar .super_recent_posts h3 {
    background: url("<?=  base_url();?>/assets/css/user/images/ico1.png") no-repeat scroll 10px 5px  #9CD5EE;
    float: left;
    padding-left: 29px;
}

div.even .title {
    margin-top: 5px;
}

.sidebar .widget_text .sidetitl {
    background: url("<?=  base_url();?>/assets/css/user/images/dolar_ico.png") no-repeat scroll 10px 5px #9CD5EE!important;
    padding-left: 29px;
}

.squarebanner h3 {
    background: url("<?=  base_url();?>/assets/css/user/images/spons_ico.png") no-repeat scroll 10px 5px #9CD5EE;
    float: left;
    padding-left: 29px;
}

.sidebar #lct-widget-locations-container h3 {
background: url("<?=  base_url();?>/assets/css/user/images/location_ico.png") no-repeat scroll 10px 5px #9CD5EE;
    float: left;
    padding-left: 29px;
}

#toplogo {
    left:0px!important;
    top: 28px;
    width: 760px;
}

.orange_saperator {
    border: 1px solid #0E95D0;
    margin: 0 auto 8px 5px;
    width: 99.5%;
}

.botwid {

    width: 176px;
}


#taxonomy{
margin-left: 23px;
}

h3.sidetitl {
    width: 205px;
    margin-left:0px;
}

#search {
    margin: 50px 0 0 92px;
    position: relative;
    top: 20px;
    width: 253px;
}

#casing {
    background: none repeat scroll 0 0 #F4F4F4;
    margin-right: 0;
}

#navigation {
    letter-spacing: 0.1em!important;
    margin-bottom: 10px;
    margin-top:0;
}
.super_recent_posts_item b a
{
    font-size: 12.4px!important;
}
#navigation div{
margin-left: 70%!important;
}

.botcover {
    margin: 0 auto;
    width: 760px;
}

.header {
    margin: 0 auto;
    width: 760px!important;
}

.price_range_footer_right
{
margin-right:10px!important;
}
.refine_btn
{
margin-right:10px!important;
}

.tuts
{
margin-bottom:10px!important;

}
.size_div
{
    height:135px!important;
}

.img_div
{
    float: right!important;
    margin-top: 15px!important;
    margin-right: 5px!important;
}
.ui-slider
{
    width:220px!important;
}
         </style>';
                                            } else {
                                                $_SESSION['fb'] = "";
                                            }
                                            ?>
                                            <style>
                                            <?php
                                            if (isset($css)) {
                                                echo $css;
                                            }
                                            ?>
                                            </style>
                                            </head>

                                            <body class="home blog">

                                                <div id="masthead">
                                                    <div class="header">
                                                        <div id="top">
                                                            <div id="toplogo" <?php if (isset($main['0']->image)) if ($main['0']->image != "") { ?> style="background:url(<?php echo base_url() . $main['0']->image; ?>);background-size: cover !important;" <?php } ?>></div>
                                                        </div>
                                                        <div id="Header_content">
                                                            <li class="botwid widget_text">			
                                                                <div class="textwidget"></div>
                                                            </li>
                                                        </div>
                                                        <!--<div class="blogright">
                                                            <div class="menu-topmenu-container"><ul id="menu-topmenu" class="menu"><li id="menu-item-182" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-182"><a href=""<?= site_url() ?>/user/user/index"">Jobs</a></li>
                                                                <li id="menu-item-135" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-135"><a href="">About Us</a></li>
                                                                <li id="menu-item-134" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-134"><a href="">My Account</a></li>
                                                                <li id="menu-item-133" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-133"><a href="">Become A Member</a></li>
                                                                <li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-132"><a href="">Help</a></li>
                                                                </ul>
                                                            </div>
                                                            <div id="search">
                                                                            <div>
                                                                                <input id="s" name="s" value="search" onfocus="if (this.value=='search') this.value='';" onblur="if (this.value=='') this.value='search';" type="text">
                                                                                <input value="" id="searchsubmit" type="button">
                                                                            </div>
                                                                       
                                                            </div>
                                                        -->
                                                    </div>
                                                </div>
                                                </div>
                                                </div>

                                                <div id="wrapper">  <!-- wrapper begin -->
                                                    <div id="topbg"></div>
                                                    <div id="casing"> 
