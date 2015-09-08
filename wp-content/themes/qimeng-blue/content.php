<?php if ( have_posts() ) : ?>
	<ul class="article-list">
<?php while( have_posts() ) : the_post(); ?>
    	<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-m-d'); ?></time></li>
<?php endwhile; ?>
	</ul>
	<?php hui_pageNavigation(10); ?>
<?php else : ?>
<?php endif; wp_reset_query(); ?>