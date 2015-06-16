<?php get_header(); ?>

<div id="main">
  <div class="w760"> 
    <!--导航条-->
    <?php janeblog_breadcrumbs();?>
    <!--文章-->
    <div class="article">
      <?php while ( have_posts() ) : the_post(); update_post_caches($posts); ?>
      <h1>
        <?php the_title();?>
      </h1>
      <div class="parts">
        <hr/>
        <span><i class="fa fa-calendar"></i>
        <?php the_time('Y年n月j日- l'); ?>
        </span> <span><i class="fa fa-comments-o"></i>
        <?php comments_popup_link ('0条','1条','%条'); ?>
        </span> <span><i class="fa fa-eye"></i>
        <?php custom_the_views($post->ID);?>
        </span> </div>
      <div class="content mt">
        <?php the_content(); ?>
      </div>
      <?php endwhile; ?>
    </div>
    <!--页码-->
    <?php wp_link_pages(array('before' => '<div class="fenye">', 'after' => "", 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
    <?php wp_link_pages(array('before' => "", 'after' => "", 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
    <?php wp_link_pages(array('before' => "", 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => "", 'nextpagelink' => "<span>下一页</span>")); ?>
    <?php
	  // If comments are open or we have at least one comment, load up the comment template
	  if ( comments_open() || '0' != get_comments_number() ) :
		  comments_template();
	  endif;
	  ?>
  </div>
</div>
<?php get_footer(); ?>
