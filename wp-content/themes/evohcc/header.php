<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Evohcc
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title>
	<?php
		if ( is_single() ) { single_post_title(); }
		elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
		elseif ( is_page() ) { single_post_title(''); }
		elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
		elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
		else { bloginfo('name'); wp_title('|'); get_page_number(); }
 	?> 
	</title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>">	
	<?php wp_head(); ?>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
</head><?php /*echo strtolower(trim(wp_title('', false))); */?>
<?php 
	global $wp_query;	
	$post_id = $wp_query->get_queried_object_id();
	$post = get_post($post_id);
	$body_id = $post->post_name;
?>
<body id="<?php echo $body_id ?>">
<div id="outerheader">
	<div id="innerheader">
		<a href="<?php bloginfo('url'); ?>"><img src="/wp-content/themes/evohcc/images/evo_logo4.png" id="evologo" alt="Evolution Healthcare Logo"></a>
		<h2 id="siteName"><?php bloginfo('name'); ?></h2>
		<p id="extraHdrText"><?php echo get_option("evo_extra_hdr_text"); ?></p>
	</div>
</div>
<div id="outermasthead">
	<div id="innermasthead">
		<div id="mastheadimage">
			<img src="<?php echo '/wp-content/themes/evohcc/images/' . $body_id . '.jpg' ?>" alt="Evolution Healthcare Consulting Header Image">
		</div>
	</div>
</div>

<div id="outernav">
	<div id="navcontainer">
		<div id="nav">
			<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</div><!-- close nav -->
	</div><!-- close navcontainer -->
</div><!-- close outernav -->

<div id="maincontentouter">
	<div id="maincontentinner">
 		<div id="maincontent">