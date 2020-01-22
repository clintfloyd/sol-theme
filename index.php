<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}
?>
	<header>
		<?php
		echo do_shortcode('[smartslider3 slider=2]');
		?>
	</header>

	<div class="flexy">

		<?php
    query_posts(array(
        'post_type' => 'featured-product',
        'showposts' => 10,
        'ordery_by' => 'id',
        'order' => 'ASC'
    ) );
		?>
		<?php while (have_posts()) : the_post();
			$size = types_render_field("size", array( "output" => "raw"));
			$title = types_render_field("title", array( "output" => "raw"));
			$sub_heading = types_render_field("sub-text", array( "output" => "raw"));
			$image = types_render_field("featured-image", array( "output" => "raw"));
			$link = types_render_field("link", array( "output" => "raw"));
			$color = types_render_field("color", array( "output" => "raw"));
			$textColor = types_render_field("text-color", array( "output" => "raw"));
		?>
						<div class="container <?php echo $size; ?>" style="background-color: <?php echo $color; ?>;">
							<div class="copy-wrapper">
								<a href="<?php echo $link; ?>" style="color: <?php echo $textColor; ?>;">
									<h3><?php echo $title; ?></h3>
									<h4><?php echo $sub_heading; ?></h4>
								</a>
							</div>
							<div class="image-wrapper">
								<figure style="background-image: url('<?php echo $image; ?>'); "></figure>
							</div>
						</div>
		<?php endwhile;?>



	</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
