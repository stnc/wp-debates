<?php
function tvsDebate_configuration_content(){


    if ( ! current_user_can( 'manage_options' ) ) {
        return;
      }

      //Get the active tab from the $_GET param
      $default_tab = null;
      $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
    
      ?>
      <!-- Our admin page content should all be inside .wrap -->
      <div class="wrap">
        <!-- Print the page title -->
        <h1>Setting <?php //echo esc_html( get_admin_page_title() ); ?></h1>
        <!-- Here are our tabs -->
        <nav class="nav-tab-wrapper">
          <a href="?post_type=debate&page=tvsDebateSetting" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Settings</a>
          <a href="?post_type=debate&page=tvsDebateSetting&tab=sdp" class="nav-tab <?php if($tab==='sdp'):?>nav-tab-active<?php endif; ?>">Single Debate Page Setting</a>
          <a href="?post_type=debate&page=tvsDebateSetting&tab=other" class="nav-tab <?php if($tab==='other'):?>nav-tab-active<?php endif; ?>">Other Setting</a>
        </nav>
        <div class="tab-content">
        <?php switch($tab) :
          case 'sdp':
            tvsDebate_config_spdtab();
            break;
          case 'other':
            stncWpKiosk_config_Other();
            break;
          default:
          tvsDebate_config_common(); 
            break;
        endswitch; ?>
        </div>
      </div>
    <?php
}
require ('common_tab.php'); 
require ('singleDebate_tab.php'); 
require ('other_tab.php'); 