<div id="secondary">
	<?php if(is_single() || is_category() ) : ?>
    	<?php 
			global $cat;
			$category = get_the_category();
			$category_ID = $cat;
			if(is_single() ) $category_ID = $category[0]->cat_ID;
			$cats = get_category(get_category_root_id($category_ID) );
			if($category_ID != get_category_root_id($category_ID) || get_category_children($category_ID) ) : ?>  
	<aside class="cat">
		<?php echo '<h3>' . $cats->name . '</h3>'; ?>
        <ul>
	    	<?php wp_list_categories("child_of=". get_category_root_id($category_ID) . "&depth=0&hide_empty=0&title_li=&use_desc_for_title=&orderby=id&show_count=0"); ?>
        </ul>
    </aside>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(is_page() ) : ?>
    <?php 
		if($post->post_parent) {
    		echo '<aside class="pages">';
			echo '<h3>' . get_the_title($post->post_parent) . '</h3>';
			$children = wp_list_pages('title_li=&child_of=' . $post->post_parent . '&echo=0');
			if ($children) echo '<ul>' . $children . '</ul>';
			echo '</aside>';
		}
		if(wp_list_pages('title_li=&child_of=' . $post->ID . '&echo=0') ) {
			echo '<aside class="pages">';
			echo '<h3>' . get_the_title($post->ID) . '</h3>';
			echo '<ul>' . wp_list_pages('title_li=&child_of=' . $post->ID . '&echo=0') . '</ul>';
			echo '</aside>';
		}
	?>
    <?php endif; ?>
	<aside class="recen">
		<h3>最新资讯</h3>
		<ul>
			<?php hui_recen_posts(8, 32); ?>
		</ul>
	</aside>
    <?php if(get_option('hui_contact')) : ?>
    <aside class="contact">
        <h3>联系方式</h3>
        <div>
            <?php echo get_option('hui_contact'); ?>
        </div>
    </aside>
    <?php endif; ?>
</div>