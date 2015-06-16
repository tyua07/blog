<!--页面底部-->
<div id="footer">
  <?php $options = (ClassicOptions::getOptions()); ?>
  <div class="wrap">
  <div class="foot">
    <p> &copy; Copyright All Rights Reserved.  Designed by <a target="_blank" href="http://www.119800.com/">JaneblogTheme</a> and Powered by <a target="_blank" href="http://www.2zzt.com">WordPress</a>. </p>
    <p><?php echo($options['jane_tongji']); ?> | <?php echo($options['jane_beian']);?></p>
  </div>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>