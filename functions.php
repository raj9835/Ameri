<?php
define("CPT_INVESTMENT", 'investment'); 
define("CPT_TEAM",'team');

function add_my_custom_scripts()
{
    wp_enqueue_style('google-fonts-style',"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");

    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('custom-style1', get_stylesheet_directory_uri() . '/assets/css/main-style.css');
    wp_enqueue_style('responsive-style', get_stylesheet_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');



function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("Theme-panel");
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	add_menu_page("Theme panel", "Theme panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
    
}

add_action("admin_menu", "add_theme_menu_item");


function display_phoneno_element()
{
	?>
    	<input type="text" name="phoneno" id="phoneno" value="<?php echo get_option('phoneno'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_linkedin_element()
{
	?>
    	<input type="text" name="linkedin_url" id="linkedin_url" value="<?php echo get_option('linkedin_url'); ?>" />
    <?php
}

function display_instagram_element()
{
	?>
    	<input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_address_element()
{
	?>
    	<input type="text" name="address" id="address" value="<?php echo get_option('address'); ?>" />
    <?php
}

function display_email_element()
{
	?>
    	<input type="text" name="email" id="email" value="<?php echo get_option('email'); ?>" />
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "Theme-panel");
    add_settings_field("phoneno", "phoneno", "display_phoneno_element", "Theme-panel", "section");
	add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "Theme-panel", "section");
    add_settings_field("linkedin_url", "linkedin Profile Url", "display_linkedin_element", "Theme-panel", "section");
    add_settings_field("instagram_url", "instagram Profile Url", "display_instagram_element", "Theme-panel", "section");
    add_settings_field("twitter_url", "twitter Profile Url", "display_twitter_element", "Theme-panel", "section");
	add_settings_field("email", "email", "display_email_element", "Theme-panel", "section");
	add_settings_field("address", "address", "display_address_element", "Theme-panel", "section");
   
    register_setting("section", "phoneno");
    register_setting("section", "facebook_url");
    register_setting("section", "linkedin_url");
    register_setting("section", "instagram_url");
    register_setting("section", "twitter_url");  
    register_setting("section", "address");
	register_setting("section", "email");
 
    
}

add_action("admin_init", "display_theme_panel_fields");


function my_sociallink()
{
    ob_start();
	?>
	<ul class="socialicon-link" >

    <?php
            if(!get_option('phoneno')=='')
            {
        ?>
        <li class="phoneno" ><a href="tel:<?php echo esc_attr( get_option('phoneno') ); ?>" ><i class="fa fa-phoneno"></i><span><?php echo esc_attr( get_option('phoneno') ); ?></span></a></li>
        <?php
            }
        ?>  

		<?php
			if(!get_option('facebook_url')=='')
			{
		?>
		<li class="facebook" ><a href="<?php echo esc_attr( get_option('facebook_url') ); ?>" target="_blank" ><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
		<?php
	         }
		?>

        <?php
            if(!get_option('linkedin_url')=='')
            {
        ?>
        <li class="linkedin" ><a href="<?php echo esc_attr( get_option('linkedin_url') ); ?>" target="_blank" ><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li>
        <?php
            }
        ?>
			 
        
	</ul>
	<?php
    return ob_get_clean();
}
add_shortcode('sociallink','my_sociallink');

/*---get contact us contact details----*/
function my_contact()
{
    ?>
    <ul class='contact'>
    <?php

            if(!get_option('address')=='')
            {
            ?>
            <li class="address" > <i class="fa fa-map-marker" ><p>ADDRESS</p></i><p>
            <?php  echo esc_attr( get_option('address') );?></p></li>
            <?php
            }?>

            <?php
            $phone_number = get_option('phoneno');
            if (!empty($phone_number)) {
            ?>
            <li class="phoneno">
                <i class="fa-solid fa-phone-volume"></i>
                <a href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
            </li>
            <?php
            }
            ?>

        
            <?php        
            if(!get_option('email')=='')
            {
        ?>
        <li class="email" ><i class="fa fa-envelope"></i><a href="mailto:<?php  echo esc_attr( get_option('email') );?>">
       <p> <?php  echo esc_attr( get_option('email') );?></a></p></li>
        <?php
            }
        ?>
        
       
        </ul>
        <?php
        
}

add_shortcode('contactlink','my_contact');
//////////////////

function create_investment_post_type()
{
    $labels = array(
        'name'                  => _x('Investment', 'Post type general name', 'neve-child'),
        'singular_name'         => _x('Investment', 'Post type singular name', 'neve-child'),
        'menu_name'             => _x('Investment', 'Admin Menu text', 'neve-child'),
        'name_admin_bar'        => _x('Investment', 'Add New on Toolbar', 'neve-child'),
        'add_new'               => __('Add New', 'neve-child'),
        'add_new_item'          => __('Add New Investment', 'neve-child'),
        'new_item'              => __('New Investment', 'neve-child'),
        'edit_item'             => __('Edit Investment', 'neve-child'),
        'view_item'             => __('View Investment', 'neve-child'),
        'all_items'             => __('All Investment', 'neve-child'),
        'search_items'          => __('Search Investment', 'neve-child'),
        'parent_item_colon'     => __('Investment:', 'neve-child'),
        'not_found'             => __('No Investment found.', 'neve-child'),
        'not_found_in_trash'    => __('No Investment found in Trash.', 'neve-child'),
        'featured_image'        => _x('Investment Cover Image', 'neve-child'),
        'set_featured_image'    => _x('Set featured image', 'neve-child'),
        'remove_featured_image' => _x('Remove featured image', 'neve-child'),
        'use_featured_image'    => _x('Use as featured image',  'neve-child'),
        'archives'              => _x('Investment Archives',  'neve-child'),
        'insert_into_item'      => _x('Insert into  Osg',  'neve-child'),
        'uploaded_to_this_item' => _x('Uploaded to this Osg', 'neve-child'),
        'filter_items_list'     => _x('Investment list', 'neve-child'),
        'items_list_navigation' => _x('Investment list navigation', 'neve-child'),
        'items_list'            => _x('Investment list', 'neve-child'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'investment'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'thumbnail','editor','excerpt'),
        
    );

    register_post_type(CPT_INVESTMENT, $args);
}

add_action('init', 'create_investment_post_type');

/*--------------------REGISTER CUSTOM TAXONOMY------------------------------------*/
function create_categories_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Categories', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Categories', 'textdomain' ),
        'all_items'         => __( 'All Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Categories', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Categories:', 'textdomain' ),
        'edit_item'         => __( 'Edit Categories', 'textdomain' ),
        'update_item'       => __( 'Update Categories', 'textdomain' ),
        'add_new_item'      => __( 'Add New Categories', 'textdomain' ),
        'new_item_name'     => __( 'New Categories Name', 'textdomain' ),
        'menu_name'         => __( 'Categories', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'investment category' ),
    );

    register_taxonomy( 'investment category', array(CPT_INVESTMENT), $args );
}
add_action( 'init', 'create_categories_taxonomies', 0 );


/////////////////////////
function get_our_service()
{
    ob_start();
    $args = array(
        'post_type' => 'investment',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'investment category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'equity', // Replace with the specific category slug you want to query
            ),
        ),
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='service-release equity-lister'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="service-release-section-wrap">';
            $result .= '<div class="service-thumbnail"><a href="' . esc_url(get_field('site_link')) . '" target="_blank">' . get_the_post_thumbnail() . '</a></div>';
            // $result .= '<div class="title-date-wrap">';
            // $result .= '<div class="service-title"><a href="' . get_the_permalink() . '"><h2>' . get_field('amount') . '</h2></a></div>';
            // $result .= '<div class="service-content">' .get_field('facility') . '</div>';
            // $result .= '<div class="services-content">' . get_field('services') . '</div>';
            // $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . esc_url(get_field('site_link')) . '" target="_blank">+</a></div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";
    }

    return $result;
    return ob_get_clean();
}
add_shortcode('get_our_service', 'get_our_service');

////////////////////////////////////////

function get_our_loans()
{
    ob_start();
    $args = array(
        'post_type' => 'investment',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'investment category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'loans', // Replace with the specific category slug you want to query
            ),
        ),
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='service-release'>";
      
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="service-release-section-wrap">';
            $result .= '<div class="service-thumbnail"><a href="' . get_the_permalink() . '"> '. get_the_post_thumbnail() .' </a></div>';
            $result .= '<div class="title-date-wrap">';
            $result .= '<div class="service-title"><a href="' . get_the_permalink() . '"><h2>' . get_field('amount')  . '</h2></a></div>';
            $result .= '<div class="service-content">' . get_field('facility') . '</div>';
            $result .= '<div class="services-content">' . get_field('services') . '</div>';
            $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . get_the_permalink() . '">+</a></div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";
    }

    return $result;
    return ob_get_clean();
}
add_shortcode('get_our_loans', 'get_our_loans');

/*-----CPT TEAM----*/
function create_team_post_type()
{
    $labels = array(
        'name'                  => _x('Team', 'Post type general name', 'neve-child'),
        'singular_name'         => _x('Team', 'Post type singular name', 'neve-child'),
        'menu_name'             => _x('Team', 'Admin Menu text', 'neve-child'),
        'name_admin_bar'        => _x('Team', 'Add New on Toolbar', 'neve-child'),
        'add_new'               => __('Add New', 'neve-child'),
        'add_new_item'          => __('Add New Team', 'neve-child'),
        'new_item'              => __('New Team', 'neve-child'),
        'edit_item'             => __('Edit Team', 'neve-child'),
        'view_item'             => __('View Team', 'neve-child'),
        'all_items'             => __('All Team', 'neve-child'),
        'search_items'          => __('Search Team', 'neve-child'),
        'parent_item_colon'     => __('Team:', 'neve-child'),
        'not_found'             => __('No Team found.', 'neve-child'),
        'not_found_in_trash'    => __('No Team found in Trash.', 'neve-child'),
        'featured_image'        => _x('Team Cover Image', 'neve-child'),
        'set_featured_image'    => _x('Set featured image', 'neve-child'),
        'remove_featured_image' => _x('Remove featured image', 'neve-child'),
        'use_featured_image'    => _x('Use as featured image',  'neve-child'),
        'archives'              => _x('Team Archives',  'neve-child'),
        'insert_into_item'      => _x('Insert into  Osg',  'neve-child'),
        'uploaded_to_this_item' => _x('Uploaded to this Osg', 'neve-child'),
        'filter_items_list'     => _x('Team list', 'neve-child'),
        'items_list_navigation' => _x('Team list navigation', 'neve-child'),
        'items_list'            => _x('Team list', 'neve-child'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'team'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'thumbnail','editor','excerpt'),
        
    );

    register_post_type(CPT_TEAM, $args);
}

add_action('init', 'create_team_post_type');

/*--------------------REGISTER CUSTOM TAXONOMY FOR CPT TEAM------------------------------------*/
function create_team_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Categories', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Categories', 'textdomain' ),
        'all_items'         => __( 'All Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Categories', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Categories:', 'textdomain' ),
        'edit_item'         => __( 'Edit Categories', 'textdomain' ),
        'update_item'       => __( 'Update Categories', 'textdomain' ),
        'add_new_item'      => __( 'Add New Categories', 'textdomain' ),
        'new_item_name'     => __( 'New Categories Name', 'textdomain' ),
        'menu_name'         => __( 'Categories', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'team category' ),
    );

    register_taxonomy( 'team category', array(CPT_TEAM), $args );
}
add_action( 'init', 'create_team_taxonomies', 0 );

function get_our_executive()
{
    ob_start();
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'team category', 
                'field' => 'slug', 
                'terms' => 'executive-team', 
            ),
        ),
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='executive-team'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="executive-all-wrap">'; 
            $result .= '<div class="executive-member-wrap">'; 
            $result .= '<div class="executive-thumbnail">' . get_the_post_thumbnail() . '</div>';
            $result .= '<div class="executive-new-wrap">';
            $result .= '<div class="executive-title">' . get_the_title() . '</div>';
            $result .= '<div class="executive-excerpt">' . get_the_excerpt() . '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '<div class="executive-content">' . get_the_content() . '</div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";
    }

    echo $result;
    return ob_get_clean();
}
add_shortcode('get_our_executive', 'get_our_executive');


function get_our_business()
{
    ob_start();
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'team category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'new-business', // Replace with the specific category slug you want to query
            ),
        ),
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='business-team'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="executive-all-wrap">'; 
            $result .= '<div class="executive-member-wrap">'; 
            $result .= '<div class="executive-thumbnail">' . get_the_post_thumbnail() . '</div>';
            $result .= '<div class="executive-new-wrap">';
            $result .= '<div class="executive-title">' . get_the_title() . '</div>';
            $result .= '<div class="executive-excerpt">' . get_the_excerpt() . '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '<div class="executive-content">' . get_the_content() . '</div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";
    }
    
    echo $result;
    return ob_get_clean();
}
add_shortcode('get_our_business', 'get_our_business');


//News page Tabbing (All)
function get_our_All_post()
{
    ob_start();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get the current page number
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5, // Number of posts to display per page
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'all', // Replace with the specific category slug you want to query
            ),
        ),
        'paged' => $paged, // Pass the current page number to the query
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='All-team'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="All-wrap">'; 
            $result .= '<div class="All-thumbnail"><a href="' . get_the_permalink() . '"> '. get_the_post_thumbnail() .' </a></div>';
            $result .= '<div class="All-new-wrap">';
            $result .= '<div class="All-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a> </div>';
            $result .= '<div class="All-date">' . get_the_date() . '</div>';
            $result .= '<div class="All-content">' . get_field( "excerpt" ) . '</div>';
            $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . get_the_permalink() . '">+</a></div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";

        // Add pagination links
        $pagination_args = array(
            'total' => $query->max_num_pages, // Total number of pages
            'current' => $paged, // Current page
            'prev_text' => '&laquo; Previous', // Previous page link text
            'next_text' => 'Next &raquo;', // Next page link text
        );
        $result .= '<div class="pagination">' . paginate_links($pagination_args) . '</div>';
    }
    
    echo $result;
    return ob_get_clean();
}
add_shortcode('get_our_All_post', 'get_our_All_post');

//Community outreach
function get_our_community_outreach()
{
    ob_start();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get the current page number
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5, // Number of posts to display per page
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'community-outreach', // Replace with the specific category slug you want to query
            ),
        ),
        'paged' => $paged, // Pass the current page number to the query
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='All-team'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="All-wrap">'; 
            $result .= '<div class="All-thumbnail"><a href="' . get_the_permalink() . '"> '. get_the_post_thumbnail() .' </a></div>';
            $result .= '<div class="All-new-wrap">';
            
            $result .= '<div class="All-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a> </div>';
            
            $result .= '<div class="All-date">' . get_the_date() . '</div>';
            $result .= '<div class="All-content">' . get_field( "excerpt" ) . '</div>';
            $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . get_the_permalink() . '">+</a></div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";

        // Add pagination links
        $pagination_args = array(
            'total' => $query->max_num_pages, // Total number of pages
            'current' => $paged, // Current page
            'prev_text' => '&laquo; Previous', // Previous page link text
            'next_text' => 'Next &raquo;', // Next page link text
        );
        $result .= '<div class="pagination">' . paginate_links($pagination_args) . '</div>';
    }
    
    echo $result;
    return ob_get_clean();
}
add_shortcode('get_our_community_outreach', 'get_our_community_outreach');

//Body class 
function custom_class( $classes ) {

    if ( is_page('awards')) {
        $classes[] = 'awards-class aw-awards';
    }
    if ( is_page('contact-us')) {
        $classes[] = 'contacts-class';
    }
    if ( is_home() || is_single() || is_archive() ) {
        $classes[] = 'news-custom category';
    }
    if ( is_page('team')) {
        $classes[] = 'team-class';
    }
    if ( is_page('teams')) {
        $classes[] = 'team-class';
    }
    if ( is_page('archive-news')) {
        $classes[] = 'news-too';
    }
    if ( is_page('transactions')) {
        $classes[] = 'new-transaction';
    }
    if ( is_page('history')) {
        $classes[] = 'history-page';
    }



    return $classes;
}
add_filter( 'body_class', 'custom_class' );

function hide_breadcrumbs_on_certain_page( $input ) {
    if ( is_home() || is_single() || is_archive() ) {
       return false;   
    }
    
    return $input;
 }
 add_filter( 'neve_show_breadcrumbs', 'hide_breadcrumbs_on_certain_page', 10, 1 );

 function replace_wp_logo() {
	echo '<style type="text/css">
	h1 a { background-image:url('.site_url().'/wp-content/uploads/2023/09/header-logo-1.png) !important; background-size: 150px 150px !important;
	height: 150px !important;width:150px !important;
	}
		div#login h1 a {
			width: 100% !important;
			height: 130px !important;
			margin: 0 0 20px 0;
			background-size: 100% !important;
            background-color: skyblue !important;
            max-height: 60px !important;
		}
	</style>';
	add_filter( 'login_headerurl', 'fnAdminLogoURL' );
	function fnAdminLogoURL($url) {
	return home_url();
	}
}
add_action('login_head', 'replace_wp_logo');

function wpb_init_widgets_custom($id) {
    register_sidebar(array(
        'name' => 'Customsidebar',
        'id'   => 'customsidebar-id',
        'before_widget' => '<div class="sidebar-module">',
        'after_widget' => '</div>',
        'before_title' => '</h4>',
        'after_title' => '</h4>'
    ));
}
add_action('widgets_init','wpb_init_widgets_custom');

function custom_sidebar_shortcode($atts) {
    ob_start();
    
    dynamic_sidebar('Customsidebar'); 
    $sidebar_content = ob_get_clean();
    return $sidebar_content;
}
add_shortcode('custom_sidebar', 'custom_sidebar_shortcode');

function get_recent_post()
{
    ob_start();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get the current page number
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5, // Number of posts to display per page
        'post_status' => 'publish',
        'paged' => $paged, // Pass the current page number to the query
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='All-team'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="All-wrap">'; 
            $result .= '<div class="All-thumbnail"><a href="' . get_the_permalink() . '"> '. get_the_post_thumbnail() .' </a></div>';
            $result .= '<div class="All-new-wrap">';
            
            $result .= '<div class="All-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a> </div>';
            
            $result .= '<div class="All-date">' . get_the_date() . '</div>';
            //$result .= '<div class="All-content">' . get_field( "excerpt" ) . '</div>';
            
            $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . get_the_permalink() . '">+</a></div>';
            $result .= '</div>';
        }
        wp_reset_postdata();
        $result .= "</div>";

        // Add pagination links
        $pagination_args = array(
            'total' => $query->max_num_pages,
            'current' => $paged,
            'prev_text' => '&laquo; Previous',
            'next_text' => 'Next &raquo;', 
            'type' => 'list',
        );
        $result .= '<div class="pagination">' . paginate_links($pagination_args) . '</div>';
    }
    
    echo $result;
    return ob_get_clean();
}
add_shortcode('get_recent_post', 'get_recent_post');

/*------------------*/

function get_transaction_post()
{
    ob_start();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get the current page number
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 8, // Number of posts to display per page
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Replace with your custom taxonomy name
                'field' => 'slug', // Use 'slug' or 'id' depending on how you want to identify the category
                'terms' => 'transaction', // Replace with the specific category slug you want to query
               
            ),
        ),
        'paged' => $paged, // Pass the current page number to the query
    );

    $query = new WP_Query($args);
    $result = '';

    if ($query->have_posts()) {
        $result .= "<div class='service-release'>";
        while ($query->have_posts()) {
            $query->the_post();

            $result .= '<div class="service-release-section-wrap">';
            $result .= '<div class="service-thumbnail"><a href="' . get_the_permalink() . '"> '. get_the_post_thumbnail() .' </a></div>';
            $result .= '<div class="title-date-wrap">';
            $result .= '<div class="service-title"><a href="' . get_the_permalink() . '"><h2>' . get_field('amount')  . '</h2></a></div>';
            $result .= '<div class="service-content">' . get_field('facility') . '</div>';
            $result .= '<div class="services-content">' . get_field('services') . '</div>';
            $result .= '</div>';
            $result .= '<div class="new-icon"><a class="inform-two" href="' . get_the_permalink() . '">+</a></div>';
            $result .= '</div>';

        }
        wp_reset_postdata();
        $result .= "</div>";

        // Add pagination links
        $pagination_args = array(
            'total' => $query->max_num_pages, // Total number of pages
            'current' => $paged, // Current page
            'prev_text' => 'Previous', 
            'next_text' => 'Next',
        );
        $result .= '<div class="pagination">' . paginate_links($pagination_args) . '</div>';
    }
    
    echo $result;
    return ob_get_clean();
}
add_shortcode('get_transaction_post', 'get_transaction_post');

function exclude_transaction_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-17' ); // Replace 17 with the ID of your 'transaction' category
    }
}
add_action( 'pre_get_posts', 'exclude_transaction_category' );
remove_action( 'pre_get_posts', 'exclude_transaction_category' );

