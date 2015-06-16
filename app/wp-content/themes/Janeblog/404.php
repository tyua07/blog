<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<title>
<?php wp_title( '|', true, 'right' ); bloginfo('name'); ?>
</title>
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
<body <?php body_class(); ?>>
<div class="wrap">
  <div class="primary"> <img src="<?php bloginfo('template_url'); ?>/images/404.jpg"/>
  <strong>404</strong> <span>呃.....由于帐户余额不足......该页面无法显示,请返回 <a href="<?php bloginfo('url');?>">首页</a> .</span>
  </div>
</div>
</body>
</html>