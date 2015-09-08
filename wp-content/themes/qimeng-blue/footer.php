
</div>

<?php if (is_home() || get_option('hui_openlink') == "是") : ?>
<aside class="links">
    <h4>友情链接</h4>
    <ul>
        <?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=-1'); ?>
    </ul>
</aside>
<?php endif; ?>

<footer id="colophon" role="contentinfo">
	<?php if(get_option('hui_copyright')) : ?><p class="statement"><?php echo get_option('hui_copyright'); ?></p><?php endif; ?>
	<nav class="nav-page" role="navigation">
		<ul>
			<?php 
				function footerNav() {
					echo '<li class="menu-item-home"><a href="' . get_bloginfo('url') . '">网站首页</a></li>';
					wp_list_pages('title_li=');
				}
				wp_nav_menu( array( 'container' => false, 'menu' => false, 'menu_class' => false, 'theme_location' => 'nav-footer', 'items_wrap' => '%3$s', 'fallback_cb' => 'footerNav' ) );
			?>
        </ul>
    </nav>
	<div class="copyright">
		<p>Copyright &copy; 2015 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <span style="display:none"><?php huiLinks(true); ?></span><?php if (get_option('hui_record_number') ) echo ' <a href="http://www.miibeian.gov.cn" target="_blank">' . get_option('hui_record_number') .'</a>'; ?> 
		<?php 
			function hui_logout_url() {
				if (is_home()) {
					return wp_logout_url( home_url());
				} else {
					return wp_logout_url( get_permalink());
				}
			}
			if (!(current_user_can('level_0'))) { 
				echo '<a href="' . wp_login_url() . '" rel="nofollow">登录</a>';
			} else {
				echo '<a href="' . get_option('siteurl') . '/wp-admin/" rel="nofollow">管理</a> <a href="' . hui_logout_url() . '" rel="nofollow">注销</a>';
			} 
		?>
		<a href="#">返回</a></p>
		<?php if(get_option('hui_site_statistics')) : ?><p><?php echo get_option('hui_site_statistics'); ?></p><?php endif; ?>
	</div>
</footer>
<?php if(get_option('hui_bdshare_id') && !is_single()) : 
$share_position = 'right';
if(get_option('hui_QQ_name')) $share_position = 'left';
?>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=2&amp;pos=<?php echo $share_position; ?>&amp;uid=<?php echo get_option('hui_bdshare_id'); ?>" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"bdTop":165};
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->
<?php endif; ?>
<?php 
	if(get_option('hui_QQ_name') ) {
		echo '<div id="qq-kefu"><ul>';
		$QQ_name_group = explode(',', get_option('hui_QQ_name'));
		$QQ_num_group = explode(',', get_option('hui_QQ_num'));
		$count = 0;
		foreach ($QQ_name_group as $QQ_name) {
			if($QQ_name) {
				$QQ_num = $QQ_num_group[$count];
				if(!$QQ_num) $QQ_num = '86415092';
				$QQ_url = 'http://sighttp.qq.com/msgrd?v=3&amp;uin=' . $QQ_num . '&amp;site=' . $QQ_name . '&amp;menu=yes';
				$QQ_img = 'http://wpa.qq.com/pa?p=1:' . $QQ_num . ':4';
				echo '<li><a href="' . $QQ_url . '" rel="nofollow" target="_blank"><img src="' . $QQ_img . '" alt="点击咨询' . $QQ_name . '" />' . $QQ_name . '</a></li>';
				$count++;
			}
		}
		echo '</ul></div>';
	}
?>
<?php wp_footer(); ?>
</body>
</html>