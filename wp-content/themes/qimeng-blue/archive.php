<?php get_header(); ?>
<section id="content" role="main">
	<header>
		<h1><?php echo trim(wp_title('',0)); ?></h1>
		<?php 
			if(category_description()) {
				echo '<p class="cat-des">' . strip_tags(category_description()) . '</p>';
			}
		?>
	</header>
	<?php 
        global $cat;
		$commodity_cat_value = get_option('hui_commodity');
        if($commodity_cat_value) $commodity_cat_name_group = explode(',', $commodity_cat_value);
		function is_commodity() {
			global $commodity_cat_name_group, $cat;
			if($commodity_cat_name_group) {
				foreach ($commodity_cat_name_group as $commodity_cat_name) {
					if($commodity_cat_name) {
						$commodity_cat_ID = get_cat_ID($commodity_cat_name);
						if($commodity_cat_ID == get_category_root_id($cat) || $commodity_cat_ID == $cat) return true;
					}
				}
			}
		}
		if(is_commodity() ) {
            get_template_part( 'commodity', '' );
		} else {
            get_template_part( 'content', '' );
        }
    ?>
</section>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>