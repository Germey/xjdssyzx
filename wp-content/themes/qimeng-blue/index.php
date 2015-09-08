<?php get_header(); ?>
<?php
	function article_list($value,$showposts,$word,$width,$height,$count) {
	$cat_ID = get_cat_ID(get_option($value) );
	$args = array(
		'category__in' => $cat_ID,
		'showposts' => $showposts,
		'post_status' => 'publish',
		'post__not_in' => get_option('sticky_posts'),
	);
	$recent = new WP_Query($args);
	while ( $recent->have_posts() ) : $recent->the_post(); ?>
    <li>
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array($width,$height) ); ?></a>
        <?php elseif(catch_that_image() ) : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
		<?php else : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/default-thumbnail.gif" alt="暂无文章缩略图" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
        <?php endif; ?>
        <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo mb_strimwidth(the_title_attribute('echo=0'), 0, $count, '...'); ?></a></h2>
        <p><?php echo hui_excerpt($word); ?><span class="detailed"><a href="<?php the_permalink(); ?>">详细&raquo;</a></span></p>
    </li>
<?php endwhile; } ?>
<?php
function list_title($list_cat_name,$default_name) {
	$title = $default_name;
	if(get_option($list_cat_name) ) { 
		$title = get_option($list_cat_name);
	} 
	$list_cat_ID = get_cat_ID(get_option($list_cat_name));
	$cat_url = get_category_link( $list_cat_ID );
	if($title == $default_name) {
		echo $title;
	} else {
		echo '<a href="' . $cat_url . '">'. $title . '</a><span><a href="' . $cat_url . '">更多&raquo;</a></span>';
	}
}
function cmsList($list_cat_name,$hCount,$lCount,$word) {
	$list_cat_ID = get_cat_ID(get_option($list_cat_name));
	$first_args = array(
		'category__in' => $list_cat_ID,
		'showposts' => 1,
		'post_status' => 'publish',
	);
	$first_post = new WP_Query($first_args);
	while ( $first_post->have_posts() ) : $first_post->the_post(); ?>
    <header>
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(95,95) ); ?></a>
		<?php elseif(catch_that_image() ) : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" width="96" height="96" /></a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/default-thumbnail.gif" alt="暂无文章缩略 width="96" height="96" /></a>
        <?php endif; ?>
        <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo mb_strimwidth(the_title_attribute('echo=0'), 0, $hCount, '...'); ?></a></h2>
        <p><?php echo hui_excerpt($word); ?><span class="detailed"><a href="<?php the_permalink(); ?>">详细&raquo;</a></span></p>
	</header>
<?php endwhile; 
	$args = array(
		'category__in' => $list_cat_ID,
		'showposts' => 5,
		'post_status' => 'publish',
		'offset' => 1,
		'post__not_in' => get_option('sticky_posts'),
	);
	$recent = new WP_Query($args);
	echo '<ul>';
	 while ( $recent->have_posts() ) : $recent->the_post(); ?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo mb_strimwidth(the_title_attribute('echo=0'), 0, $lCount, '...'); ?></a><time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('Y-m-d'); ?></time></li>
<?php endwhile; 
	echo '</ul>';
}
?>
<aside id="slides">
	<ul>
	<?php
	if( get_option('hui_slides_pic')) {
		$pic_group = explode(',', get_option('hui_slides_pic'));
		$url_group = explode(',', get_option('hui_slides_url'));	
		$slides_num = 0;
		foreach ($pic_group as $pic) {
			if($pic) {
				$url = $url_group[$slides_num];
				echo '<li><a href="' . $url . '"><img src="' . $pic . '" alt="' . get_bloginfo("name") . '幻灯片" width="960" height="230" /></a></li>';
				$slides_num++;
			}
		}
	} else {
		echo '<li><img src="' . get_bloginfo('template_url') . '/images/banner1.png" alt="' . get_bloginfo("name") . '幻灯片" width="960" height="230" /></li>';
		echo '<li><img src="' . get_bloginfo('template_url') . '/images/banner2.png" alt="' . get_bloginfo("name") . '幻灯片" width="960" height="230" /></li>';
		echo '<li><img src="' . get_bloginfo('template_url') . '/images/banner3.png" alt="' . get_bloginfo("name") . '幻灯片" width="960" height="230" /></li>';
		echo '<li><img src="' . get_bloginfo('template_url') . '/images/banner4.png" alt="' . get_bloginfo("name") . '幻灯片" width="960" height="230" /></li>';
	}
	?>
	</ul>
    <ol>
	<?php 
	if( get_option('hui_slides_pic')) {
		global $pic_group, $url_group;
		$slides_num = 0;
		foreach ($pic_group as $pic) {
			if($pic) {
				$slides_num++;
				echo '<li class="active"><a href="' . $pic . '" rel="nofollow">' . $slides_num . '</a></li>';
			}
		}
	} else {
			echo '<li class="active">1</li><li class="active">2</li><li class="active">3</li><li class="active">4</li>';
	}
	?>
    </ol>
</aside>

	<div class="entry">
		<section class="new-products">
			<h3><?php list_title('hui_latest_products','最新产品'); ?></h3>
			<ul>
            	<?php article_list('hui_latest_products',3,70,56,56,30); ?>
			</ul>
		</section>
		<section class="company_news">
			<h3><?php list_title('hui_company_news', '公司动态'); ?></h3>
			<section>
            	<?php cmsList('hui_company_news', 36, 42, 150); ?>
			</section>
		</section>
		<article class="company-profile">
			<h3>学校简介</h3>
			<div>
            <?php 
				$page_id = hui_get_page_ID(get_option('hui_company_profile') );
				if($page_id) {
					$company = new WP_Query('page_id=' . $page_id);
					while ( $company->have_posts() ) : $company->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(215,80) ); ?></a>
					<?php elseif(catch_that_image() ) : ?>
                    	<a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" width="215" height="80" /></a>
        			<?php else : ?>
           				 <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/banner5.png" alt="<?php the_title(); ?>" width="215" height="80" /></a>
                    <?php endif; ?>
					<p><?php echo hui_excerpt(220); ?><span class="detailed"><a href="<?php the_permalink(); ?>">详细&raquo;</a></span></p>
					<?php endwhile; } ?>
			</div>
		</article>
	</div>
	
	<div class="entry">
		<section class="successful-case">
			<h3><?php list_title('hui_successful_case','成功案例'); ?></h3>
			<ul>
                <?php article_list('hui_successful_case',4,134,95,95,34); ?>
			</ul>
		</section>
		<section class="recommended-articles">
			<h3>推荐阅读</h3>
			<ul>
			<?php if (function_exists('get_most_viewed')): ?>
                <?php get_most_viewed('post', 9, 16); ?>
			<?php else : ?>
				<?php hui_most_commented_post(9, 16, 365, 'DESC'); ?>
			<?php endif; ?>
			</ul>
		</section>
	</div>
	
	<div class="entry">
		<section class="custom-left">
			<h3><?php list_title('hui_part_one', '自定义栏目一'); ?></h3>
			<section>
            	<?php cmsList('hui_part_one', 30, 32, 110); ?>
			</section>
		</section>
		<section class="custom-center">
			<h3><?php list_title('hui_part_two', '自定义栏目二'); ?></h3>
			<section>
            	<?php cmsList('hui_part_two', 36, 42, 150); ?>
			</section>
		</section>
		<aside class="contact">
			<h3>联系方式</h3>
			<div>
            	<?php echo get_option('hui_contact'); ?>
			</div>
		</aside>
	</div>

<?php get_footer(); ?>