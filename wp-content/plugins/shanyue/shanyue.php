<?php
/**
 * @package Akismet
 */
/*
Plugin Name: East common plugin
Plugin URI:
Description: add a page sections,for special positions
Version: 1.0.0
Author: East Huo
Author URI:
License: GPLv2 or later
Text Domain: East
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Make sure we don't expose any info if called directly

function shanyue_page_sections_init() {

	//register the products custom post type
	$labels = array(
		'name'               => __( 'Page Section', 'shanyue' ),
		'singular_name'      => __( 'Page Section', 'shanyue' ),
		'add_new'            => __( 'Add New', 'shanyue' ),
		'add_new_item'       => __( 'Add New Page Section', 'shanyue' ),
		'edit_item'          => __( 'Edit Page Section', 'shanyue' ),
		'new_item'           => __( 'New Page Section', 'shanyue' ),
		'all_items'          => __( 'All Page Section', 'shanyue' ),
		'view_item'          => __( 'View Page Section', 'shanyue' ),
		'search_items'       => __( 'Search Page Sections', 'shanyue' ),
		'not_found'          => __( 'No Page Sections found', 'shanyue' ),
		'not_found_in_trash' => __( 'No Page Sections found in Trash', 'shanyue' ),
		'menu_name'          => __( 'Page Sections', 'shanyue' )
	);

	$args = array(
		'labels'              => $labels,
		'description'         => __( 'Sections in each pages for flexible mastery ', 'shanyue' ),
		'public'              => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_menu'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' )
	);

	register_post_type( 'shanyue-p-sections', $args );

}

add_action( 'init', 'shanyue_page_sections_init' );


function shanyue_page_sections_meta_box( $post ) {
// retrieve our custom meta box values
$ps_meta         = get_post_meta( $post->ID, '_shanyue_page_sections_data', true );
$upload_link     = esc_url( get_upload_iframe_src( null, $post->ID ) );
$ps_type         = ( ! empty( $ps_meta['type'] ) ) ? $ps_meta['type'] : '';
$ps_page_belong   = get_post_meta( $post->ID, '_page_belong', true ) ;
$ps_file_link_id = ( ! empty( $ps_meta['fileLinkId'] ) ) ? $ps_meta['fileLinkId'] : '';
$ps_icon_class   = ( ! empty( $ps_meta['iconClass'] ) ) ? $ps_meta['iconClass'] : '';
$ps_page_related = ( ! empty( $ps_meta['pageRelated'] ) ) ? $ps_meta['pageRelated'] : '';
$ps_url_related  = ( ! empty( $ps_meta['urlRelated'] ) ) ? esc_url( $ps_meta['urlRelated'] ) : '';
$ps_group_slug   = sanitize_text_field( get_post_meta( $post->ID, '_group_slug', true ) );
// Get the image src
$your_img_src = wp_get_attachment_image_src( $ps_file_link_id, 'full' );
// For convenience, see if the array is valid
$you_have_img = is_array( $your_img_src );
//nonce field for security
wp_nonce_field( 'meta-box-save', 'shanyue' );

// display meta box form
echo '<table class="shanyue-page-sections">';
echo '<tr>';
echo '<td>' . __( 'Type', 'shanyue' ) . ':</td><td><select name="shanyue_page_sections[type]" id="shanyue_page_sections[type]">
            <option value="slider"' . selected( $ps_type, 'slider', false ) . '>' . __( 'Slider', 'shanyue' ) . '</option>
            <option value="feature"' . selected( $ps_type, 'feature', false ) . '>' . __( 'Feature', 'shanyue' ) . '</option>
        </select></td>';
echo '</tr><tr>';
echo '<td>' . __( 'Page Belong', 'shanyue' ) . ':</td><td>';
wp_dropdown_pages( array(
	'selected' => $ps_page_belong,
	'name'     => 'page_belong',
    'show_option_none'     => 'Choose page below'
) );
echo '</td>';
echo '</tr><tr>';
echo '<td>' . __( 'File Link', 'shanyue' ) . ':</td><td>'
?>
<!-- Your image container, which can be manipulated with js -->
<div class="custom-img-container">
	<?php if ( $you_have_img ) : ?>
        <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-height:150px;"/>
	<?php endif; ?>
</div>

<!-- Your add & remove image links -->
<p class="hide-if-no-js">
    <a class="upload-custom-img <?php if ( $you_have_img ) {
		echo 'hidden';
	} ?>"
       href="<?php echo $upload_link ?>">
		<?php _e( 'Set custom image' ) ?>
    </a>
    <a class="delete-custom-img <?php if ( ! $you_have_img ) {
		echo 'hidden';
	} ?>"
       href="#">
		<?php _e( 'Remove this image' ) ?>
    </a>
</p>

<!-- A hidden input to set and post the chosen image id -->
<input class="custom-img-id" name="shanyue_page_sections[fileLinkId]" type="hidden"
       value="<?php echo esc_attr( $ps_file_link_id ); ?>"/>
</td></tr>
<tr class="icon-class-tr<?php if ( $ps_type !== 'feature' ) {
	echo ' hidden';
} ?>">
	<?php
	echo '<td>' . __( 'Icon Class', 'shanyue' ) . ':</td><td><input type="text" name="shanyue_page_sections[iconClass]" value="' . esc_attr( $ps_icon_class ) . '" size="50"></td>';
	echo '</tr><tr>';
	echo '<td>' . __( 'Url Related', 'shanyue' ) . ':</td><td><input type="text" name="shanyue_page_sections[urlRelated]" value="' . esc_attr( $ps_url_related ) . '" size="50">';
	echo '</td></tr><tr>';
	echo '<td>' . __( 'Page Related', 'shanyue' ) . ':</td><td>';
	wp_dropdown_pages( array(
		'selected' => $ps_page_related,
		'name'     => 'shanyue_page_sections[pageRelated]',
        'show_option_none'     => 'Choose page below'
	) );
	echo '</td></tr><tr>';
	echo '<td>' . __( 'Group Slug', 'shanyue' ) . ':</td><td><input type="text" name="group_slug" value="' . esc_attr( $ps_group_slug ) . '" size="50"></td>';
	echo '</tr>';
	echo '</table>';
	}

	function shanyue_page_sections_register_meta_box() {
		add_meta_box( 'shanyue-page-sections-meta', __( 'Section Info', 'shanyue' ), 'shanyue_page_sections_meta_box', 'shanyue-p-sections', 'normal', 'default' );
	}

	add_action( 'add_meta_boxes', 'shanyue_page_sections_register_meta_box' );

	function shanyue_page_sections_save_meta_box( $post_id ) {

		//verify the post type is for Halloween Products and metadata has been posted
		if ( get_post_type( $post_id ) == 'shanyue-p-sections' && isset( $_POST['shanyue_page_sections'] ) ) {

			//if autosave skip saving data
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			//check nonce for security
			wp_verify_nonce( 'meta-box-save', 'shanyue' );

			//store option values in a variable
			$shanyue_page_sections = $_POST['shanyue_page_sections'];

			//use array map function to sanitize option values
			$shanyue_page_sections = array_map( 'sanitize_text_field', $shanyue_page_sections );

			// save the meta box data as post metadata
			update_post_meta( $post_id, '_shanyue_page_sections_data', $shanyue_page_sections );
            if ( isset( $_POST['page_belong'] ) ) {
                $shanyue_page_belong = $_POST['page_belong'];
                update_post_meta( $post_id, '_page_belong', $shanyue_page_belong );
            }
			if ( isset( $_POST['group_slug'] ) ) {
				$shanyue_group_slug = $_POST['group_slug'];
				$shanyue_group_slug = sanitize_text_field( $shanyue_group_slug );
				update_post_meta( $post_id, '_group_slug', $shanyue_group_slug );
			}
		}
	}

	add_action( 'save_post', 'shanyue_page_sections_save_meta_box' );

	add_filter( 'manage_shanyue-p-sections_posts_columns', 'shanyue_group_slug_matebox_column' );

	function shanyue_group_slug_matebox_column( $columns ) {
		$new = array();
		foreach ( $columns as $key => $title ) {
			if ( $key == 'date' ) // Put the Thumbnail column before the Author column
			{
				$new['group_slug'] = __( 'Group Slug', 'shanyue' );
			}
			$new[ $key ] = $title;
		}

		return $new;
	}

	add_action( 'manage_shanyue-p-sections_posts_custom_column', 'shanyue_group_slug_matebox_custom_column', 10, 2 );

	function shanyue_group_slug_matebox_custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'group_slug':
				echo get_post_meta( $post_id, '_group_slug', true );
				break;
		}
	}


	// JS CSS
	/**
	 * Enqueue admin scripts and styles.
	 */
	function shanyue_admin_theme_style() {
		wp_enqueue_style( 'shanyue-plugin-admin-css', plugins_url( 'assets/css/admin.css', __FILE__ ) );
		wp_enqueue_script( 'shanyue-plugin-admin-js', plugins_url( 'assets/js/admin.js', __FILE__ ), array(), '', true );
		wp_enqueue_script( 'shanyue-plugin-admin-js', plugins_url( 'assets/js/admin.js', __FILE__ ), array(), '', true );
	}

	add_action( 'admin_enqueue_scripts', 'shanyue_admin_theme_style' );

	?>
