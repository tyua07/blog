<?php get_header(); ?>

<div id="main"> 
  <?php 
  if ( have_posts() ) : 
   get_template_part( 'content'); 
   else : _e('<div style="height:500px">对不起，没找到你搜索内容。</div>');
   endif;?>
</div>
<?php get_footer();?>