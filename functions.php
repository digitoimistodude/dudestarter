<?php
/**
 * THEMENAME functions and definitions
 *
 * @package THEMENAME
 */

/**
 * Remove query strings from static resources
 *
 * @link https://wordpress.org/support/topic/how-to-remove-query-strings-from-static-resources
 */

function _remove_script_version( $src ){
  $parts = explode( '?', $src );
  return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/*
 * ACF options page
 */
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Footer',
    'menu_title'  => 'Footer',
    'menu_slug'   => 'footer',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
  // acf_add_options_sub_page(array(
  //   'page_title'  => '',
  //   'menu_title'  => '',
  //   'parent_slug' => '',
  // ));
  
}

/*
 * Custom icons for admin menus
 */
function fontawesome_dashboard() {
   wp_enqueue_style('fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css', '', '4.4.0', 'all'); 
}
 
add_action('admin_init', 'fontawesome_dashboard');

function fontawesome_icon_dashboard() {
   echo "<style type='text/css' media='screen'>
   #adminmenu .toplevel_page_sivuston-alaosa div.wp-menu-image:before {
   font-family: Fontawesome !important;
   content: '\\f276';
   }
   </style>";
}
add_action('admin_head', 'fontawesome_icon_dashboard');

/*
 * Custom wp-admin CSS
 * Hide useless notifications in admin
 */
function custom_admin_css() {
   echo '<style type="text/css" media="screen">
   #wpseo-dismiss-about, #wcml_translations_message, #ga_analyticator_global_notification { display: none !important; }
   </style>';
}
add_action('admin_head', 'custom_admin_css');

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/*
 * All times and local units in Finnish.
 */
setlocale(LC_ALL, 'fi_FI.utf8');

/*
 * More accurate time in WP Last Login.
 */
function my_last_login( ) {
return 'j.m.Y, H:i';
}
add_filter('wpll_date_format', 'my_last_login');

/*
 * Custom uploads folder instead of default content/uploads.
 * Comment these out if you want to set up media library folder in wp-admin.
 */
update_option( 'upload_path', untrailingslashit( str_replace( 'wp', 'media', ABSPATH ) ) );
update_option( 'upload_url_path', untrailingslashit( str_replace( 'wp', 'media', get_site_url() ) ) );
define( 'uploads', ''.'media' );
add_filter( 'option_uploads_use_yearmonth_folders', '__return_false', 100 );

/*
 * Hidden blog menu items by default.
 * Comment these out if you want to use blog or comments.
 */
function menuitems_remove() { 
   remove_menu_page('edit.php');
   remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'menuitems_remove');

/*
 * Hiding things customers won't usually need.
 * Hides Tools, Themes, Customize, Widgets, Plugins, Custom Fields, Feedback and Jetpack by default.
 */
function remove_admin_menu_links() {
    $user = wp_get_current_user();
    if( $user && isset($user->user_email) && 'roni@dude.fi' == $user->user_email || 'juha@dude.fi' == $user->user_email ) {
      
      // For testing:
      // if( $user && isset($user->user_email) && 'roni@dude.fi' == $user->user_email) { 

    } else {

        remove_menu_page('tools.php');
        remove_menu_page('themes.php?page=editcss');
        remove_menu_page('customize.php');
        remove_menu_page('widgets.php');
        remove_menu_page('plugins.php');
        remove_menu_page('edit.php?post_type=acf');
        remove_menu_page('edit.php?post_type=feedback');
        remove_menu_page('admin.php?page=jetpack');

  }

}
add_action('admin_menu', 'remove_admin_menu_links', 999);
remove_theme_support( 'genesis-admin-menu' );

/**
 * Automatic Feed Links is a theme feature introduced with Version 3.0. This feature adds RSS feed links to HTML <head>.
 *
 * @link https://codex.wordpress.org/Automatic_Feed_Links
 */
add_theme_support( 'automatic-feed-links' );

/*
 * Dude scripts
 * Sets up theme defaults and registers support for various WordPress features.
 */

/**
 * Enable language support.
 *
 * @link https://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
load_theme_textdomain( 'THEMENAME', get_template_directory() . '/languages' );

/**
 * Custom jQuery.
 * Disable WordPress core jQuery and use your own library.
 *
 * @link https://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/
 */
if (!is_admin() ) add_action("wp_enqueue_scripts", "oma_jquery", 1);
function oma_jquery() {
   wp_deregister_script('jquery');
   // jQuery will no longer be needed separately (below), because jquery.js is bundled with js/all.js and bower.
   // wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/src/jquery.js', array(), '1.10.2', false );
}

/**
 * Custom comments and pingbacks.
 * A Strategy To Separate Comments and Pingbacks in WordPress
 * 
 * See also templates comments.php, callback-comments.php and callback-pingbacks.php.
 * If you use Disqus Comment System or Jetpack for comments they will naturally replace WordPress comment templates.
 *
 * @link https://tommcfarlin.com/separate-comments-and-pingbacks/
 */
function acme_post_has( $type, $post_id ) {
 
  $comments = get_comments('status=approve&type=' . $type . '&post_id=' . $post_id );
  $comments = separate_comments( $comments );
 
  return 0 < count( $comments[ $type ] );
}

function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('<span class="commentposted">Posted on %1$s at %2$s</span>', 'THEMENAME'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'THEMENAME'), ' <span class="edit-link">', '</span>'); ?>

            <?php // echo the comment reply link
             if($args['type'] == 'all' || get_comment_type() == 'comment') :
                 comment_reply_link(array_merge($args, array(
                     'reply_text' => __('Reply','THEMENAME'),
                     'login_text' => __('Log in to reply.','THEMENAME'),
                     'depth' => $depth,
                     'before' => '<span class="comment-reply-link">',
                     'after' => '</span>'
                 )));
            endif;
        ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'THEMENAME') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'THEMENAME'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'THEMENAME'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') esc_html_e( '\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'THEMENAME') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 50 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link

/*
 * Don't count pingbacks or trackbacks when determining
 * the number of comments on a post.
 */
function comment_count( $count ) {
  global $id;
  $comment_count = 0;
  $comments = get_approved_comments( $id );
  foreach ( $comments as $comment ) {
    if ( $comment->comment_type === '' ) {
      $comment_count++;
    }
  }
  return $comment_count;
}
add_filter( 'get_comments_number', 'comment_count', 0 );

/*
 * Enqueue scripts and styles.
 */
function THEMENAME_scripts() {
    wp_enqueue_style( 'layout', get_template_directory_uri() . '/css/layout.css' );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/all.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'THEMENAME_scripts' );

/*
 * Enable support for Post Thumbnails on posts and pages. (Featured images)
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support( 'post-thumbnails' );

/*
 * Enable support for Post Formats.
 * See https://developer.wordpress.org/themes/functionality/post-formats/
 */
add_theme_support( 'post-formats', array(
  'aside',
  'image',
  'video',
  'quote',
  'link',
) );

/*
 * Editable navigation menus.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );

/**
 * Remove WordPress Admin Bar
 *
 * @link http://davidwalsh.name/remove-wordpress-admin-bar-css
 */
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
        remove_action('wp_head', '_admin_bar_bump_cb');
}
show_admin_bar(false);

/*
 * Custom dude navigation walker based on bootstrap navigation.
 */
require get_template_directory() . '/inc/dude-wp-navwalker.php';

/*
 * Custom dude search form.
 */
function dude_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'dude_search_form' );

/*
 * Custom functions that act independently of the theme templates.
 *
 * Only extras we need.
 * Originally in underscores: require get_template_directory() . '/inc/extras.php';
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
  /**
   * Filters wp_title to print a neat <title> tag based on what is being viewed.
   *
   * @param string $title Default title text for current view.
   * @param string $sep Optional separator.
   * @return string The filtered title.
   */
  function THEMENAME_wp_title( $title, $sep ) {
    if ( is_feed() ) {
      return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
      $title .= " $sep " . sprintf( __( 'Page %s', 'THEMENAME' ), max( $paged, $page ) );
    }

    return $title;
  }
  add_filter( 'wp_title', 'THEMENAME_wp_title', 10, 2 );

  /**
   * Title shim for sites older than WordPress 4.1.
   *
   * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
   * @todo Remove this function when WordPress 4.3 is released.
   */
  function THEMENAME_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
  }
  add_action( 'wp_head', 'THEMENAME_render_title' );
endif;

/**
 * Load Jetpack compatibility.
 * Originally in the separate file: require get_template_directory() . '/inc/jetpack.php';
 * I don't see why it could not be here.
 *
 * Add theme support for Infinite Scroll.
 * @link http://jetpack.me/support/infinite-scroll/
 */
function THEMENAME_jetpack_setup() {
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'footer'    => 'page',
  ) );
}
add_action( 'after_setup_theme', 'THEMENAME_jetpack_setup' );

/**
 * Archives functionality.
 * Originally in Underscores template tags.
 */

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
  if ( is_category() ) {
    $title = sprintf( __( 'Category: %s', 'THEMENAME' ), single_cat_title( '', false ) );
  } elseif ( is_tag() ) {
    $title = sprintf( __( 'Tag: %s', 'THEMENAME' ), single_tag_title( '', false ) );
  } elseif ( is_author() ) {
    $title = sprintf( __( 'Author: %s', 'THEMENAME' ), '<span class="vcard">' . get_the_author() . '</span>' );
  } elseif ( is_year() ) {
    $title = sprintf( __( 'Year: %s', 'THEMENAME' ), get_the_date( _x( 'Y', 'yearly archives date format', 'THEMENAME' ) ) );
  } elseif ( is_month() ) {
    $title = sprintf( __( 'Month: %s', 'THEMENAME' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'THEMENAME' ) ) );
  } elseif ( is_day() ) {
    $title = sprintf( __( 'Day: %s', 'THEMENAME' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'THEMENAME' ) ) );
  } elseif ( is_tax( 'post_format' ) ) {
    if ( is_tax( 'post_format', 'post-format-aside' ) ) {
      $title = _x( 'Asides', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
      $title = _x( 'Galleries', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
      $title = _x( 'Images', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
      $title = _x( 'Videos', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
      $title = _x( 'Quotes', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
      $title = _x( 'Links', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
      $title = _x( 'Statuses', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
      $title = _x( 'Audio', 'post format archive title', 'THEMENAME' );
    } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
      $title = _x( 'Chats', 'post format archive title', 'THEMENAME' );
    }
  } elseif ( is_post_type_archive() ) {
    $title = sprintf( __( 'Archives: %s', 'THEMENAME' ), post_type_archive_title( '', false ) );
  } elseif ( is_tax() ) {
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
    $title = sprintf( __( '%1$s: %2$s', 'THEMENAME' ), $tax->labels->singular_name, single_term_title( '', false ) );
  } else {
    $title = __( 'Archives', 'THEMENAME' );
  }

  /**
   * Filter the archive title.
   *
   * @param string $title Archive title to be displayed.
   */
  $title = apply_filters( 'get_the_archive_title', $title );

  if ( ! empty( $title ) ) {
    echo $before . $title . $after;
  }
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
  $description = apply_filters( 'get_the_archive_description', term_description() );

  if ( ! empty( $description ) ) {
    /**
     * Filter the archive description.
     *
     * @see term_description()
     *
     * @param string $description Archive description to be displayed.
     */
    echo $before . $description . $after;
  }
}
endif;

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
  // Don't print empty markup if there's only one page.
  if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
  }
  ?>
  <nav class="navigation posts-navigation" role="navigation">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'THEMENAME' ); ?></h2>
    <div class="nav-links">

      <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'THEMENAME' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'THEMENAME' ) ); ?></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;
