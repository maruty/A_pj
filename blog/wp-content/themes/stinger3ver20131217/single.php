<?php get_header(); ?>

<div class="kuzu">
  <div id="breadcrumb">
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span> </a> &gt; </div>
    <?php $postcat = get_the_category(); ?>
    <?php $catid = $postcat[0]->cat_ID; ?>
    <?php $allcats = array($catid); ?>
    <?php 
while(!$catid==0) {
    $mycat = get_category($catid);
    $catid = $mycat->parent;
    array_push($allcats, $catid);
}
array_pop($allcats);
$allcats = array_reverse($allcats);
?>
    <?php foreach($allcats as $catid): ?>
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo get_category_link($catid); ?>" itemprop="url"> <span itemprop="title"><?php echo get_cat_name($catid); ?></span> </a> &gt; </div>
    <?php endforeach; ?>
  </div>
</div>
<!--/kuzu-->
<div id="dendo"> </div>
<!-- /#dendo -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
  <!--ループ開始-->
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="kizi">
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
    <div class="blogbox">
      <p><span class="kdate">公開日：
        <time class="entry-date" datetime="<?php the_time('c') ;?>">
          <?php the_time('Y/m/d') ;?>
        </time>
        :
        <?php if ($mtime = get_mtime('Y/m/d')) echo ' 最終更新日：' , $mtime; ?>
        </span>
        <?php the_category(', ') ?>
        <?php the_tags('', ', '); ?>
        <br>
      </p>
    </div>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
  </div>
  <div style="padding:20px 0px;">
    <?php get_template_part('ad');?>
  </div>
<div class="kizi02">
  <?php get_template_part('sns');?>
  </div>
  <?php endwhile; else: ?>
  <p>記事がありません</p>
  <?php endif; ?>
  <!--ループ終了-->
  <div class="kizi02"> 
    <!--関連記事-->
    <h4 class="kanren">関連記事</h4>
    <div class="sumbox02">
      <div id="topnews">
        <div>
          <?php
$categories = get_the_category($post->ID);
$category_ID = array();
foreach($categories as $category):
array_push( $category_ID, $category -> cat_ID);
endforeach ;
$args = array(
'post__not_in' => array($post -> ID),
'posts_per_page'=> 10,
'category__in' => $category_ID,
'orderby' => 'rand',
);
$st_query = new WP_Query($args); ?>
          <?php
if( $st_query -> have_posts() ): ?>
          <?php
while ($st_query -> have_posts()) : $st_query -> the_post(); ?>
          <dl>
            <dt> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
              <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
              <?php echo get_the_post_thumbnail($post->ID, 'thumb110'); ?>
              <?php else: // サムネイルを持っていないときの処理 ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="110px" />
              <?php endif; ?>
              </a> </dt>
            <dd>
              <h4 class="saisin"> <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                </a></h4>
              <p class="basui">
             <?php echo mb_substr( strip_tags( stinger_noshotcode( $post->post_content ) ), 0, 50 ) . ''; ?></p>
              <p class="motto"><a href="<?php the_permalink(); ?>">記事を読む</a></p>
            </dd>
          </dl>
          <?php endwhile;
?>
          <?php else:
?>
          <p>記事はありませんでした</p>
          <?php
endif;
wp_reset_postdata();
?>
        </div>
      </div>
    </div>
  </div>
  <!--/kizi--> 
  <!--/関連記事-->
  <div style="padding:20px 0px;">
    <?php get_template_part('ad');?>
  </div>

  <?php comments_template(); ?>
  <!--ページナビ-->
  <div class="p-navi clearfix">
<dl>
      <?php
        $prev_post = get_previous_post();
        if (!empty( $prev_post )): ?>
       <dt>PREV  </dt><dd><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a></dd>
      <?php endif; ?>
      <?php
        $next_post = get_next_post();
        if (!empty( $next_post )): ?>
         <dt>NEXT  </dt><dd><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a></dd>
      <?php endif; ?>
</dl>
  </div>
</div>
<!-- END div.post -->
<?php get_footer(); ?>
