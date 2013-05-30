<?php
/*
Plugin Name: Page Scroll to id
Plugin URI: http://manos.malihu.gr/animate-page-to-id-with-jquery
Description: Animated page scrolling to specific id within the document
Version: 1.2
Author: malihu
Author URI: http://manos.malihu.gr
License: GNU GENERAL PUBLIC LICENSE Version 3
*/

if(basename($_SERVER['SCRIPT_NAME'])==basename(__FILE__))exit(':)');

define('malihuPageScroll2id_url',plugin_dir_url(__FILE__));

function malihuPageScroll2id_setup(){
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery-effects-core");
	wp_register_script("jquery-malihu-PageScroll2id", malihuPageScroll2id_url."jquery.malihu.PageScroll2id.js",array("jquery","jquery-effects-core"), "1.2",1);
	wp_enqueue_script("jquery-malihu-PageScroll2id");
	wp_register_script("jquery-malihu-PageScroll2id-init", malihuPageScroll2id_url."jquery.malihu.PageScroll2id-init.js",array("jquery","jquery-effects-core","jquery-malihu-PageScroll2id"), "1.2",1);
	wp_enqueue_script("jquery-malihu-PageScroll2id-init");
}

//defaults
define('malihuPageScroll2id_sel_default', "a[rel='m_PageScroll2id']"); 
define('malihuPageScroll2id_scrollSpeed_default', '1300');
define('malihuPageScroll2id_autoScrollSpeed_default', 'true');
define('malihuPageScroll2id_scrollEasing_default', 'easeInOutExpo');
define('malihuPageScroll2id_scrollingEasing_default', 'easeInOutCirc');
define('malihuPageScroll2id_pageEndSmoothScroll_default', 'true');
define('malihuPageScroll2id_layout_default', 'vertical');

function malihuPageScroll2id_call(){
	$sel_opt=get_option('malihu_pagescroll2id_sel');
	if($sel_opt==''){
		$sel_opt=malihuPageScroll2id_sel_default;
	}
	$scrollSpeed_opt=get_option('malihu_pagescroll2id_scrollSpeed');
	if($scrollSpeed_opt==''){
		$scrollSpeed_opt=malihuPageScroll2id_scrollSpeed_default;
	}
	$autoScrollSpeed_opt=get_option('malihu_pagescroll2id_autoScrollSpeed');
	if($autoScrollSpeed_opt==''){
		$autoScrollSpeed_opt=malihuPageScroll2id_autoScrollSpeed_default;
	}
	$scrollEasing_opt=get_option('malihu_pagescroll2id_scrollEasing');
	if($scrollEasing_opt==''){
		$scrollEasing_opt=malihuPageScroll2id_scrollEasing_default;
	}
	$scrollingEasing_opt=get_option('malihu_pagescroll2id_scrollingEasing');
	if($scrollingEasing_opt==''){
		$scrollingEasing_opt=malihuPageScroll2id_scrollingEasing_default;
	}
	$pageEndSmoothScroll_opt=get_option('malihu_pagescroll2id_pageEndSmoothScroll');
	if($pageEndSmoothScroll_opt==''){
		$pageEndSmoothScroll_opt=malihuPageScroll2id_pageEndSmoothScroll_default;
	}
	$layout_opt=get_option('malihu_pagescroll2id_layout');
	if($layout_opt==''){
		$layout_opt=malihuPageScroll2id_layout_default;
	}
	$params = array(
  		"sel" => $sel_opt, //selector
		"scrollSpeed" => $scrollSpeed_opt, //scrollSpeed
		"autoScrollSpeed" => $autoScrollSpeed_opt, //auto-adjust scrollSpeed
		"scrollEasing" => $scrollEasing_opt, //scrollEasing idle
		"scrollingEasing" => $scrollingEasing_opt, //scrollEasing scrolling
		"pageEndSmoothScroll" => $pageEndSmoothScroll_opt, //end of page smooth scrolling
		"layout" => $layout_opt, //page layout - scrolling direction
	);
	wp_localize_script( 'jquery-malihu-PageScroll2id-init', 'malihuPageScroll2idInitParams', $params );
}

add_action('wp_enqueue_scripts', 'malihuPageScroll2id_setup');
add_action('wp_footer', 'malihuPageScroll2id_call');

//admin settings

//add options
add_option(malihu_pagescroll2id_sel, malihuPageScroll2id_sel_default);
add_option(malihu_pagescroll2id_scrollSpeed, malihuPageScroll2id_scrollSpeed_default);
add_option(malihu_pagescroll2id_scrollSpeed, malihuPageScroll2id_autoScrollSpeed_default);
add_option(malihu_pagescroll2id_scrollEasing, malihuPageScroll2id_scrollEasing_default);
add_option(malihu_pagescroll2id_scrollingEasing, malihuPageScroll2id_scrollingEasing_default);
add_option(malihu_pagescroll2id_pageEndSmoothScroll, malihuPageScroll2id_pageEndSmoothScroll_default);
add_option(malihu_pagescroll2id_layout, malihuPageScroll2id_layout_default);

//create plugin settings menu
add_action('admin_menu', 'malihuPageScroll2id_create_menu');

function malihuPageScroll2id_create_menu(){
	//create new sub-level menu
	add_submenu_page('options-general.php','Page Scroll to id Plugin Settings','Page Scroll to id','administrator', __FILE__,'malihuPageScroll2id_settings_page');
	//call register settings function
	add_action('admin_init','malihuPageScroll2id_register_settings');
}

function malihuPageScroll2id_register_settings(){
	//register settings
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_sel');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_scrollSpeed');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_autoScrollSpeed');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_scrollEasing');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_scrollingEasing');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_pageEndSmoothScroll');
	register_setting('malihuPageScroll2id-settings-group','malihu_pagescroll2id_layout');
}

function malihuPageScroll2id_settings_page(){
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32">
		<br/>
	</div>
	<h2>Page Scroll to id Plugin Settings</h2>
	<h3>Default Settings</h3>
	<form method="post" action="options.php">
    	<?php settings_fields('malihuPageScroll2id-settings-group'); ?>
    	<table class="form-table">
        	<tr valign="top">
        		<th scope="row">Selector(s)</th>
        		<td>
					<?php if(get_option('malihu_pagescroll2id_sel')!=''){ ?>
        				<input type="text" name="malihu_pagescroll2id_sel" value="<?php echo get_option('malihu_pagescroll2id_sel'); ?>" class="regular-text" />
         			<?php }else{ ?>
          				<input type="text" name="malihu_pagescroll2id_sel" value="<?php echo malihuPageScroll2id_sel_default; ?>" class="regular-text" />
            		<?php } ?>
					<span class="description">The link(s) that will scroll the page when clicked. You can use any <a href="http://www.w3.org/TR/2001/CR-css3-selectors-20011113/" target="_blank">css selector</a>. <br />By default, the plugin is applied to all anchor elements with "m_PageScroll2id" rel attribute value. You can have multiple selectors by separating them with comma (e.g. a[rel='m_PageScroll2id'], a[href='#top']). <br />  
					<b>Some selector examples</b> <br />
					<code style="font-style:normal;">a[href*='#']</code> - All anchors that contain a hash (#) in their href attribute <br />
					<code style="font-style:normal;">a[href='#top']</code> - All anchors with "#top" href attribute value <br />
					<code style="font-style:normal;">a.className</code> - All anchors with a class of "className"</span>
				</td>
        	</tr>
	     	<tr valign="top">
        		<th scope="row">Scroll animation speed</th>
				<td>
        			<?php if(get_option('malihu_pagescroll2id_scrollSpeed')!=''){ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollSpeed" value="<?php echo get_option('malihu_pagescroll2id_scrollSpeed'); ?>" class="regular-text" />
        			<?php }else{ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollSpeed" value="<?php echo malihuPageScroll2id_scrollSpeed_default; ?>" class="regular-text" />
         			<?php } ?>
					<span class="description">Value in milliseconds (1000 milliseconds = 1 second)</span>
				</td>
        	</tr>
			<tr valign="top">
        		<th scope="row">&nbsp;</th>
				<td>
					<input type="hidden" name="malihu_pagescroll2id_autoScrollSpeed" value="false" />
        			<?php if(get_option('malihu_pagescroll2id_autoScrollSpeed')!=''){ ?>
        				<?php if(get_option('malihu_pagescroll2id_autoScrollSpeed')==malihuPageScroll2id_autoScrollSpeed_default){ ?>
							<input type="checkbox" name="malihu_pagescroll2id_autoScrollSpeed" value="<?php echo malihuPageScroll2id_autoScrollSpeed_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_autoScrollSpeed_1" checked="yes" /> 
						<?php }else{ ?>
							<input type="checkbox" name="malihu_pagescroll2id_autoScrollSpeed" value="<?php echo malihuPageScroll2id_autoScrollSpeed_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_autoScrollSpeed_1" /> 
						<?php } ?>
        			<?php }else{ ?>
						<input type="checkbox" name="malihu_pagescroll2id_autoScrollSpeed" value="<?php echo malihuPageScroll2id_autoScrollSpeed_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_autoScrollSpeed_1" checked="yes" /> 
        			<?php } ?>
					<label for="malihu_pagescroll2id_autoScrollSpeed_1">Auto-adjust animation speed</label>  <br />
					<span class="description">Adjusts scroll animation speed according to element position within page. <br />Enabled by default</span>
				</td>
        	</tr>
        	<tr valign="top">
        		<th scope="row">Scroll animation easing</th>
				<td>
        			<?php if(get_option('malihu_pagescroll2id_scrollEasing')!=''){ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollEasing" value="<?php echo get_option('malihu_pagescroll2id_scrollEasing'); ?>" class="regular-text" />
        			<?php }else{ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollEasing" value="<?php echo malihuPageScroll2id_scrollEasing_default; ?>" class="regular-text" />
        			<?php } ?>
					<span class="description">Standard animation easing when page is idle <br />
					<a href="http://www.w3.org/TR/2001/CR-css3-selectors-20011113/" target="_blank">Available values via jQuery UI</a></span>
				</td>
        	</tr>
        	<tr valign="top">
        		<th scope="row">Scrolling animation easing</th>
				<td>
        			<?php if(get_option('malihu_pagescroll2id_scrollingEasing')!=''){ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollingEasing" value="<?php echo get_option('malihu_pagescroll2id_scrollingEasing'); ?>" class="regular-text" />
        			<?php }else{ ?>
        				<input type="text" name="malihu_pagescroll2id_scrollingEasing" value="<?php echo malihuPageScroll2id_scrollingEasing_default; ?>" class="regular-text" />
        			<?php } ?>
					<span class="description">Alternative animation easing while page is animated</span>
				</td>
        	</tr>
			<tr valign="top">
        		<th scope="row">&nbsp;</th>
				<td>
					<input type="hidden" name="malihu_pagescroll2id_pageEndSmoothScroll" value="false" />
        			<?php if(get_option('malihu_pagescroll2id_pageEndSmoothScroll')!=''){ ?>
        				<?php if(get_option('malihu_pagescroll2id_pageEndSmoothScroll')==malihuPageScroll2id_pageEndSmoothScroll_default){ ?>
							<input type="checkbox" name="malihu_pagescroll2id_pageEndSmoothScroll" value="<?php echo malihuPageScroll2id_pageEndSmoothScroll_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_pageEndSmoothScroll_1" checked="yes" /> 
						<?php }else{ ?>
							<input type="checkbox" name="malihu_pagescroll2id_pageEndSmoothScroll" value="<?php echo malihuPageScroll2id_pageEndSmoothScroll_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_pageEndSmoothScroll_1" /> 
						<?php } ?>
        			<?php }else{ ?>
						<input type="checkbox" name="malihu_pagescroll2id_pageEndSmoothScroll" value="<?php echo malihuPageScroll2id_pageEndSmoothScroll_default; ?>" style="vertical-align:middle;" id="malihu_pagescroll2id_pageEndSmoothScroll_1" checked="yes" /> 
        			<?php } ?>
					<label for="malihu_pagescroll2id_pageEndSmoothScroll_1">End of page smooth scrolling</label>  <br />
					<span class="description">If page-bottom elements are shorter than the viewport, the page will scroll at the bottom of the document to avoid breaking scroll animation. <br />Enabled by default</span>
				</td>
        	</tr>
			<tr valign="top">
        		<th scope="row">Layout</th>
				<td>
        			<select name="malihu_pagescroll2id_layout" id="malihu_pagescroll2id_layout_1">
					<?php if(get_option('malihu_pagescroll2id_layout')!=''){ ?>
        				<?php if(get_option('malihu_pagescroll2id_layout')==malihuPageScroll2id_layout_default){ ?>
							<option value="<?php echo malihuPageScroll2id_layout_default; ?>" selected="selected">Vertical</option>
						<?php }else{ ?>
							<option value="<?php echo malihuPageScroll2id_layout_default; ?>">Vertical</option>
						<?php } ?>
						<?php if(get_option('malihu_pagescroll2id_layout')=='horizontal'){ ?>
							<option value="horizontal" selected="selected">Horizontal</option>
						<?php }else{ ?>
							<option value="horizontal">Horizontal</option>
						<?php } ?>
						<?php if(get_option('malihu_pagescroll2id_layout')=='auto'){ ?>
							<option value="auto" selected="selected">Auto</option>
						<?php }else{ ?>
							<option value="auto">Auto</option>
						<?php } ?>
        			<?php }else{ ?>
						<option value="<?php echo malihuPageScroll2id_layout_default; ?>" selected="selected">Vertical</option>
						<option value="horizontal">Horizontal</option>
						<option value="auto">Auto</option>
        			<?php } ?>
					</select>
					<span class="description">Page layout defines scrolling direction. <br />
					"Vertical" and "Horizontal" values restrict page scrolling to vertical (top-bottom) or horizontal (left-right) axis accordingly. To unrestrict page scrolling and enable the plugin to animate page both vertically and horizontally, select "Auto". <br />
					By default, scrolling is restricted to vertical, as it is the standard and most common layout.</span>
				</td>
        	</tr>
    	</table>
    	<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	<h3>Usage</h3>
	<p>Out-of-the-box, the plugin is applied to every link with <em>m_PageScroll2id</em> rel attribute value: <code>&lt;a href="#targetID" rel="m_PageScroll2id"&gt;link&lt;/a&gt;</code>. Clicking the link, the page will scroll to the element with <code>id="targetID"</code> within the document.</p> 
	<p>To start using the plugin in your theme, simply add <code>rel="m_PageScroll2id"</code> to any anchor element (&lt;a /&gt;) in your markup and give it an href value of the id you wanna scroll to within the page (e.g. <code>href="#targetID"</code>), assuming of course that an element with such id does exist in your document.</p> 
	<p>By changing the <em>selector</em> value in settings, you can apply the script to any other type of anchor you want (useful if you don't wanna edit your theme's markup). You can also have multiple selectors by inserting comma separated values (e.g. <code>a[rel='m_PageScroll2id'], a[href='#top']</code>).</p>
	<h3>Info</h3>
	<p>Plugin author: <a href="http://manos.malihu.gr" target="_blank">malihu</a> <br />
	Plugin home: <a href="http://manos.malihu.gr/animate-page-to-id-with-jquery" target="_blank">http://manos.malihu.gr/animate-page-to-id-with-jquery</a></p>
	<p>This plugin, as with everything I publish on my <a href="http://manos.malihu.gr" target="_blank">blog</a>, is completely free for personal and commercial use. <br />
	If you feel like it, you can make a donation by clicking the button below. I greatly appreciate your support to continue updating, developing and sharing cool stuff.</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="UYJ5G65M6ZA28">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>
<?php 
} 
?>