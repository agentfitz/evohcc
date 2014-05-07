<?php
/*
Template Name: Resources
*/
?>

<?php get_header(); ?>
<h1>Evolution Healthcare Consulting is pleased to offer the Web resources for your convenience:</h1>
<ul id="resources">
	<?php wp_list_bookmarks( $args ); ?>
</ul>

<?php get_footer(); ?>