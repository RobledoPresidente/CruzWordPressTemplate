<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package robledo-presidente
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="row mb-3">
		<div class="col-md-5 hidden-lg-up">
			<img class="img-fluid img-thumbnail" src="<?php the_post_thumbnail_url( 'medium_large' ) ?>" alt="Generic placeholder image">
		</div>
		<div class="col-md-5 text-right hidden-md-down">
			<img class="img-fluid img-thumbnail" src="<?php the_post_thumbnail_url( 'medium_large' ) ?>" alt="Generic placeholder image">
		</div>
		<div class="col-md-7 mt-3">
			<h2 class="mt-0 display-5" id="page-title-origin"><?php the_title(); ?></h2>
			<blockquote class="blockquote">
				<p class="mb-0"><?php echo get_the_excerpt(); ?></p>
			</blockquote>
			<p class="text-muted"><?php robledo_presidente_posted_on(); ?></p>
			<?php if ( 'post' == get_post_type() && current_user_can('edit_others_posts') ) : ?>
			<div class="entry-meta">
				<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'robledo-presidente' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'robledo-presidente' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php robledo_presidente_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->