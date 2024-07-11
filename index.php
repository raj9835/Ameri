<?php
/**
 * Index template.
 *
 * @package Neve
 */

/**
 * Filters the container classes.
 *
 * @param string $classes Container classes.
 *
 * @since 1.0.0
 */
$container_class = apply_filters('neve_container_class_filter', 'container', 'blog-archive');

get_header();

$load_before_after_hooks = get_theme_mod('neve_blog_archive_layout', 'grid') === 'default';

?>
<div class="<?php echo esc_attr($container_class); ?> archive-container">

	<?php
	/**
	 * Executes the rendering function for the featured post.
	 *
	 * @since 3.2
	 */
	do_action('neve_do_featured_post', 'index');
	?>

	<div class="row">
		<?php

		/**
		 * Executes the rendering function for the sidebar.
		 *
		 * @param string $context Sidebar context.
		 * @param string $position Sidebar position.
		 *
		 * @since 1.0.0
		 */
		do_action('neve_do_sidebar', 'blog-archive', 'left');
		?>
		<div class="posts-wrapper">
			<?php
			/**
			 * Executes actions before the posts loop start.
			 *
			 * @since 2.4.0
			 */
			do_action('neve_before_loop');

			/**
			 * Executes the rendering function for the page header.
			 *
			 * @param string $context Header display page.
			 *
			 * @since 2.3.10
			 */
			do_action('neve_page_header', 'index');

			/**
			 * Executes actions before the post loop.
			 *
			 * @since 2.3.10
			 */
			do_action('neve_before_posts_loop');

			if (have_posts()) {
				/* Start the Loop. */
				echo '<div class="' . esc_attr(join(' ', $wrapper_classes)) . '">';

				while (have_posts()) {
					the_post();

					neve_do_loop_hook('entry_before');

					if ($load_before_after_hooks) {
						/**
						 * Executes actions before rendering the post content.
						 *
						 * @since 2.11
						 */
						do_action('neve_loop_entry_before');
					}

					// Display the post content.
					?>
					<div class="blog-main-wrap">

						<div class="news-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<h2><?php echo (get_the_post_thumbnail()); ?></h2>
							</a>
						</div>
						<div class="news-date-wrap">
							<div class="news-title">
								<a href="<?php the_permalink(); ?>">
									<h2><?php echo (get_the_title()); ?></h2>
								</a>
							</div>

							<div class="news-date">
								<?php echo get_the_date(); ?>
							</div>
							<div class="All-content">
								<?php echo get_field("excerpt"); ?>
							</div>
						</div>
						<div class="new-icon"><a class="inform-to" href="<? the_permalink(); ?>">+</a></div>
					</div>
					<?php

					if ($load_before_after_hooks) {
						/**
						 * Executes actions after rendering the post content.
						 *
						 * @since 2.11
						 */
						do_action('neve_loop_entry_after');
					}

					neve_do_loop_hook('entry_after');
				}
				echo '</div>';
				if (!is_singular()) {
					/**
					 * Executes the rendering function for the pagination.
					 *
					 * @param string $context Pagination location context.
					 */
					do_action('neve_do_pagination', 'blog-archive');
				}
			} else {
				get_template_part('template-parts/content', 'none');
			}
			?>
			<div class="w-100"></div>
			<?php
			/**
			 * Executes actions after the post loop.
			 *
			 * @since 2.3.10
			 */
			do_action('neve_after_posts_loop');

			neve_do_loop_hook('after');
			?>
		</div>
		<?php
		do_action('neve_do_sidebar', 'blog-archive', 'right');
		?>
	</div>
</div>
<?php
get_footer();
?>
