<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package robledo-presidente
 */

get_header(); ?>

	<div class="container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if (have_posts()) : ?>

                <?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf(__( 'Resultados de b�squeda para: %s', 'robledo-presidente' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php printf(__( 'No se encontraron resultados', 'robledo-presidente' )); ?></h1>
		<?php endif; ?>


                <div class="row">


                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        ?>
                        <div class="col-md-4">
                            <a href="<?php the_permalink(); ?>" class="card">
                                <div class="card-image-header" style="background-image: url(<?php the_post_thumbnail_url('medium') ?>)">
                                    <div class="card-img-overlay">
                                        <div class="card-content bottom">
                                            <h4 class="card-title"><?php the_title() ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-text"><small class="text-muted"><?php echo 'Hace ' . human_time_diff(get_the_time('U'), current_time('timestamp')); ?></small></div>
                                <div class="card-text"><?php echo get_the_excerpt(); ?></div>
                            </a>
                        </div>
                        <!-- /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                         /*get_template_part( 'template-parts/content', get_post_format() );*/-->

                        <?php
                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>

            </div>



        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .container-fluid -->
<?php
get_footer();
