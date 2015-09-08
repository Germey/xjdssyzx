<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	global $page, $paged;
	$hui_title = '';
	$page_num = '';
	if ( $paged >= 2 || $page >= 2 ) $page_num = '_' . sprintf( '第%s页', max( $paged, $page ) );
	if(is_category() && get_option('cat_title_' . $cat) ) {
		$hui_title = get_option('cat_title_' . $cat) . ' - ' . get_bloginfo( 'name' );
	} elseif(is_home() && get_option('hui_home_title') ) {
		$hui_title = get_option('hui_home_title') . $page_num;
	} else {
		$hui_title = trim(wp_title('',0));
		if (!is_home()) {
			$hui_title .= $page_num . ' - ';
		}
		$hui_title .= get_bloginfo( 'name' );
	}
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && is_home() && !get_option('hui_home_title') ) $hui_title .= $page_num . ' - ' . $site_description;
?>
<title><?php echo $hui_title; ?></title>
<?php
$huidesc = '';
if (is_home() ) {
	if (get_option('hui_description') ) $huidesc = get_option('hui_description');
} elseif (is_single() ) {
	$huidesc = hui_excerpt(200);
	if ($post->post_excerpt) $huidesc = $post->post_excerpt;
} elseif (is_category() || is_tag()) {
    if (category_description() ) $huidesc = strip_tags(category_description());
} elseif (is_page() ) {
	if (the_content() ) $huidesc = hui_excerpt(200);
}
$huidesc = DeleteHtml($huidesc);
?>
<?php
if($huidesc) {
	echo '<meta name="description" content="' . $huidesc . '" />';
}
?>

<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/script/html5.js" type="text/javascript"></script>
<![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/huihui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/jquery-1.9.1.min.js"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="branding" role="banner">
	<div id="title">
		<a href="<?php bloginfo('url'); ?>"><img class="logo" src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php if(get_option('hui_home_title')) { echo get_option('hui_home_title'); } else { bloginfo('name'); } ?>" width="370" height="60" /></a>
		<img class="banner" src="<?php bloginfo('template_url'); ?>/images/banner.png" alt="<?php bloginfo('name'); ?>banner" width="468" height="60" />
	</div>
	<nav id="nav" role="navigation">
		<ul>
			<li class="menu-item-home"><a href="<?php bloginfo('url'); ?>">网站首页</a>
				<ul class="sub-menu">
					<?php 
						if(get_option('hui_announcement')) {
							echo '<li>' . get_option('hui_announcement') . '</li>';
						} else {
							echo '<li>欢迎访问夏津县第三实验中学官方网站</li>';
						}
					?>
				</ul>
			</li>
		<?php 
			function hui_nav() {
				wp_list_pages('title_li=');
				wp_list_categories('orderby=id&title_li=&show_count=0&hide_empty=0&use_desc_for_title=');
			}
			wp_nav_menu( array( 'container' => false, 'menu' => false, 'menu_class' => false, 'theme_location' => 'nav-top', 'items_wrap' => '%3$s', 'fallback_cb' => 'hui_nav' ) );
		?>
		</ul>
	</nav>
</header>
<div id="container"<?php if(is_home() ) echo ' role="main"'; ?>>