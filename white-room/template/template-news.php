<?php
/**
 * Template Name: 新着情報アーカイブ
 *
 * @author NetBusinessAgent
 * @version 1.0.0
 */
get_header(); ?>

	<header class="page-header">
		<?php whiteroom_the_page_heading(); ?>
		<?php whiteroom_the_bread_crumb(); ?>
	<!-- end .page-header --></header>

	<div class="row">
		<main id="main" role="main" class="col-9">
			<?php
			if ( is_singular() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'content', 'archive' );
				}
			}

			$args = array(
				'post_type' => 'news',
				'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
			);
			if ( is_tax() ) {
				$args = array_merge( $wp_query->query, $args );
			}
			query_posts( $args );
			?>

			<?php if ( have_posts() ) : ?>
				<div class="entries">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content' ); ?>
					<?php endwhile; ?>
					<?php whiteroom_the_pager(); ?>
				<!-- end .entries --></div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		<!-- end #main --></main>
		<aside id="sub" class="col-3">
			<?php get_sidebar(); ?>
		<!-- end #sub --></aside>
	<!-- end .row --></div>
	
<?php get_footer(); ?>