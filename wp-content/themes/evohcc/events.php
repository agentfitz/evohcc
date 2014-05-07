<?php
/*
Template Name: Events
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>     
		<?php the_content(); ?>            
	<?php endwhile; ?>
<?php endif; ?>


<script>
	// for some reason wp is not adding the current-menu-item class to the speaking engagements link in the sidebar
	// so I'm using jquery for this simple workaround
	$(function(){
		$("body#speaking-engagements a:contains('Speaking Engagements')").parent().addClass("current-menu-item");
	});
</script>


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$event_args = array( 
	'post_type' => 'events',
	'orderby' => 'meta_value',
	'order' => 'desc',
	'meta_key' => 'event_date',
	'posts_per_page' => 10,
	'paged' => $paged
) ?>
<?php 
	$temp = $wp_query;  // assign orginal query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($event_args);
?>

<ul>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="event">
				<h2 class="organization-hdr"><?php get_custom_field('organization', true); ?></h2>
				<ul class="event-info">
					<li>
						<h3>
							<?php 
								$event_date_str = get_custom_field('event_date', false);
								$event_date_time = strtotime($event_date_str);
								echo date("m/d/Y", $event_date_time);
								echo ", "; 
								the_title();
							?>
						</h3>
					</li>
					<li>
						<span class="quote"><?php get_custom_field('presentation_topic', true) ?></span>
					</li>
					<?php if(get_custom_field('presentation_topic2', false) != ''){ ?>
					<li>
						<span class="quote"><?php get_custom_field('presentation_topic2', true) ?></span>
					</li>
					<?php } ?>
					<?php if(get_custom_field('organization_website', false) != ''){ ?>
					<li>
						<span class="website"><a href="<?php get_custom_field('organization_website', true) ?>" target="_blank"><?php get_custom_field('organization_website', true) ?></a></span>
					</li>
					<?php } ?>
				</ul>
		</div>        
	<?php endwhile; ?>
	
<?php endif; ?>
</ul>
	
<?php /* Bottom post navigation */ ?>
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
	<div id="pager-container" class="navigation">
		<div class="pager nav-previous"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> older events' ) ?></div>
		<div class="pager nav-next"><?php previous_posts_link( 'newer events <span class="meta-nav">&raquo;</span>') ?></div>
	</div><!-- #nav-below -->
<?php } ?>


<?php get_footer(); ?>