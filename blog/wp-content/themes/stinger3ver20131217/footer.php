</div>
<!-- /#main -->
<?php get_sidebar(); ?>

<div class="clear"></div>
<!-- /.cler -->
</div>
<!-- /#wrap-in -->

</div>
<!-- /#wrap -->
</div>
<!-- /#container -->
<div id="footer">
  <div id="footer-in">
    <div id="gadf"> </div>
    <h3><a href="<?php echo home_url(); ?>/">
      <?php wp_title(''); ?>
      </a></h3>
    <h4><a href="<?php echo home_url(); ?>/">
      <?php //bloginfo('description'); ?>
      </a></h4>
<!--著作権リンク-->
    <p class="copy">Copyright&copy;
      <?php bloginfo('name');?>
      ,
      <?php the_date('Y');?>
      All Rights Reserved.</p>
  </div>
  <!-- /#footer-in --> 
</div>
<?php wp_footer(); ?>
<!-- ページトップへ戻る -->
<div id="page-top"><a href="#wrapper">PAGE TOP ↑</a></div>

<!-- ページトップへ戻る　終わり --> 
<!---js切り替え--->
<?php if(is_mobile()) { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/smartbase.js"></script>
<?php 
}else{
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/base.js"></script>
<?php
}
?>
<!-- ここにsns02 -->
<?php if ( function_exists('wp_is_mobile') && wp_is_mobile() ) :?>
<?php else: ?>
<?php get_template_part('sns02');?>
<?php endif; ?>
<!-- ここまでsns02 -->


</body></html>