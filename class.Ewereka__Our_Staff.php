<?php

class Safe_Sound_Customizations {
    private static $initiated = FALSE;
    private static $team_type_name = "team_member";
    private static $location_taxonomy_name = "location";
    private static $division_taxonomy_name = "division";

    private static $team_meta_box = array(
        'id' => 'ewereka-our-staff-meta',
        'title' => 'Employee Information',
        'page' => 'team_member',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Role',
                'desc' => 'Enter Employee Job Title / Role',
                'id' => '_role',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => 'Phone Number',
                'desc' => 'Enter Employee Phone Number',
                'id' => '_phone',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => 'Email Address',
                'desc' => 'Enter Employee Email Address',
                'id' => '_email',
                'type' => 'text',
                'std' => ''
            )
        )
    );

    public static function init() {
        if ( ! static::$initiated ) {
            static::init_hooks();
        }
    }

    private static function init_hooks() {
        static::$initiated = TRUE;

        static::architecture_customizations();
    }

    private static function architecture_customizations() {
        global $wp_rewrite;

        $team_type_name =			self::$team_type_name;
        $team_type_labels =			array(
            "name"					=> _x( "Team Members", "post type general name", "cstone-cust" ),
            "singular_name"			=> _x( "Team Member", "post type singular name", "cstone-cust" ),
            "menu_name"				=> _x( "Team Members", "admin menu", "cstone-cust" ),
            "name_admin_bar"		=> _x( "Team Members", "add new on admin bar", "cstone-cust" ),
            "add_new"				=> _x( "Add Team Member", "team", "cstone-cust" ),
            "add_new_item"			=> __( "Add Team Member", "cstone-cust" ),
            "new_item"				=> __( "New Team Member", "cstone-cust" ),
            "edit_item"				=> __( "Edit Team Member", "cstone-cust" ),
            "view_item"				=> __( "View Team Member", "cstone-cust" ),
            "all_items"				=> __( "All Team Members", "cstone-cust" ),
            "search_items"			=> __( "Search Team Members", "cstone-cust" ),
            "parent_item_colon"		=> __( "Parent Team Member:", "cstone-cust" ),
            "not_found"				=> __( "No team members found.", "cstone-cust" ),
            "not_found_in_trash"	=> __( "No team members found in trash.", "cstone-cust" ),
            "featured_image"		=> __( "Photo", "cstone-cust" ),
            "set_featured_image"	=> __( "Set Photo", "cstone-cust" ),
            "remove_featured_image"	=> __( "Remove Photo", "cstone-cust" ),
            "use_featured_image"	=> __( "Use as Photo", "cstone-cust" ),
        );
        $team_type_args =			array(
            "labels"				=> $team_type_labels,
            "public"				=> null,
            "exclude_from_search"	=> true,
            "publicly_queryable"	=> false,
            "show_ui"				=> true,
            "show_in_nav_menus"		=> true,
            "show_in_menu"			=> true,
            "show_in_admin_bar"		=> true,
            "query_var"				=> true,
            "rewrite"				=> array( "slug" => "our-team" ),
            "capability_type"		=> "post",
            "has_archive"			=> false,
            "hierarchical"			=> false,
            "menu_position"			=> 6,
            "menu_icon"				=> "dashicons-id",
            "supports"				=> array( "title", "thumbnail", "revisions" )
        );

        /** Taxonomies */
        $location_taxonomy_labels   = array(
            "name"                  => _x( "Location", "taxonomy general name", "com.ewereka.our-staff" ),
            "singular_name"         => _x( "Location", "taxonomy singular name", "com.ewereka.our-staff" ),
            "search_items"          => __( "Search Locations", "com.ewereka.our-staff" ),
            "all_items"             => __( "All Locations", "com.ewereka.our-staff" ),
            "parent_item"           => __( "Parent Location", "com.ewereka.our-staff" ),
            "parent_item_colon"     => __( "Parent Location:", "com.ewereka.our-staff" ),
            "edit_item"             => __( "Edit Location", "com.ewereka.our-staff" ),
            "update_item"           => __( "Update Location", "com.ewereka.our-staff" ),
            "add_new_item"          => __( "Add New Location", "com.ewereka.our-staff" ),
            "new_item_name"         => __( "New Location Name", "com.ewereka.our-staff" ),
            "menu_name"             => __( "Location", "com.ewereka.our-staff" )
        );

        $location_taxonomy_args = array(
            "hierarchical"      => true,
            "labels"            => $location_taxonomy_labels,
            "show_ui"           => true,
            "show_admin_column" => true,
            "query_var"         => true,
            "rewrite"           => array( "slug" => self::$location_taxonomy_name ),
        );

        $division_taxonomy_labels   = array(
            "name"                  => _x( "Division", "taxonomy general name", "com.ewereka.our-staff" ),
            "singular_name"         => _x( "Division", "taxonomy singular name", "com.ewereka.our-staff" ),
            "search_items"          => __( "Search Divisions", "com.ewereka.our-staff" ),
            "all_items"             => __( "All Divisions", "com.ewereka.our-staff" ),
            "parent_item"           => __( "Parent Division", "com.ewereka.our-staff" ),
            "parent_item_colon"     => __( "Parent Division:", "com.ewereka.our-staff" ),
            "edit_item"             => __( "Edit Division", "com.ewereka.our-staff" ),
            "update_item"           => __( "Update Division", "com.ewereka.our-staff" ),
            "add_new_item"          => __( "Add New Division", "com.ewereka.our-staff" ),
            "new_item_name"         => __( "New Division Name", "com.ewereka.our-staff" ),
            "menu_name"             => __( "Division", "com.ewereka.our-staff" )
        );

        $division_taxonomy_args = array(
            "hierarchical"      => true,
            "labels"            => $division_taxonomy_labels,
            "show_ui"           => true,
            "show_admin_column" => true,
            "query_var"         => true,
            "rewrite"           => array( "slug" => self::$division_taxonomy_name ),
        );


        register_post_type( $team_type_name, $team_type_args );

        register_taxonomy( self::$location_taxonomy_name, array( self::$team_type_name ), $location_taxonomy_args );
        register_taxonomy( self::$division_taxonomy_name, array( self::$team_type_name ), $division_taxonomy_args );

        static::add_shortcodes();

        // Clear the permalinks after the post type has been registered
        flush_rewrite_rules();
    }

    private static function add_shortcodes() {
        add_shortcode('our_staff', 'sc_clients_text');
    }

    public static function sc_clients_text($attr, $content = null) {
		extract(shortcode_atts(array(
			'in_row'     => 4,
			'location'   => '',
			'division'   => '',
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
		), $attr));

		if (! intval($in_row, 10)) {
			$in_row = 4;
		}

		// query args

		$args = array(
			'post_type'      => self::$team_type_name,
			'posts_per_page' => -1,
			'orderby'        => $orderby,
			'order'          => $order,
		);

		if ($location) {
			$args[self::$location_taxonomy_args] = $location;
		}
        if ($division) {
			$args[self::$division_taxonomy_name] = $division;
		}

		$team_query = new WP_Query();
		$team_query->query($args);

		// output -----
    $output = '';

			if ($team_query->have_posts()) {
				$i = 1;
				$width = round((100 / $in_row), 3);

        $output .= '<ul class="ewereka-our-staff">'.PHP_EOL;

				while ($team_query->have_posts()) {
					$team_query->the_post();

					$output .= '<li style="width:'. esc_attr($width) .'%">'.PHP_EOL;
							$output .= '<p class="name">' . the_title(false, false, false) . '</p>'.PHP_EOL;
					$output .= '</li>'.PHP_EOL;

					$i++;
				}
        $output .= '</ul>'.PHP_EOL;
			}

			wp_reset_query();
		return $output;
	}


    //Helper Methods
    private static function build_taxonomy_array($taxonomy_name) {
        $tax_array = array();
		$terms = get_categories(array('taxonomy' => $taxonomy_name,));
		foreach( $terms as $term ) {
			$tax_array[$term->name] = $term->term_id;
		}

        return $tax_array;
    }

    //Action Methods
    public static function add_team_meta() {
        $team_meta_box = self::$team_meta_box;
        add_meta_box($team_meta_box['id'], $team_meta_box['title'], 'show_team_meta', $team_meta_box['page'], $team_meta_box['context'], $team_meta_box['priority']);
    }

    public static function show_team_meta() {
        global $post;

        $team_meta_box = self::$team_meta_box;
        // Use nonce for verification
        echo '<input type="hidden" name="ewereka_team_meta_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
        echo '<table class="form-table">';
        foreach ($team_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
            echo '<tr>',
            '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
            '<td>';
            switch ($field['type']) {
                case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
                case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
                case 'select': //not currently used but available if needed
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
                case 'radio': //not currently used but available if needed
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
                case 'checkbox': //not currently used but available if needed
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
            }
            echo     '</td><td>',
            '</td></tr>';
        }
        echo '</table>';
    }

    public static function save_team_meta($post_id) {
        $team_meta_box = self::$team_meta_box;
        // verify nonce
        if (!wp_verify_nonce($_POST['ewereka_our_staff_nonce'], basename(__FILE__))) {
            return $post_id;
        }
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        foreach ($team_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }

    public static function integrate_with_vc() {
		$locations = static::build_taxonomy_array('location');
        $divisions = static::build_taxonomy_array('division');


		vc_map(array(
			'base' 			=> 'our_staff',
			'name' 			=> __('Our Staff', 'com.ewereka.our-staff'),
			'description' 	=> __('Recommended column size: 1/1', 'com.ewereka.our-staff'),
			'category' 		=> __('Ewereka', 'com.ewereka.our-staff'),
			'icon' 			=> 'vc-icon-staff',
			'params' 		=> array(

				array(
					'param_name' 	=> 'in_row',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Items in Row', 'com.ewereka.our-staff'),
					'desc' 			=> __('Number of items in row.'),
					'admin_label'	=> true,
					'value'			=> array_flip(array(
						'1'			=> '1',
						'2'			=> '2',
						'3' 		=> '3',
						'4' 		=> '4',
					)),
					'std'			=> '4'
				),

				array(
					'param_name' 	=> 'location',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Location', 'com.ewereka.our-staff'),
					'desc' 			=> __('Select the location to use', 'com.ewereka.our-staff'),
					'admin_label'	=> true,
                    'value'         => array_flip($locations)
				),

                array(
					'param_name' 	=> 'division',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Division', 'com.ewereka.our-staff'),
					'desc' 			=> __('Select the division to use', 'com.ewereka.our-staff'),
					'admin_label'	=> true,
                    'value'         => array_flip($divisions)
				),

				array(
					'param_name' 	=> 'orderby',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Order by', 'com.ewereka.our-staff'),
					'admin_label'	=> false,
					'value'			=> array_flip(array(
						'date'			=> 'Date',
						'menu_order' 	=> 'Menu order',
						'title'			=> 'Title',
						'rand'			=> 'Random',
					)),
				),

				array(
					'param_name' 	=> 'order',
					'type' 			=> 'dropdown',
					'heading' 		=> __('Order', 'com.ewereka.our-staff'),
					'admin_label'	=> false,
					'value'			=> array_flip(array(
						'ASC' 	=> 'Ascending',
						'DESC' 	=> 'Descending',
					)),
				)
			)
		));
	}
}
