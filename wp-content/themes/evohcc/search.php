<?php get_header(); ?>
   
<?php if(have_posts()):?>
<h1>We found a few things that you might find of interest:</h1>
<ul id="entryList">
<?php while(have_posts()) : the_post() ?>
	<li>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	</li>
<?php endwhile; ?>
</ul>

<?php else: ?>

	<h1>Uh-oh!  We couldn't find anything based on your search criteria.</h1>

<?php endif; ?>

<?php get_footer(); ?>