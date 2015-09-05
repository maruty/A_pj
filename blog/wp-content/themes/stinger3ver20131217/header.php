<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if(is_category()): ?>
<?php elseif(is_archive()): ?>
<meta name="robots" content="noindex">
<?php elseif(is_tag()): ?>
<meta name="robots" content="noindex">
<?php endif; ?>
<title>
<?php
global $page, $paged;
if(is_front_page()):
bloginfo('name');
elseif(is_single()):
wp_title('');
elseif(is_page()):
wp_title('');
elseif(is_archive()):
wp_title('|',true,'right');
bloginfo('name');
elseif(is_search()):
wp_title('-',true,'right');
elseif(is_404()):
echo'404 - ';
bloginfo('name');
endif;
if($paged >= 2 || $page >= 2):
echo'-'.sprintf('%sページ',
max($paged,$page));
endif;
?>
</title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/rogo.ico" />

<!---css切り替え--->
<?php if(is_mobile()) { ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-precomposed.png" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/smart.css" type="text/css" media="all" />
<?php } else { ?>
<meta name="viewport" content="width=1024, maximum-scale=1, user-scalable=yes">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if(is_mobile()) { ?>
<!--アコーディオン-->
<div class="pcnone">
  <div id="s-navi">
    <section class="list6">
      <dl class="acordion">
        <dt class="trigger">
          <p><span class="op">About</span></p>
        </dt>
        <dd class="acordion_tree">
          <ul>
            <li> <a href="<?php echo home_url();?>" title="トップページ">TOP</a> </li>
            <?php wp_nav_menu(array('theme_location' => 'navbar'));?>
          </ul>
          <div class="clear"></div>
        </dd>
      </dl>
    </section>
  </div>
</div>
<!--/アコーディオン-->
<?php
}else{
?>
<?php
}
?>
<div id="container">
<div id="header">
  <div id="header-in">
    <div id="h-l">
      <p class="sitename"><a href="<?php echo home_url(); ?>/">
      	<img src="<?php bloginfo('template_directory'); ?>/images/top_image.png" width="123px" height="100px" border="0px" />
        <?php //bloginfo('name'); ?>
        </a></p>
      <?php if (is_home()) { ?>
      <h1 class="descr">
        <?php //bloginfo('description'); ?>
      </h1>
      <?php } else { ?>
      <p class="descr">
        <?php //bloginfo('description'); ?>
      </p>
      <?php } ?>
    </div>
    <!-- /#h-l --> 
  </div>
  <!-- /#header-in --> 
</div>
<!-- /#header -->
<div id="gazou">
  <!-- /#gazou-in --> 
</div>
<!-- /#gazou -->
<div class="clear"></div>
<?php if(is_mobile()) { ?>
<?php 
}else{
?>
<!--pcnavi-->
<div class="smanone">
  <div id="navi-in">
    <ul>
      <li> <a href="<?php echo home_url();?>" title="トップページ">TOP</a> </li>
      <?php wp_nav_menu(array('theme_location' => 'navbar'));?>
    </ul>
    <div class="clear"></div>
  </div>
</div>
<!--/pcnavi-->
<?php
}
?>
<div id="wrap">
<div id="wrap-in">
<div id="main">
