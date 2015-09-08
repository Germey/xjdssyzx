<?php get_header(); ?>
	<div id="content">
	<?php while (have_posts()) : the_post(); ?>
   		<?php hui_path(); ?>
		<article role="main">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<div class="page-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php comments_template( '', true ); ?>
	<?php endwhile; ?>
	</div>
    <?php get_sidebar(); ?>		
<?php get_footer(); ?>