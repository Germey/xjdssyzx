<?php get_header(); ?>
	<div id="content" role="main">
    	<?php hui_path(); ?>
		<article class="error">
			<h1>错误提示</h1>
			<p>很抱歉，您查找的内容可能已经删除或是已转移，您可以在本站顶部的搜索框中使用不同的关键字进行搜索，以便找到您感兴趣的内容，您还可以点击本页下方的随机文章列表随便看看。</p>
			<p>如果这样仍不能解决您的问题，请发送邮件至<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>，<?php echo get_the_author_meta('nickname',1); ?>在收到您的来邮后会第一时间回复，非常感谢您的支持！</p>
		</article>
		<section class="random-articles">
			<h3>随便看看</h3>
			<ul>
				<?php hui_random_posts(15,60,true); ?>
			</ul>
		</section>
	</div>
    <?php get_sidebar(); ?>		
<?php get_footer(); ?>