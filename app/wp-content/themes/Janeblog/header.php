<?PHP 
/*
 * The header.
 * @package WordPress
 * @subpackage Janeblog
 * @since Janeblog 1.0
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $options = (ClassicOptions::getOptions()); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
<meta name="keywords" content="<?php echo($options['jane_keywords']);?>" />
<meta name="description" content="<?php echo($options['jane_description']);?>" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/font-awesome-4.2.0/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/font-awesome-4.2.0/css/font-awesome-ie7.min.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/theme.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.SuperSlide.js"></script>
<?php wp_head(); ?>
</head>
<body>
<!--浮动盒子-->
<div id="costom"><a href="javascript:void(0)"><i class="fa fa-arrow-up"></i></a></div>
<!--页面头部-->
<div id="header">
  <div class="wrap">
    <div class="logo"><a href="<?php bloginfo('url');?>"></a></div>
    <div class="menu"><a href="javascript:void(0)"><i class="fa fa-reorder"></i></a></div>
    <div class="search">
      <form id="searchForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
          <input name="s" id="s" type="text" class="text" placeholder="请输入关键字" />
          <button type="submit" value="" id="searchsubmit"><i class="fa fa-search"></i></button>
        </fieldset>
      </form>
    </div>
    <div class="login"> 
    <?php if(is_user_logged_in()){
		 echo '<a href="javascript:void(0);"><i class="fa fa-user"></i> 已登录</a>';
		 if ( $user_ID ){ ?>
         <a href="<?php echo wp_logout_url(home_url()); ?>" title="登出">登出</a>
         <?php }; 
		 }else{
		?>	 
    <a href="<?php echo site_url('/wp-login.php'); ?>"><i class="fa fa-user"></i> 登录</a> 
    <a href="<?php echo site_url('/wp-login.php?action=register'); ?>">注册</a> 
	<?php }; ?>
    </div>
  </div>
</div>
<!--导航菜单-->
<div id="nav" <?php if ($options['jane_menu'] == '1'){ echo 'style="display: none;"'; }else { echo 'style="display: block;"';} ?>>
  <div class="wrap">
    <ul>
      <li><a href="<?php bloginfo('url');?>"><i class="fa fa-home"></i>首页</a></li>
      <?php 
	    $menuParameters = array(
		'container'	=> false,
		'echo'	=> false,
		'items_wrap' => '%3$s',
		'depth'	=> 0,
		'theme_location' =>'primary',
		'depth' => 1,
		'menu_class' => 'nav-menu'
	    );
	    echo strip_tags(wp_nav_menu( $menuParameters), '<li><a>' );
        ?>
    </ul>
  </div>
</div>
