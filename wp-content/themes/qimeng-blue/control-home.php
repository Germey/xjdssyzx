<?php
function hui_theme_home_control() {
$themename = "首页设置";
$shortname = "hui";
$option_id = "hui-home";
$themedsc = '';
$options = array (
	array('name' => '首页栏目设置', 'type' => 'heading', 'desc' => '设置首页显示哪些分类，填写要显示的分类名称即可'),	
	array("name" => "最新产品","id" => $shortname."_latest_products", "std" => "", "type" => "text", "class" => "short-box"),	
	array("name" => "公司动态","id" => $shortname."_company_news", "std" => "", "type" => "text", "class" => "short-box"),	
	array("name" => "成功案例","id" => $shortname."_successful_case", "std" => "", "type" => "text", "class" => "short-box"),	
	array("name" => "自定义一","id" => $shortname."_part_one", "std" => "", "type" => "text", "class" => "short-box"),	
	array("name" => "自定义二","id" => $shortname."_part_two", "std" => "", "type" => "text", "class" => "short-box"),
	array('name' => '公司简介', 'id' => $shortname . '_company_profile', 'std' => '', 'type' => 'text', "class" => "short-box", 'prompt' => '以上是填写分类名称，这里填写单页面名称'),
	array('name' => '联系方式', 'id' => $shortname . '_contact', 'std' => '', 'type' => 'textarea', 'rows' => '3', 'cols' => '60', 'prompt' => '首页联系方式版块内容'),
	array('name' => '首页幻灯片设置', 'type' => 'heading', 'desc' => '（幻灯片宽度为：960px，幻灯片高度为：230px）'),
	array('name' => '图片地址', 'id' => $shortname. '_slides_pic', 'std' => '', 'type' => 'textarea', 'rows' => '4', 'cols' => '80', 'prompt' => '多个地址用半角逗号分隔'),
	array('name' => '链接地址', 'id' => $shortname. '_slides_url', 'std' => '', 'type' => 'textarea', 'rows' => '4', 'cols' => '80', 'prompt' => '多个地址用半角逗号分隔'),
);
require_once(TEMPLATEPATH . '/control.php');
}
function my_add_cmsmenu() {
	add_submenu_page( 'control-routine.php', '首页设置', '首页设置', 'administrator', 'home', 'hui_theme_home_control');
}
add_action('admin_menu', 'my_add_cmsmenu');
?>