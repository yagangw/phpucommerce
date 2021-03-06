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
	$curauth = $wp_query->get_queried_object();
	$current_user = wp_get_current_user();
?>
<div class="aside">
    <div class="user-avatar">
        <a href="<?php echo um_get_user_url('index',$curauth->ID); ?>"><?php echo um_get_avatar( $curauth->ID , '100' , um_get_avatar_type($curauth->ID) ); ?></a>
        <h2><?php echo $curauth->display_name; ?></h2>
		<div id="num-info">
			<div><span class="num"><?php echo um_following_count($curauth->ID); ?></span><span class="text">关注</span></div>
			<div><span class="num"><?php echo um_follower_count($curauth->ID); ?></span><span class="text">粉丝</span></div>
			<div><span class="num"><?php echo $posts_count; ?></span><span class="text">文章</span></div>
		</div>
		<?php if($curauth->ID!=$current_user->ID){ ?>
		<div class="fp-btns">
		<?php echo um_follow_button($curauth->ID); ?>
		<span class="pm-btn"><a href="<?php echo um_get_user_url('message', $curauth->ID); ?>" title="发送私信">私信</a></span>
		</div>
		<?php } ?>
		<div class="clear"></div>
    </div>
    <div class="menus">
        <ul>
			<li class="tab-index <?php if((isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='index')||!isset($wp_query->query_vars['tab'])) echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('index',$curauth->ID); ?>"><i class="fa fa-tachometer"></i>首页中心</a>
			</li>
			<li class="tab-post <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='post'&&(isset($wp_query->query_vars['action'])&&!in_array($wp_query->query_vars['action'],array('new','edit'))||!isset($wp_query->query_vars['action']))) echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('post',$curauth->ID); ?>"><i class="fa fa-cube"></i>我的文章</a>
			</li>
			<li class="tab-post-new <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='post'&&isset($wp_query->query_vars['action'])&&in_array($wp_query->query_vars['action'],array('new','edit'))) echo 'active'; ?>">
			<?php if(is_user_logged_in()){ ?>
				<a href="<?php echo um_get_user_url('post/new', $current_user->ID); ?>">
			<?php }else{ ?>
				<a href="javascript:" class="user-login">
			<?php } ?>
				<i class="fa fa-pencil-square-o"></i>文章投稿</a>
			</li>
			<li class="tab-collect <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='collect') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('collect',$curauth->ID); ?>"><i class="fa fa-star"></i>文章收藏</a>
			</li>
			<li class="tab-comment <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='comment') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('comment',$curauth->ID); ?>"><i class="fa fa-comments"></i>评论留言</a>
			</li>
			<li class="tab-message <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='message') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('message',$curauth->ID); ?>"><i class="fa fa-envelope"></i>站内消息</a>
			</li>
			<li class="tab-credit <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='credit') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('credit',$curauth->ID); ?>"><i class="fa fa-credit-card"></i>积分管理</a>
			</li>
			<li class="tab-order <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='orders') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('orders',$curauth->ID); ?>"><i class="fa fa-shopping-cart"></i>我的订单</a>
			</li>
			<?php if(current_user_can('edit_users')){ ?>
			<li class="tab-order-manage <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='manage') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('manage',$curauth->ID); ?>"><i class="fa fa-tasks"></i>订单管理</a>
			</li>
			<?php } ?>
			<?php if($oneself){ ?>
			<li class="tab-membership <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='membership') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('membership',$curauth->ID); ?>"><i class="fa fa-user-md"></i>会员信息</a>
			</li>
			<?php } ?>
			<li class="tab-affiliate <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='affiliate') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('affiliate',$curauth->ID); ?>"><i class="fa fa-money"></i>联盟推广</a>
			</li>
			<?php if(current_user_can('edit_users')){ ?>
			<li class="tab-coupon <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='coupon') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('coupon',$curauth->ID); ?>"><i class="fa fa-tags"></i>卡券管理</a>
			</li>
			<?php } ?>
			<li class="tab-profile <?php if(isset($wp_query->query_vars['tab'])&&$wp_query->query_vars['tab']=='profile') echo 'active'; ?>">
				<a href="<?php echo um_get_user_url('profile',$curauth->ID); ?>"><i class="fa fa-cog"></i>编辑资料</a>
			</li>
		</ul>
    </div>
</div>