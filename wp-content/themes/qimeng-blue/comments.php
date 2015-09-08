<?php if(is_single()) {
		$comment_title = "评论";
	} else {
		$comment_title = "留言";
	}
?>
<?php 
function hui_comment($comment, $args, $depth) {
	global $commentcount;
	$GLOBALS['comment'] = $comment;
	if(!$commentcount) {
		$page = get_query_var('cpage')-1;
		$cpp = get_option('comments_per_page');
		$commentcount = $cpp * $page;
	}
?>
<li class="comment-list-entry">
	<article>
		<footer class="comment-info">
			<?php echo get_avatar( $comment, 36 ); ?>
			<span class="comment-author"><?php comment_author_link(); ?></span>
			<span class="edit"><?php edit_comment_link('编辑','',''); ?></span>
			<span class="date">发表于 <time datetime="<?php printf('%1$sT%2$s', get_comment_date('Y-m-d'), get_comment_time('H:i:s') ); ?>+00:00"><?php printf('%1$s %2$s', get_comment_date('Y-m-d'),  get_comment_time('H:i:s')); ?></time></span>
			<span class="floor"><?php if(!$parent_id = $comment->comment_parent) {printf('%1$s楼', ++$commentcount);} ?></span>
		</footer>
		<div class="comment-content">
		<?php if ($comment->comment_approved == '0') : ?>
			<p>您的<?php echo $comment_title ?>正在审核中，请耐心等待，以下是您正在审核中的<?php echo $comment_title ?>内容：</p>
		<?php endif; ?>
			<?php comment_text(); ?>
		</div>
	</article>
<?php } ?>

<?php
	if($comments && !post_password_required() ) {
		echo '<div id="comment-list">';
		echo '<ol>';
		wp_list_comments('type=comment&style=ol&callback=hui_comment');
		echo '</ol>';
		if (get_option('page_comments')) {
			$comment_pages = paginate_comments_links(array('prev_text' => '上一页', 'next_text' => '下一页', 'echo' => 0));
			if ($comment_pages) {
				echo '<nav class="comments-nav">' . $comment_pages . '</nav>';
			}
		}
		echo '</div>';
	} elseif(!$comments) {
		echo '';
	} elseif ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
		echo '<p>请在正文的文本框中输入密码查看' . $comment_title . '</p>';
	}
?>
<?php if(comments_open() && !post_password_required()) : ?>
<div id="respond">
    <?php if(get_option('comment_registration') && !$user_ID) : ?>  
		<p>对不起，您需要<a href="<?php echo get_option('siteurl'); ?>/wp-login.php" rel="nofollow">登录</a>后才能发表<?php echo $comment_title ?>。</p>
	<?php else : ?>  
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php comment_id_fields(); ?>
		<?php if($user_ID) : ?> 
			<p class="lengend">欢迎回来 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" rel="nofollow"><?php echo $user_identity; ?></a> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" rel="nofollow">登出 &raquo;</a></p>
        <?php else : ?>
			<fieldset>
				<p><label for="author">姓名：</label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="20" /><?php if($req) echo '<em>*必填</em>'; ?></p>  
				<p><label for="email">邮箱：</label><input type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="20" /><?php if($req) echo '<em>*必填</em>'; ?></p>
				<p><label for="url">主页：</label><input type="url" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="20" /></p>
			</fieldset>
    	<?php endif; ?> 
		<fieldset>
			<p><label for="comment"><?php echo $comment_title; ?>：</label><textarea name="comment" id="comment" cols="45" rows="6"></textarea></p>
		</fieldset>
        <p><input type="submit" id="submit" value="提交<?php echo $comment_title; ?>" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>  
        <?php do_action('comment_form', $post->ID); ?>  
    </form>  
    <?php endif; ?> 
</div> 
<?php else : ?>
<?php endif; ?>