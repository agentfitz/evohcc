<?php

// theme admin setup **********************
$themename = "Evohcc";
$shortname = "evo";

$categories = get_categories('hide_empty=0&orderby=name');  
$wp_cats = array();  
foreach ($categories as $category_list ) {  
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
}
array_unshift($wp_cats, "Choose a category");
	
$options = array (

array( "name" => $themename." Options",
	"type" => "title"),

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Colour Scheme",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("blue", "red", "green"),
	"std" => "blue"),

array( "name" => "Logo URL",
	"desc" => "Enter the link to your logo image",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),

array( "name" => "Search Label",
	"desc" => "Enter the search form label",
	"id" => $shortname."_search_label",
	"type" => "text",
	"std" => ""),

array( "name" => "Extra Header Text",
	"desc" => "Enter the additional text you would like to see in the header",
	"id" => $shortname."_extra_hdr_text",
	"type" => "text",
	"std" => ""),

array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),		

array( "type" => "close"),
array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Homepage header image",
	"desc" => "Enter the link to an image used for the homepage header.",
	"id" => $shortname."_header_img",
	"type" => "text",
	"std" => ""),

array( "name" => "Homepage featured category",
	"desc" => "Choose a category from which featured posts are drawn",
	"id" => $shortname."_feat_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),

array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => ""),

array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	

array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

array( "type" => "close")

);


function mytheme_add_admin() {

	global $themename, $shortname, $options;
	
	if( $_GET['page'] == basename(__FILE__) ){
	
		if( 'save' == $_REQUEST['action'] ){
	
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
				
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ){
						update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				}
				else { 
					delete_option( $value['id'] );
				}
			}
			header("Location: admin.php?page=functions.php&saved=true");
			die;	
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] );
			}	
			header("Location: admin.php?page=functions.php&reset=true");
			die;	
		}
	}

	add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {
	$file_dir = get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
	wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");
}






function mytheme_admin() {

	global $themename, $shortname, $options;
	$i=0;

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap rm_wrap">
	<h2><?php echo $themename; ?> Settings</h2>
	<div class="rm_opts">
	<form method="post">
		<?php foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "open":
		?>		
		<?php break;
		case "close":
		?>
	</div>
</div>
<br />

<?php
	break;
	case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

<?php
	break;
	case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
	break;
	case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
	break;
	case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $option) { ?>
			<option
				<?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
				<?php echo $option; ?>
			</option>
		<?php } ?>
	</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
	break;
	case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
 </div>

<?php 
	break;
	case "section":
	$i++;
?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

<?php 
	break;
	}
}
?>

<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
 </div> 

<?php }
	add_action('admin_init', 'mytheme_add_init');
	add_action('admin_menu', 'mytheme_add_admin');

// ****************************************

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'evohcc', TEMPLATEPATH . '/languages' );
 
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
 
// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

// register nav menus
register_nav_menus( array(
	'primary' => 'Primary Menu',
	'secondary' => 'Secondary Menu'
));

function get_custom_field($key, $echo = FALSE) {
	global $post;
	$custom_field = get_post_meta($post->ID, $key, true);
	if ($echo == FALSE) return $custom_field;
	echo $custom_field;
}

add_action( 'init', 'register_events_type' );
function register_events_type() {
	$labels = array(
		'name' => _x( 'events', 'events' ),
		'singular_name' => _x( 'event', 'events' ),
		'add_new' => _x( 'Add New', 'events' ),
		'add_new_item' => _x( 'Add New Event', 'events' ),
		'edit_item' => _x( 'Edit Event', 'events' ),
		'new_item' => _x( 'New Event', 'events' ),
		'view_item' => _x( 'View Event', 'events' ),
		'search_items' => _x( 'Search Events', 'events' ),
		'not_found' => _x( 'No events found', 'events' ),
		'not_found_in_trash' => _x( 'No events found in Trash', 'events' ),
		'parent_item_colon' => _x( 'Parent Event:', 'events' ),
		'menu_name' => _x( 'Events', 'events' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);
	register_post_type('events', $args);
}


// modify WordPress default search query to include custom post type results
add_filter( 'pre_get_posts', 'search_all' );
function search_all( $query ) {
    if($query->is_search){
    	$query->set( 'post_type', array( 'post', 'page', 'events' ) );
    }
    return $query;
};

add_filter( 'request', 'handle_blank_search' );
function handle_blank_search( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}

?>