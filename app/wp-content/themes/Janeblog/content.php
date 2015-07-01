  <div class="post w760">
    <!--导航条-->
    <?php janeblog_breadcrumbs(); ?>
    <h3 class="h3">文章列表：</h3>
    <ul>
      <?php while (have_posts()) : the_post(); ?>
      <li>
        <div class="img"><a target="_blank" href="<?php the_permalink() ?>"><img src="<?php echo catch_that_image() ?>"/></a></div>
        <div class="excerpt">
          <div class="title">
            <h1><i class="fa fa-file-text-o"></i><a target="_blank" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          </div>
          <div class="content">
            <p>
            <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 185," [……]"); ?>
            </p>
            <span class="post-time"><i class="fa fa-calendar"></i> <?php the_time('Y年n月j日- l'); ?></span>
            <span class="post-more"><a target="_blank" href="<?php the_permalink(); ?>">more <i class="fa fa-plus-square-o"></i></a></span>
          </div>
        </div>
      </li>
      <?php endwhile; ?> 
    </ul>
    <!--页码-->
    <div class="page"><?php par_pagenavi(9);?></div>
  </div>
