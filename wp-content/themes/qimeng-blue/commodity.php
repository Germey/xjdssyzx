<?php if ( have_posts() ) : ?>
	<ul class="commodity-list">
<?php 
$args = array(
		'showposts' => 40,
		'post_status' => 'publish',
		'cat' => $cat,
		'post__not_in' => get_option('sticky_posts'),
	);
$recent = new WP_Query($args);
while( $recent->have_posts() ) : $recent->the_post(); ?>
		<li>
		<?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(150,150) ); ?></a>
		<?php elseif(catch_that_image() ) : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" width="150" height="150" /></a>
		<?php else : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/default-thumbnail.gif" alt="暂无文章缩略图" width="150" height="150" /></a>
        <?php endif; ?>
			<h2<?php if( is_sticky() ) echo ' class="sticky"'; ?>><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo mb_strimwidth(the_title_attribute('echo=0'), 0, 42, ''); ?></a></h2>
        </li>
<?php endwhile; ?>
	</ul>
	<?php hui_pageNavigation(10); ?>
<?php else : ?>
<?php endif; wp_reset_query(); ?>