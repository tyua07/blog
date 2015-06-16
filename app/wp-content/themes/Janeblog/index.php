<?php
/**
 * The main template file.
 * @package Janeblog
 */

get_header(); ?>
<?php $options = (ClassicOptions::getOptions()); ?>
<!--内空展示-->
<div id="main">
  <?php if( is_home() || is_front_page() ){ ?>
  <div class="banner w760"> <a class="tou" onclick="rotateDIV()" href="<?php bloginfo('url');?>"><img class="user" src="<?php echo($options['jane_user']); ?>"/></a>
    <h1>
      <?php bloginfo( 'mane' ); ?>
    </h1>
    <h2>
      <?php bloginfo( 'description' ); ?>
    </h2>
    <span><img src="<?php echo($options['jane_banner']); ?>"/></span> 
  </div>
  <!--幻灯-->
  <div class="slide w760">
    <div class="show">
      <ul class="pic">
        <li class="one"><a href="#" target="_blank"><img src="<?php echo($options['jane_img1']); ?>"></a></li>
        <li><a href="#" target="_blank"><img src="<?php echo($options['jane_img2']); ?>"></a></li>
        <li><a href="#" target="_blank"><img src="<?php echo($options['jane_img3']); ?>"></a></li>
        <li><a href="#" target="_blank"><img src="<?php echo($options['jane_img4']); ?>"></a></li>
        <li><a href="#" target="_blank"><img src="<?php echo($options['jane_img5']); ?>"></a></li>
      </ul>
      <div class="txt-bg"></div>
      <div class="txt">
        <ul>
          <li style="bottom: 0px;"><a target="_blank" href="<?php echo($options['jane_img1_link']); ?>"><?php echo($options['jane_img1_title']); ?></a></li>
          <li style="bottom: -36px;"><a target="_blank" href="<?php echo($options['jane_img2_link']); ?>"><?php echo($options['jane_img2_title']); ?></a></li>
          <li style="bottom: -36px;"><a target="_blank" href="<?php echo($options['jane_img3_link']); ?>"><?php echo($options['jane_img3_title']); ?></a></li>
          <li style="bottom: -36px;"><a target="_blank" href="<?php echo($options['jane_img4_link']); ?>"><?php echo($options['jane_img4_title']); ?></a></li>
          <li style="bottom: -36px;"><a target="_blank" href="<?php echo($options['jane_img5_link']); ?>"><?php echo($options['jane_img5_title']); ?></a></li>
        </ul>
      </div>
      <ul class="num">
        <li class="on"></li>
        <li class=""></li>
        <li class=""></li>
        <li class=""></li>
        <li class=""></li>
      </ul>
    </div>
    <!--置顶文章-->
    <div class="hot">
      <h3 class="h3">编辑推荐：</h3>
      <ul>
		<?php 
        $sticky = get_option('sticky_posts');
        rsort( $sticky ); 
        $sticky = array_slice( $sticky, 0, 6); 
        query_posts( array( 'post__in' => $sticky, 
		'caller_get_posts' => 1 
		) ); 
        if (have_posts()) :  while (have_posts()) : the_post(); 
        ?> 
        <li><a target="_blank" href="<?php the_permalink(); ?>" title=”<?php the_title(); ?>” rel="bookmark"><?php the_title(); ?></a></li>
        <?php endwhile; endif; wp_reset_query(); ?>
      </ul>
    </div>
  </div>
  <?php };?>
  <!--文章-->
  <?php get_template_part( 'content', get_post_format() ); ?>
  <?php get_template_part( 'links' ); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>