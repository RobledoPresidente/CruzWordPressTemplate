<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package robledo-presidente
 */

if ( ! function_exists( 'robledo_presidente_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function robledo_presidente_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>, modificado el <time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = 'Hace ' . human_time_diff( get_the_time('U'), current_time('timestamp') );

	$byline = sprintf(
		esc_html_x( 'por %s', 'post author', 'robledo-presidente' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo $posted_on;

}
endif;

if ( ! function_exists( 'robledo_presidente_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function robledo_presidente_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'robledo-presidente' ) );
		if ( $categories_list && robledo_presidente_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Publicado en %1$s', 'robledo-presidente' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'robledo-presidente' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( ' Etiquetado %1$s', 'robledo-presidente' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( ' Deje un comentario<span class="screen-reader-text"> en %s</span>', 'robledo-presidente' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( ' Editar %s', 'robledo-presidente' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function robledo_presidente_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'robledo_presidente_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'robledo_presidente_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so robledo_presidente_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so robledo_presidente_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in robledo_presidente_categorized_blog.
 */
function robledo_presidente_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'robledo_presidente_categories' );
}
add_action( 'edit_category', 'robledo_presidente_category_transient_flusher' );
add_action( 'save_post',     'robledo_presidente_category_transient_flusher' );


if ( ! function_exists( 'robledo_presidente_youtube_embed' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function robledo_presidente_youtube_embed($url) {

	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	echo '<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="//www.youtube.com/embed/' . $my_array_of_vars['v'] . '" allowfullscreen=""></iframe>
		</div>';  
}
endif;