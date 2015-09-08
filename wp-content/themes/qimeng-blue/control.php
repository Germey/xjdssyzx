<?php
if ( 'save' == $_REQUEST['action'] ) {
    foreach ($options as $value) {
        update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ]) );
	}
    foreach ($options as $value) {
        if( isset( $_REQUEST[ $value['id'] ] ) ) {
			update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ]) );
		} else {
			delete_option( $value['id'] );
		}
	}
}
if ( $_REQUEST['save'] ) echo '<div id="message" class="updated fade"><p>珲珲提醒您：设置已保存。</p></div>';
?>
<style type="text/css">
.wrap h2 {
	font-weight: bold;
}
.wrap .hui-prompt {
	color: #0000ff;
}
.wrap h3 {
	font-size: 16px;
	margin: 0;
	padding: 15px 0;
	border-top: 1px solid #d0dfe9;
}
.wrap p.desc {
	color: #ff0000;
	margin: -5px 0 0 0;
	padding: 0;
}
.wrap label {
	width: 10em;
	float: left;
	margin-right: 1em;
}
#hui-home label {
	width: 6em;
}
.wrap .short-box input {
	width: 8em;
}
.wrap input {
	padding: 3px 2px;
}
.wrap textarea {
	line-height: 1.5;
	padding: .5em;
}
.wrap .option p em {
	font-style: italic;
	color: #ff0000;
}
.wrap label.radio {
	float: none;
	margin-left: 3em;
	margin-right: 0;
}
.wrap .submit .button-primary {
	padding: 3px 8px;
	border: 0;
}
</style>
<div id="<?php echo $option_id; ?>" class="wrap">
    <h2><?php echo $themename; ?>设置</h2>
	<?php if($themedsc) echo '<p class="hui-prompt">' . $themedsc . '</p>'; ?>
    <form method="post" action="">
        <div class="submit">
            <input name="save" type="submit" class="button-primary" value="保存设置" /><input type="hidden" name="action" value="save" />
        </div>
        <div class="option" >
        <?php foreach($options as $value) {
            if ($value['type'] == 'text' || $value['type'] == 'textarea') { ?>
				<p class="<?php echo $value['type']; ?><?php if($value['class']) echo ' ' . $value['class']; ?>">
					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
					<?php if($value['type'] == 'textarea') : ?>
						<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="<?php echo $value['rows']; ?>" cols="<?php echo $value['cols']; ?>"<?php if($value['maxlength']) echo ' maxlength="' . $value['maxlength'] . '"'; ?>><?php if ( get_settings( $value['id'] ) != '') echo get_settings( $value['id'] ); else  echo $value['std']; ?></textarea>
					<?php else : ?>
						<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != '') echo get_settings( $value['id'] ); else echo $value['std']; ?>" size="48"<?php if($value['maxlength']) echo ' maxlength="' . $value['maxlength'] . '"'; ?><?php if($value['readonly']) echo ' readonly="' . $value['readonly'] . '"'; ?> />
					<?php endif; ?>
					<?php if($value['prompt']) : ?> <em><?php echo $value['prompt']; ?></em><?php endif; ?>
				</p>
            <?php } elseif ($value['type'] == 'radio') { ?>
				<p class="<?php echo $value['type']; ?>"><?php echo $value['name']; ?>
				<?php 
					$hui_option_group = explode(',', $value['option']);
					for( $i=0; $i<count($hui_option_group); $i++ ) {
						$hui_option = $hui_option_group[$i];
						$hui_checked = '';
						if(get_settings( $value['id'] ) != '' ) {
								if($hui_option == get_settings( $value['id'] ) ) $hui_checked = ' checked="checked"';
						} else {
							if($hui_option == $value['std']) $hui_checked = ' checked="checked"';
						}
						echo '<label for="' . $value['id'] . $i . '" class="' . $value['type'] . '"><input id="' . $value['id'] . $i . '" name="' . $value['id'] . '" type="' . $value['type'] . '" value="' . $hui_option . '"' . $hui_checked . ' /> ' . $hui_option . '</label>';
					}
				?>
				<?php if($value['prompt']) : ?> <em><?php echo $value['prompt']; ?></em><?php endif; ?></p>
			<?php } elseif ($value['type'] == "heading") { ?>
				<h3><?php echo $value['name']; ?></h3>
				<?php if($value['desc']) : ?><p class="desc"><?php echo $value['desc']; ?> </p><?php endif; ?>
            <?php } ?>
            <?php
            }
            ?>
		</div>
        <div class="submit">
            <input name="save" type="submit" class="button-primary" value="保存设置" /><input type="hidden" name="action" value="save" />
        </div>
    </form>
</div>