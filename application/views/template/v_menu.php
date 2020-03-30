<?php if ( isset($_SESSION['ROL']) && $_SESSION['ROL'] != 3){ ?>

    <body themebg-pattern="theme1">

<div class="loader-bg" style="display: none;">
    <div class="loader-bar"></div>
  </div>

  <div id="pcoded" class="pcoded iscollapsed" nav-type="st2" theme-layout="vertical" vertical-placement="left" vertical-layout="wide" pcoded-device-type="tablet" vertical-nav-type="offcanvas" vertical-effect="overlay" vnavigation-view="view1" fream-type="theme1" layout-type="light">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <nav class="navbar header-navbar pcoded-header iscollapsed" header-theme="theme6" pcoded-header-position="fixed">
        <div class="navbar-wrapper">
          <div class="navbar-logo" logo-theme="theme6">
          <img class="img-fluid" src="<?php echo base_url();?>html/img/klu.png" height = "50px" width = "50px" alt="Theme-Logo">
            <a href="#" style="margin-left:10px;padding-top:5px;">
              <h3><?php echo $this->config->item('title'); ?> </h3>
            </a>          
            <a class="mobile-options waves-effect waves-light">
              <i class="feather icon-more-horizontal"></i>
           </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-left">  </ul>
            <ul class="nav-right">
              <div style="color:#fff;box-sizing:border-box;padding-top:25px;padding-right:5px;">
                <?php if(isset($_SESSION['ADMIN']) && $_SESSION['ADMIN'] == 1){?>
                <a class="mobile-menu" id="mobile-collapse" href="<?php echo base_url();?>AddManager/Back">
                    <i class="fa fa-exchange"></i>
                </a>
                <?php } ?>
                <span><?php echo ucfirst($_SESSION['ADI']); ?></span>
                <a class="mobile-menu" id="mobile-collapse" href="<?php echo base_url();?>Logout">
                  <i class="feather  icon-log-out"></i>
                </a>
              </div>
            </ul>
          </div>
    </div></nav>



<?php } else { ?> 

 

    <body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">    
                    <div class="navbar-logo">
                        <a href="#">
                            <h3><?php echo $this->config->item('title'); ?> </h3>
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo ucfirst($_SESSION['ADI']);?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?php echo base_url(); ?>Logout">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="slimScrollDiv">
                                <div class="pcoded-inner-navbar main-menu" >
                                    <div class="pcoded-navigation-label">Navigation</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu active pcoded-trigger">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Personel İslemleri</span>   
                                            </a>                    
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="<?php echo base_url(); ?>AddManager" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Personel Ekle</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="<?php echo base_url(); ?>Manager" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Personelleri Gör</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>                       
                                    </ul>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu active pcoded-trigger">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Drive İslemleri</span>   
                                            </a>                    
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="<?php echo base_url(); ?>PersonalDrive/AdmintoDrive" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Drive Git</span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                        
                                    </ul>
                               </div>
                            </div>
                        </div>
                    </nav>
                    <!-- Content -->





<?php } ?>