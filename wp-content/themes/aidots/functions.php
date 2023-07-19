<?php
/**
 * Functions and definitions
 *
 * 
 */


function dots_theme_setup() 
{
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size ('home-featured', 680, 400, array('center', 'center'));
    add_image_size ('single-post', 580, 272, array('center', 'center'));
    add_image_size ('portfolio-thumb', 374, 260, array('center', 'center'));

    add_theme_support('automatic-feed-links');

    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'Dots' )
    ) );
    
};
add_action('after_setup_theme', 'dots_theme_setup');

function dotsScript()
{    
    /* Included CSS */
    wp_enqueue_style('bootstrapcss', get_template_directory_uri(). '/assets/css/bootstrap.min.css');
    wp_enqueue_style('aos', get_template_directory_uri(). '/assets/css/aos.css');
    wp_enqueue_style('variablescss', get_template_directory_uri(). '/assets/css/variables.css');
    wp_enqueue_style('maincss', get_template_directory_uri(). '/assets/css/main.css');
    wp_enqueue_style('owlcarouselmin', get_template_directory_uri(). '/assets/css/owl.carousel.min.css');
    wp_enqueue_style('fontawesomeallmin', get_template_directory_uri(). '/assets/css/fontawesome-all.min.css');
    wp_enqueue_style('style', get_stylesheet_uri());
  
    /* Included Javascript */
    wp_enqueue_script('jquery', get_template_directory_uri(). '/assets/js/jquery-3.6.0.min.js');
    wp_enqueue_script('owlcarouselmin', get_template_directory_uri(). '/assets/js/owl.carousel.min.js');
    wp_enqueue_script('jqueryvalidate', get_template_directory_uri(). '/assets/js/jquery.validate.min.js');
    wp_enqueue_script('bootstrapbundle', get_template_directory_uri(). '/assets/js/bootstrap.bundle.min.js');
    wp_enqueue_script('aosjs', get_template_directory_uri(). '/assets/js/aos.js');    
    wp_enqueue_script('mainjs', get_template_directory_uri(). '/assets/js/main.js');    
    wp_enqueue_script('fontawesomealljs', get_template_directory_uri(). '/assets/js/fontawesome-all.js');    
    wp_enqueue_script('isotopepkgdminjs', get_template_directory_uri(). '/assets/js/isotope.pkgd.min.js');    
    wp_enqueue_script('typedmin', 'https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js');    
}
add_action('wp_enqueue_scripts', 'dotsScript');

remove_action('wp_head', '_wp_render_title_tag', 1);


class AI_Walker_Nav_Menu extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"ul-color\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

    // Check our custom has_children property.here is the points
    if(in_array('menu-item-has-children', $classes ) && $depth == 0) {
       // Your Code
      $class_names = ' class="dropdown  ' . esc_attr( $class_names ) . '"';
    } else {
      $class_names = ' class="' . esc_attr( $class_names ) . '"';
    }

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $item_output = $args->before;
    $depthLinkClass='';

    // Check our custom has_children property.here is the points
    if(in_array('menu-item-has-children', $classes ) && $depth == 0) {
      $depthLink ='<i class="fas fa-chevron-down"></i>';
      $depthLinkClass = 'scrollto';
    }else{
      $depthLink='';
    }
    $item_output .= '<a'. $attributes . 'class="nav-link '.$depthLinkClass.' " >';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .=$depthLink.'</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/*********add class dropdown with nav menu childrenclass end *****/




// Wp v4.7.1 and higher
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


// logo custom

add_filter( 'get_custom_logo', 'change_logo_class' );
function change_logo_class( $html ) {
    $html = str_replace( 'custom-logo', 'logo d-flex align-items-center scrollto me-auto me-lg-0 pos-rel', $html );
    $html = str_replace( 'custom-logo-link', 'logo d-flex align-items-center scrollto me-auto me-lg-0 pos-rel', $html );
    return $html;
}


function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1'),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.'),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2'),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.'),
			)
		)
	);

  // Footer #3.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #3'),
				'id'          => 'sidebar-3',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.'),
			)
		)
	);

  // Footer #4.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer copyright'),
				'id'          => 'sidebar-4',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.'),
			)
		)
	);

  // Footer #4.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Side bar'),
				'id'          => 'sidebar-5',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.'),
			)
		)
	);


}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/********************Enquiry Form  ***********************/

add_action('wp_ajax_enquiryaction','enquiryForm');
add_action('wp_ajax_nopriv_enquiryaction', 'enquiryForm');

function enquiryForm(){
include('enquiryAction.php');
}

include('custum-field-functions.php');




/***************Custom post cuse study****************/

// init function
add_action( 'init', 'create_post_type_case_studies' );

function create_post_type_case_studies() {
	$args = array(
        'labels' => channel_labels( 'Case Studies' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
       // 'show_in_rest' => true,
        'supports' => array('title',
            'editor',
            'author',
            'thumbnail',
            //'excerpt',
            //'comments',
			'custom-fields',
			'page-attributes'
        ),

		'taxonomies' => array( 'cat-case-studies' ),
		'menu_icon' => 'dashicons-analytics',
        'has_archive' => true

    ); 

	register_post_type( 'Case Studies', $args );
}

// A helper function for generating the labels
function channel_labels( $singular, $plural = '' )
{

    if( $plural == '') $plural = $singular .'';

    return array(
        'name' => _x( $plural, 'post type general name' ),
        'singular_name' => _x( $singular, 'post type singular name' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New '. $singular ),
        'edit_item' => __( 'Edit '. $singular ),
        'new_item' => __( 'New '. $singular ),
        'view_item' => __( 'View '. $singular ),
        'search_items' => __( 'Search '. $plural ),
        'not_found' =>  __( 'No '. $plural .' found' ),
        'not_found_in_trash' => __( 'No '. $plural .' found in Trash' ), 
        'parent_item_colon' => ''
    );
}


// init function
add_action( 'init', 'create_post_type_technology_stack' );

function create_post_type_technology_stack() {
	$args = array(
        'labels' => channel_labels( 'Technology Stack' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title',
            'editor',
            'author',
            'thumbnail',
            //'excerpt',
            //'comments',
			'custom-fields',
			'page-attributes'
        ),

		'taxonomies' => array( 'cat-technology_stack' ),
		//'menu_icon' => ,
        'has_archive' => true

    ); 

	register_post_type( 'technology_stack', $args );
}

// init function
add_action( 'init', 'create_post_type_testimonial' );

function create_post_type_testimonial() {
	$args = array(
        'labels' => channel_labels( 'Testimonial' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title',
            'editor',
            //'author',
            //'thumbnail',
            //'excerpt',
            //'comments',
			'custom-fields',
			'page-attributes'
        ),

		'taxonomies' => array( 'cat-testimonial' ),
		'menu_icon' =>'dashicons-testimonial',
        'has_archive' => true

    ); 

	register_post_type( 'testimonial', $args );
}


//get_comment_author_email

function wpdocs_notify_my_mail( $comment_id, $comment_approved ) {
	if ( ! $comment_approved ) {
		$comment = get_comment( $comment_id );
    update_comment_meta($comment->comment_ID,'comment_email_verify','false');
		//$mail = 'surendra.parihar@dotsquares.com';
    $to  =$comment->comment_author_email;
  
		$subject = sprintf( 'Comment Email Verification Link  by: AI Dotsquares');
    $activeLink =get_permalink($comment->comment_post_ID).'?email_varify='.$to.'&cid=comment-'.$comment->comment_ID;
    $message ='Hello '.$comment->comment_author;
    $message .="\r\n";
    $message .="\r\n";
    $message .='Please Verify of Your Comment Email';
    $message .="\r\n";
    $message .="\r\n";
    $message .=$activeLink;
		wp_mail($to, $subject, $message);
	}else{
    update_comment_meta($comment_id,'comment_email_verify','true');
  }
}
add_action( 'comment_post', 'wpdocs_notify_my_mail', 10, 2 );

add_action( 'add_meta_boxes_comment', 'email_comment_meta_box' );
function email_comment_meta_box( $comment ) { // WP_Comment object

	add_meta_box( 
		'email_comment_varify', 
		'Comment User Email Verify', 
		'email_comment_meta_box_varify', 
		'comment', // instead of a post type parameter
		'normal'
	);
	
}

function email_comment_meta_box_varify($comment) {
	$comment_email_verify = get_comment_meta( $comment->comment_ID, 'comment_email_verify', true );

	wp_nonce_field( 'comment_email_verify_update', 'comment_nonce' );
	?>
		<table class="form-table">
			<tr>
				<th><label for="comment_email_verify">Email verify</label></th>
				<td>
					<select id="comment_email_verify" name="comment_email_verify">
						<option value="">Email verify</option>
            <option value="true" <?php if($comment_email_verify=='true'){ echo 'Selected'; } ?> >verify</option>
            <option value="false" <?php if($comment_email_verify=='false'){ echo 'Selected'; } ?> >Not verify</option>
					</select>
				</td>
			</tr>
		</table>
	<?php
}

add_action( 'edit_comment', 'email_verify_save_comment' );
function email_verify_save_comment( $comment_id ) {

	if( ! isset( $_POST[ 'comment_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'comment_nonce' ], 'comment_email_verify_update' ) ) {
		return;
	}

	update_comment_meta($comment_id,'comment_email_verify',$_POST[ 'comment_email_verify' ]);
}

function myplugin_comment_columns( $columns )
{
	$columns['email_comment_varify'] = __( 'Email Verify');
	return $columns;
}
add_filter( 'manage_edit-comments_columns', 'myplugin_comment_columns' );

function myplugin_comment_column( $column, $comment_ID )
{
	if ( 'email_comment_varify' == $column ) {
		if ( $meta = get_comment_meta( $comment_ID, 'comment_email_verify' , true ) ) {
			//echo $meta;
      if($meta=='true'){
        echo 'Verify';
      }else{
        echo 'Not verify';
      }
		}
	}
}
add_filter( 'manage_comments_custom_column', 'myplugin_comment_column', 10, 2 );


// init function
add_action( 'init', 'create_post_type_products' );

function create_post_type_products() {
	$args = array(
        'labels' => channel_labels( 'Products' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title',
            'editor',
            'author',
            'thumbnail',
            //'excerpt',
            //'comments',
			'custom-fields',
			'page-attributes'
        ),

		'taxonomies' => array( 'cat-products' ),
		'menu_icon' =>'dashicons-products' ,
        'has_archive' => true

    ); 

    $tax_args =array('hierarchical' => true,     /* if this is true it acts like categories */             
    'labels' => array(
      'name' => __( 'Category' ), /* name of the custom taxonomy */
      'singular_name' => __( ucwords('Products').' Category' ), /* single taxonomy name */
      'search_items' =>  __( 'Search '.ucwords('Products').' Category' ), /* search title for taxomony */
      'all_items' => __( 'All '.ucwords('Products').' Category' ), /* all title for taxonomies */
      'parent_item' => __( 'Parent '.ucwords('Products').' Category' ), /* parent title for taxonomy */
      'parent_item_colon' => __( 'Parent '.ucwords('Products').' Category:' ), /* parent taxonomy title */
      'edit_item' => __( 'Edit '.ucwords('Products').' Category' ), /* edit custom taxonomy title */
      'update_item' => __( 'Update '.ucwords('Products').' Category' ), /* update title for taxonomy */
      'add_new_item' => __( 'Add New '.ucwords('Products').' Category' ), /* add new title for taxonomy */
      'new_item_name' => __( 'New '.ucwords('Products').' Category' ) /* name title for taxonomy */
    ),
    'show_ui' => true,
    'query_var' => true,
    'show_admin_column' => true
  );


	register_post_type( 'products', $args );
  register_taxonomy('cat-products','products',$tax_args);
}

