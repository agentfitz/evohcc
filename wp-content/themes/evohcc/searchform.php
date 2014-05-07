<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
    		<label class="screen-reader-text" for="s"><?php echo get_option("evo_search_label"); ?></label>
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>