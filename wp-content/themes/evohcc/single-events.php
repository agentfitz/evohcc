<?php get_header(); ?>
   
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
	<div class="moreEventsContainer">
		<a href="/speaking-engagements">[see additional speaking engagements]</a>
	</div>
	  

<?php get_footer(); ?>