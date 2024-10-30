<?php

/*
Plugin Name: Latest Post Accordian Slider
Plugin URI: http://techysport.com
Description: Best Accordian Slider for displaying latest posts in wordpress.
Version: 1.3
Author: Anop Goswami
Author URI: http://techysport.com
License: GPLv2
*/


// defining constants

define('RELPATH', dirname(__FILE__));


//including slider function

include('includes/function.php');


//registering hooks

register_activation_hook(__FILE__, 'lpaccordian_install');
register_deactivation_hook(__FILE__, 'lpaccordian_remove');


//adding styles and javascript

add_action('wp_enqueue_scripts', 'lpaccordian_add_scripts');
add_action('wp_enqueue_scripts', 'lpaccordian_add_style');


function lpaccordian_install() {
    add_option('lpa_postlimit',6);
	add_option('lpa_speed',1000);
	add_option('lpa_width',940);
	add_option('lpa_height',300);
	add_option('lpa_content_length',200);
	add_option('lpa_autocollapse',0);
}

function lpaccordian_remove() {
    delete_option('lpa_postlimit');
	delete_option('lpa_speed');
	delete_option('lpa_width');
	delete_option('lpa_height');
	delete_option('lpa_content_length');
	delete_option('lpa_autocollapse');
}

function lpaccordian_add_scripts() {
	
    wp_enqueue_script('jscript1',plugins_url( 'js/jquery.min.js' , __FILE__ ));
	wp_enqueue_script('jscript2',plugins_url( 'js/jquery.lpaccordion.js' , __FILE__ ));
	wp_enqueue_script('jscript3',plugins_url( 'js/jquery.animation.easing.js' , __FILE__ ));
}

function lpaccordian_add_style() {
	
    wp_enqueue_style('style1',plugins_url( 'css/lpaccordion.css' , __FILE__ ));
	wp_enqueue_style('style2',plugins_url( 'css/style.css' , __FILE__ ));
	
}

// adding shortcode

add_shortcode( 'lpa', 'lpaccordian_active' );








/*----------------------Admin Area----------------------------------- */


if (is_admin()) {
	

	
//Creating admin menu
	
add_action('admin_menu', 'lpaccordian_admin_menu');


function lpaccordian_admin_menu() 
{
	add_options_page('LPA', 'LPA', 'administrator',
					 'lpaccordian', 'lpaccordian_admin_page');
}


//Updating option
	
if(isset($_POST['submit']))
{
	update_option('lpa_postlimit',$_POST['lpa_postlimit']);
	update_option('lpa_speed',$_POST['lpa_speed']);
	update_option('lpa_width',$_POST['lpa_width']);
	update_option('lpa_height',$_POST['lpa_height']);
	update_option('lpa_content_length',$_POST['lpa_content_length']);
	update_option('lpa_autocollapse',$_POST['lpa_autocollapse']);
}
	

	function lpaccordian_admin_page()
	 {
		 
?>
  
<div class="wrap">
<h2>Latest Post Accordian Slider Setting</h2>

<form method="post" action="#">

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Post Limit</th>
        <td><input name="lpa_postlimit" type="text" id="lpa_postlimit" value="<?php echo get_option('lpa_postlimit'); ?>" /></td>
        </tr>  
        
        <tr valign="top">
        <th scope="row">Slider Speed</th>
        <td><input name="lpa_speed" type="text" id="lpa_speed" value="<?php echo get_option('lpa_speed'); ?>" /></td>
        </tr>   
        
        <tr valign="top">
        <th scope="row">Slider Width</th>
        <td><input name="lpa_width" type="text" id="lpa_width" value="<?php echo get_option('lpa_width'); ?>" /></td>
        </tr>   
        
        <tr valign="top">
        <th scope="row">Slider Height</th>
        <td><input name="lpa_height" type="text" id="lpa_height" value="<?php echo get_option('lpa_height'); ?>" /></td>
        </tr>   
       
        <tr valign="top">
        <th scope="row">Content Length</th>
        <td><input name="lpa_content_length" type="text" id="lpa_content_length" value="<?php echo get_option('lpa_content_length'); ?>" /></td>
        </tr> 
        
         <tr valign="top">
        <th scope="row">Auto Collapse</th>
        <td><select name="lpa_autocollapse" id="lpa_autocollapse">
        <option value="0" <?php if(get_option('lpa_autocollapse')==0){ echo'selected="selected"';} ?> >No</option>
        <option value="1" <?php if(get_option('lpa_autocollapse')==1){ echo'selected="selected"';} ?> >Yes</option>
        </select></td>
        </tr>
          
              
    </table>
    
    <?php submit_button(); ?>

</form>
</div>

<?php  } } ?>
