<?php
function hui_theme_control() {
$themename = '主题';
$shortname = 'hui';
$option_id = 'hui-routine';
$themedsc = '';
$options = array (
	array('name' => '核心设置', 'type' => 'heading', 'desc' => ''),
    array('name' => '友情链接全站显示', 'id' => $shortname . '_openlink', 'std' => '否', 'type' => 'radio', 'option' => '是,否'),
    array("name" => '公司产品分类名称', 'id' => $shortname . '_commodity', 'std' => '', 'type' => 'text', 'class' => 'short-box', 'prompt' => '多个产品分类用英文逗号分隔'),
	array('name' => '导航下的公告设置', 'id' => $shortname . '_announcement', 'std' => '', 'type' => 'text', 'prompt' => '显示子分类时这里的内容不会显示'),
	array('name' => 'SEO设置', 'type' => 'heading', 'desc' => ''),
	array('name' => '首页title标题标签', 'id' => $shortname . '_home_title', 'std' => '', 'type' => 'text', 'maxlength' => '30', 'prompt' => '如果这里不填写，将调用WordPress常规设置里的设置，限制60字符'),
    array('name' => '首页meta描述标签', 'id' => $shortname . '_description', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60', 'maxlength' => '100', 'prompt' => '最多200字符'),
	array('name' => '页脚信息设置', 'type' => 'heading', 'desc' => ''),
	array('name' => '网站备案号', 'id' => $shortname . '_record_number', 'std' => '', 'type' => 'text'),	
	array('name' => '网站版权声明', 'id' => $shortname . '_copyright', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60'),	
	array('name' => '网站统计代码', 'id' => $shortname . '_site_statistics', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60'),
    array('name' => '分享设置', 'type' => 'heading', 'desc' => ''),	
	array('name' => '百度分享ID', 'id' => $shortname . '_bdshare_id', 'std' => '', 'type' => 'text', 'class' => 'rss-id', 'prompt' => '在http://share.baidu.com注册账号，将您的ID填入这里即可'),
	array('name' => '客服QQ设置', 'type' => 'heading', 'desc' => ''),
	array('name' => '客户名称', 'id' => $shortname. '_QQ_name', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60', 'prompt' => '多个名称用半角逗号分隔'),
	array('name' => '客户号码', 'id' => $shortname. '_QQ_num', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60', 'prompt' => '多个号码用半角逗号分隔'),
);
require_once(TEMPLATEPATH . '/control.php');
}
function my_add_menu() {
    add_menu_page( '模板设置', '模板设置', 'administrator', basename(__FILE__), 'hui_theme_control');
	add_submenu_page( basename(__FILE__), '常规', '常规', 'administrator', basename(__FILE__), 'hui_theme_control');
}
add_action('admin_menu', 'my_add_menu');
?>