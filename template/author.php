<?php
/*!**************************************************************
Theme Name: MOE-PIX
Theme URI: http://moemob.com/moe-pix
Author: 萌える動 • 萌动网
Author URI: http://moemob.com
Description: 时尚自适应图片主题，集成了功能强大的前台用户中心
Version: 1.0
Package: Ucenter & Market
****************************************************************/
?>
<?php
global $wp_query;
// Current author
$curauth = $wp_query->get_queried_object();
$user_name = filter_var($curauth->user_url, FILTER_VALIDATE_URL) ? '<a href="'.$curauth->user_url.'" target="_blank" rel="external">'.$curauth->display_name.'</a>' : $curauth->display_name;
$user_info = get_userdata($curauth->ID);
$posts_count =  $wp_query->found_posts;
$comments_count = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
$collects = $user_info->um_collect?$user_info->um_collect:0;
$collects_array = explode(',',$collects);
$collects_count = $collects!=0?count($collects_array):0;
$credit = intval($user_info->um_credit);
$credit_void = intval($user_info->um_credit_void);
// Current user
$current_user = wp_get_current_user();
// Myself?
$oneself = $current_user->ID==$curauth->ID || current_user_can('edit_users') ? 1 : 0;
// Admin ?
$admin = $current_user->ID==$curauth->ID&&current_user_can('edit_users') ? 1 : 0;
// Tabs
$top_tabs = array(
	'index' => __('控制板','um'),
	'post' => __('文章','um')."($posts_count)",
	'comment' => __('评论','um')."($comments_count)",
	'collect' => __('收藏','um')."($collects_count)",
	'credit' => __('积分','um')."($credit)",
	'message' => __('消息','um')
);

$manage_tabs = array(
	'profile' => __('个人资料','um')
);
if($oneself){$manage_tabs['membership']='会员信息';}
if($oneself)$manage_tabs['orders']='站内订单';
if($admin)$manage_tabs['manage']='订单管理';
$manage_tabs['affiliate']='我的推广';
if($admin)$manage_tabs['coupon']='优惠码';

$other_tabs = array(
	'following' => __('关注','um'),
	'follower' => __('粉丝','um')
);

$tabs = array_merge($top_tabs,$manage_tabs,$other_tabs);
foreach( $tabs as $tab_key=>$tab_value ){
	if( $tab_key ) $tab_array[] = $tab_key;
}

// Current tab
$get_tab = isset($wp_query->query_vars['tab']) && in_array($wp_query->query_vars['tab'], $tab_array) ? $wp_query->query_vars['tab'] : 'index';

// 提示
$message = $pages = '';

$item_html = '<li class="tip">'.__('没有找到记录','um').'</li>';

?>
<!-- Header -->
<?php get_header(); ?>

<!-- Main Wrap -->

<div id="main-wrap" class="content page dashboard space centralnav">
  <div id="author-page" class="primary bd clx" role="main">
	<!-- Cover -->

	<!-- Cover change -->

	<!-- Author info -->

	<!-- Main content -->

	<!-- Aside -->
	<?php include('u/aside.php'); ?>
	<!-- Content -->
		<!-- Tab-index -->
		<?php 
			if( $get_tab=='index' ) {include('u/index.php');}
		?>
		<!-- End Tab-index -->
		<!-- Tab-post -->
		<?php if( $get_tab=='post' ) {
			if(isset($wp_query->query_vars['action'])&&in_array($wp_query->query_vars['action'],array('new','edit')))include('u/post-new.php');
			else include('u/post.php');
		} ?>
		<!-- End Tab-post -->
		<!-- Tab-comment -->
		<?php 
			if( $get_tab=='comment' ) {include('u/comment.php');}
		?>
		<!-- End Tab-comment -->
		<!-- Tab-collect -->
		<?php 
			if( $get_tab=='collect'){include('u/collect.php');}
		?>
		<!-- End Tab-collect -->
		<!-- Tab-message -->
		<?php
			if( $get_tab=='message' ) {include('u/message.php');}
		?>
		<!-- End Tab-message -->
		<!-- Tab-credit -->
		<?php
			if( $get_tab=='credit' ) {include('u/credit.php');}
		?>
		<!-- End Tab-credit -->
		<!-- Tab-profile -->
		<?php
			if( $get_tab=='profile' ) {include('u/profile.php');}
		?>
		<!-- End Tab-profile -->
		<!-- Tab-membership -->
		<?php
			if( $get_tab=='membership'&&$oneself ) {include('u/membership.php');}
		?>
		<!-- End Tab-membership -->
		<!-- Tab-orders -->
		<?php
			if( $get_tab=='orders' ) {include('u/order.php');}
		?>
		<!-- End Tab-orders -->
		<!-- Tab-order-manage -->
		<?php
			if( $get_tab=='manage' ) {include('u/order-manage.php');}
		?>
		<!-- End Tab-order-manage -->
		<!-- Tab-coupon -->
		<?php
			if( $get_tab=='coupon' ) {include('u/coupon.php');}
		?>
		<!-- End Tab-coupon -->
		<!-- Tab-following -->
		
		<!-- End Tab-following -->
		<!-- Tab-follower -->

		<!-- End Tab-follower -->
		<!-- Tab-affiliate -->
		<?php
			if( $get_tab=='affiliate' ) {include('u/affiliate.php');}
		?>
		<!-- End Tab-affiliate -->
	<!-- End Right Content -->
	</div><!-- End #author-page -->
</div><!-- End #main-wrap -->

<!-- Footer -->
<?php get_footer(); ?>