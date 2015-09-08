<?php get_header(); ?>
	<div id="content">
	<?php while (have_posts()) : the_post(); ?>
		<?php hui_path(); ?>
		<article id="article-content" role="main">
			<header>
				<h1><?php the_title_attribute(); ?></h1>
				<div class="meta-data">
					<span class="date">发表于：<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time></span>
					<span class="author">作者：<?php the_author(); ?></span>
					<?php if(function_exists('the_views')) { ?>
					<span class="views">浏览：<?php the_views(); ?>次</span>
					<?php } ?>
					<?php if ( !post_password_required() && comments_open() ) : ?>
					<span class="comments">评论：<?php comments_popup_link('0', '1', '%'); ?></span>
					<?php endif; ?>
					<?php edit_post_link('编辑', '<span class="edit">', '</span>'); ?>
				</div>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			
			<footer>
				<?php tagtext(); ?>
			
				<?php if(get_option('hui_bdshare_id')) : ?>
				<!-- Baidu Button BEGIN -->
				<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
					<span class="bds_more">分享到：</span>
					<a class="bds_qzone">QQ空间</a>
					<a class="bds_tsina">新浪微博</a>
					<a class="bds_tqq">腾讯微博</a>
					<a class="bds_renren">人人网</a>
					<a class="shareCount"></a>
				</div>
				<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=<?php echo get_option('hui_bdshare_id'); ?>"></script>
				<script type="text/javascript" id="bdshell_js"></script>
				<script type="text/javascript">
					document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();
				</script>
				<!-- Baidu Button END -->
				<?php endif; ?>
			</footer>	
		</article>
		
		<?php previous_post_link('<nav class="previous-article">上一篇：%link</nav>', '%title',$in_same_cat = true); ?>
		<?php next_post_link('<nav class="next-article">下一篇：%link</nav>', '%title',$in_same_cat = true); ?>
		
		<?php 
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$first_tag = $tags[0]->term_id;
				$args=array(
					'tag__in' => array($first_tag),
					'showposts' => 10,
					'caller_get_posts' => 1,
				);
				$related_query = new WP_Query($args);
				if( $related_query->have_posts() ) {
					echo '<aside class="related-posts"><h3>相关文章</h3><ul>';
					while ($related_query->have_posts() ) : $related_query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo mb_strimwidth(the_title_attribute('echo=0'), 0, 50, ''); ?></a></li>
				<?php endwhile;
					echo '</ul></aside>';
				} else {
					echo '<aside class="random-articles"><h3>随机文章</h3><ul>';
					hui_random_posts(10, 50, false);
					echo '</ul></aside>';
				}
				wp_reset_query();
			} else {
				echo '<aside class="random-articles"><h3>随机文章</h3><ul>';
				hui_random_posts(10, 50, false);
				echo '</ul></aside>';
			}
		?>

		<?php comments_template( '', true ); ?>
		<?php endwhile; ?>
	</div>
    <?php get_sidebar(); ?>		
<?php get_footer(); ?>