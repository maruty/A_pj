<div id="side">
  <div class="sidead">
<?php if(is_mobile()) { ?>
<?php } else { ?>
<?php get_template_part('ad');?>
<?php } ?>
  </div>
  <div class="kizi02"> 
  	<p>丸山茶太郎</p>
    <p>某金融系SIer（汎用機・・・）→（Web方面の世界へ行きたい）</p>
  
  </div>
  <?php get_search_form(); ?>
  <div class="kizi02"> 
    <!--最近のエントリ-->
    <h4 class="menu_underh2">NEW ENTRY</h4>
    <div id="topnews">
      <div>
<?php
$args = array(
    'posts_per_page' => 5,
);
$st_query = new WP_Query($args);
?>

<?php if( $st_query->have_posts() ): ?>
    <?php while ($st_query->have_posts()) : $st_query->the_post(); ?>
<dl><dt><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
        <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <?php the_post_thumbnail( 'thumb100' ); ?>
<?php else: // サムネイルを持っていないときの処理 ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="100" height="100" />
        <?php endif; ?>
        </a></span></dt><dd><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

<p><?php echo mb_substr( strip_tags( stinger_noshotcode( $post->post_content ) ), 0, 35 ) . ''; ?></p>
</dd>
<p class="clear"></p>
</dl>
    <?php endwhile; ?>
<?php else: ?>
    <p>記事はありませんでした</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
        <p class="motto"> <a href="<?php echo home_url(); ?>/">→もっと見る</a></p>
      </div>
    </div>
    <!--/最近のエントリ-->

    <div id="twibox">
      <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
      <?php endif; ?>
    </div>
  </div>
  <!--/kizi--> 
  <!--アドセンス-->
  <div id="ad1">
    <div style="text-align:center;">
      <?php get_template_part('scroll-ad');?>
    </div>
  </div>
</div>
<!-- /#side -->