<?php
if ( post_password_required() ) {
	return;
}
?>
<!--评论区-->
<div id="comments">
  <?php if ( have_comments() ) : ?>
  <h3 class="comments-title"><?php printf( get_comments_number() . '条评论' ); ?></h3>
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
  <div id="comment-nav-above" class="comment-navigation" role="navigation">
    <h1 class="screen-reader-text">
      <?php _e( 'Comment navigation', 'jane' ); ?>
    </h1>
    <div class="nav-previous">
      <?php previous_comments_link( __( '&larr; Older Comments', 'jane' ) ); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link( __( 'Newer Comments &rarr;', 'jane' ) ); ?>
    </div>
  </div>
  <!-- #comment-nav-above -->
  <?php endif; ?>
  <ol class="commentlist">
    <?php
    		if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
		?>
    <li class="decmt-box">
      <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
    <?php
        } elseif ( !comments_open() ) {
    ?>
    <li class="decmt-box">
      <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
    <?php
        } elseif ( !have_comments() ) {
    ?>
    <li class="decmt-box">
      <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
    </li>
    <?php
        } else {
            wp_list_comments('type=comment&callback=jane_comment');
        }
    ?>
  </ol>
  <!-- .comment-list -->
  
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
  <nav id="comment-nav-below" class="comment-navigation" role="navigation">
    <h1 class="screen-reader-text">
      <?php _e( 'Comment navigation', 'casper' ); ?>
    </h1>
    <div class="nav-previous">
      <?php previous_comments_link( __( '&larr; Older Comments', 'casper' ) ); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link( __( 'Newer Comments &rarr;', 'casper' ) ); ?>
    </div>
  </nav>
  <!-- #comment-nav-below -->
  <?php endif;  ?>
  <?php endif;  ?>
  <?php
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
  <p class="no-comments">
    <?php _e( 'Comments are closed.', 'casper' ); ?>
  </p>
  <?php endif; ?>
  <?php comment_form(); ?>
</div>
<!-- #comments --> 
