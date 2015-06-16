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
        </span> <span><i class="fa fa-folder"></i>
        <?php the_category(' , ') ?>
        </span> <span><i class="fa fa-comments-o"></i>
        <?php comments_popup_link ('0条','1条','%条'); ?>
        </span> <span><i class="fa fa-eye"></i>
        <?php custom_the_views($post->ID);?>
        </span> </div>
      <div class="content mt">
        <?php the_content(); ?>
      </div>
      <?php endwhile; wp_reset_query(); ?>
      <!--标签-->
      <div class="tags"><i class="fa fa-tags"></i>
        <?php the_tags(('标签: '), ' '); ?>
      </div>
    </div>
    <!--页码-->
    <?php wp_link_pages(array('before' => '<div class="fenye">', 'after' => "", 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
    <?php wp_link_pages(array('before' => "", 'after' => "", 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
    <?php wp_link_pages(array('before' => "", 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => "", 'nextpagelink' => "<span>下一页</span>")); ?>
    <!--上下篇章-->
    <div class="textlink">
      <?php
	  $categories = get_the_category();
	  $categoryIDS = array();
	  foreach ($categories as $category) {
	  array_push($categoryIDS, $category->term_id);
	  }
	  $categoryIDS = implode(",", $categoryIDS);
	  ?>
      <span>
      <?php if (get_previous_post($categoryIDS)) { previous_post_link('上一篇: %link','%title',true);} else { echo "上一篇: 没有了，已经是最后文章";} ?>
      </span> <span>
      <?php if (get_next_post($categoryIDS)) { next_post_link('下一篇: %link','%title',true);} else { echo "下一篇: 没有了，已经是最新文章";} ?>
      </span> </div>
    <!--相关文章-->
    <div class="related">
      <h3 class="h3">相关阅读：</h3>
      <ul>
        <?php
global $post;
$cats = wp_get_post_categories($post->ID);
if ($cats) {
    $args = array(
          'category__in' => array( $cats[0] ),
          'post__not_in' => array( $post->ID ),
          'showposts' => 10,
          'caller_get_posts' => 1
      );
  query_posts($args);
  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>
        <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <div class="img"><img src="<?php echo catch_that_image() ?>"/></div>
          <div class="rel"><span><?php the_title(); ?></span></div>
          </a></li>
<?php }}else {
    echo '<li>* 暂无相关文章</li>';
  }
  wp_reset_query();
} else {
  echo '<li>* 暂无相关文章</li>';
};?>
      </ul>
    </div>
    <?php
	  // If comments are open or we have at least one comment, load up the comment template
	  if ( comments_open() || '0' != get_comments_number() ) :
		  comments_template();
	  endif;
	  ?>
  </div>
</div>
<?php get_footer(); ?>
