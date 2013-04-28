<?php
/**
 * Plugin Name: Super recent posts
 * Plugin URI: http://wordpress.org/extend/plugins/super-recent-posts/
 * Description: Widget that can display recent posts from multiple categories, taxonomies, terms custom post types.
 * Version: 0.1
 * Author: Hmayak Tigranyan
 * Author URI: http://www.hmayaktigranyan.com/
 * Tags: recent posts,recent custom posts,recent custom post types,recent terms posts,recent taxonomy posts,recent posts widget,post types, latest posts, sidebar widget, plugin
 * License: GPL

  =====================================================================================
  Copyright (C) 2011 Hmayak Tigranyan

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
  =====================================================================================
 */
add_action("widgets_init", "super_recent_posts_widget_init");

function super_recent_posts_widget_init() {
    return register_widget('super_recent_posts_widget');
}

add_action('wp_ajax_srp_get_taxonomy_terms', array('super_recent_posts_widget', 'get_taxonomy_terms'));

class super_recent_posts_widget extends WP_Widget {
    /* Widget setup. */

    function super_recent_posts_widget() {
        /* Widget settings. */
        $widget_ops = array('classname' => 'super_recent_posts', 'description' => __('Super recent posts', 'super_recent_posts'));

        /* Widget control settings. */
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'super_recent_posts_widget');

        /* Create the widget. */
        $this->WP_Widget('super_recent_posts_widget', __('Super recent posts', 'super_recent_posts'), $widget_ops, $control_ops);
    }

    /* How to display the widget on the screen. */

    function widget($args, $instance) {
        extract($args);

        /* Our variables from the widget settings. */
        $title = $instance['title'];
        $taxonomy = $instance['taxonomy'];
        $terms = $instance['term'];

        $posts = $instance['posts'];
        $posttypes = $instance['posttype'];

        $show_excerpt = $instance['show_excerpt'];
        $excerpt_length = $instance['excerpt_length'];
        $excerpt_readmore = $instance['excerpt_readmore'];


        $show_thumbnail = $instance['show_thumbnail'];
        $thumbnail_h = $instance['thumbnail_h'];
        $thumbnail_w = $instance['thumbnail_w'];

        if (!$thumbnail_h) {
            $thumbnail_h = intval(get_option('thumbnail_size_h'));
        }
        if (!$thumbnail_w) {
            $thumbnail_w = intval(get_option('thumbnail_size_w'));
        }

        $query_terms = array();
        $first_term = null;
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $term = explode(";", $term);
                if (isset($term[1])) {
                    $term_array = get_term_by('id', $term[1], $term[0], 'ARRAY_A');
                    if (!$first_term) {
                        $first_term = $term_array;
                    }
                    if (isset($query_terms[$term[0]])) {
                        $query_terms[$term[0]] = $query_terms[$term[0]] . "," . $term_array["slug"];
                    } else {
                        $query_terms[$term[0]] = $term_array["slug"];
                    }
                }
            }
        }
        if (isset($query_terms['category'])) {
            $query_terms['category_name'] = $query_terms['category'];
        }
        $args = $query_terms;

        $args['showposts'] = $posts;
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        $args['post_type'] = $posttypes;

        if ($first_term) {
            $titleLink = get_term_link((int) $first_term["term_id"], $first_term["taxonomy"]);
        } elseif ($posttypes[0]) {
            $ptype = get_post_types(array('name' => $posttypes[0]), 'objects');
            if ($ptype[$posttypes[0]]) {
                global $wp_rewrite;
                $ptype = $ptype[$posttypes[0]];
                $archive_slug = $ptype->has_archive === true ? $ptype->rewrite['slug'] : $ptype->has_archive;
                if ($ptype->rewrite['with_front']) {
                    $archive_slug = substr($wp_rewrite->front, 1) . $archive_slug;
                } else {
                    $archive_slug = $wp_rewrite->root . $archive_slug;
                }

                $titleLink = home_url("/") . $archive_slug;
            }
        }


        if (!$title) {
            if ($first_term) {
                $title = $first_term['name'];
            } elseif ($posttypes[0]) {
                $title = $ptype->labels->name;
            }
        }
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $new_excerpt_length = create_function('$length', "return " . $excerpt_length . ";");
        if ($excerpt_length > 0) {
            add_filter('excerpt_length', $new_excerpt_length);
        }

        $new_excerpt_more = create_function('$more', 'return " ";');
        add_filter('excerpt_more', $new_excerpt_more);

        echo $before_widget;

        if ($title) {
            echo $before_title;
            echo '<a href="' . $titleLink . '">' . $title . '</a>';
            echo $after_title;
        }
        
        $posts_query = new WP_Query($args);

        $i = 0;
        if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post();
                $i++;
                global $post;
                ?>
                <div class="super_recent_posts_item">
                   <b> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="super_recent_posts_item_title"><?php the_title(); ?></a> </b> <span>(<?php echo get_the_term_list( $post->ID, 'locations', '', ', ', '' ); ?>)</span>

                <?php if ($show_excerpt || $show_thumbnail) { ?>
                        <div class="post-entry">
                        <?php
                        if ($show_thumbnail) {

                            unset($img);
                            if (has_post_thumbnail()) {
                                $thumbURL = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '');
                                $img = $thumbURL[0];
                            } else {
                                $img = self::getFirstImage($post->ID);
                            }

                            if ($img) {
                                ?>

                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                        <img class="alignleft" src="<?php echo plugins_url() ?>/super-recent-posts/timthumb/timthumb.php?src=<?php echo $img ?>&amp;w=<?php echo $thumbnail_w ?>&amp;h=<?php echo $thumbnail_h ?>&amp;zc=1" alt="<?php the_title(); ?>" width="<?php echo $thumbnail_w ?>" height="<?php echo $thumbnail_h ?>" />
                                    </a>
                        <?php } ?>


                                <?php
                            }

                            if ($show_excerpt) {

                                $readmore = ' <a href="' . get_permalink() . '" class="more-link">' . $excerpt_readmore . '</a>';
                                ?>
                                <p><?php the_excerpt();
                        echo $readmore; ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clear">&nbsp;</div>
                    <?php
                }
                ?>

                </div>
            <?php endwhile; ?>

            <?php
        endif;
        ?>

        <?php
        echo $after_widget;

        remove_filter('excerpt_length', $new_excerpt_length);
        remove_filter('excerpt_more', $new_excerpt_more);
        wp_reset_query();
    }

    /* Update the widget settings. */

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['taxonomy'] = $new_instance['taxonomy'];
        $instance['term'] = $new_instance['term'];
        $instance['posts'] = absint($new_instance['posts']);
        $instance['posttype'] = $new_instance['posttype'];

        $instance['show_excerpt'] = (boolean) $new_instance['show_excerpt'];
        $instance['excerpt_length'] = absint($new_instance['excerpt_length']);
        if (!$instance['excerpt_length']) {
            $instance['excerpt_length'] = "";
        }
        $instance['excerpt_readmore'] = strip_tags($new_instance['excerpt_readmore']);


        $instance['show_thumbnail'] = (boolean) $new_instance['show_thumbnail'];
        $instance['thumbnail_h'] = absint($new_instance['thumbnail_h']);
        $instance['thumbnail_w'] = absint($new_instance['thumbnail_w']);
        if (!$instance['thumbnail_h']) {
            $instance['thumbnail_h'] = "";
        }
        if (!$instance['thumbnail_w']) {
            $instance['thumbnail_w'] = "";
        }

        return $instance;
    }

    function form($instance) {

        $defaults = array('excerpt_readmore' => __('Read more', 'super_recent_posts'), 'posts' => '3');
        $instance = wp_parse_args((array) $instance, $defaults);


        $term_field = $this->get_field_id('term');
        ?>
        <script type="text/javascript" >

            function onchangeTerm(term_field,value){
                var data = {
                    action: 'srp_get_taxonomy_terms',
                    srp_term: value
                };

                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                jQuery.post(ajaxurl, data, function(response) {
                    jQuery('#'+term_field).html(response);
                });
            }

        </script>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title(if empty will be used first name):', 'super_recent_posts'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:', 'super_recent_posts'); ?></label>
            <select multiple="multiple" onchange="return onchangeTerm('<?php echo $term_field ?>',jQuery(this).val());" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>[]" style="width:90%;">
        <?php
        $taxonomies = get_taxonomies(array('public' => true, 'show_ui' => true));
        foreach ($taxonomies as $taxonomyslug) {
            $taxonomy = get_taxonomy($taxonomyslug);
            $option = '<option value="' . $taxonomyslug;
            if (is_array($instance['taxonomy']) && in_array($taxonomyslug, $instance['taxonomy'])) {
                $option .='" selected="selected';
            }
            $option .= '">';
            $option .= $taxonomy->labels->name;
            $option .= '</option>';
            echo $option;
        }
        ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('term'); ?>"><?php _e('Term:', 'super_recent_posts'); ?></label>
            <select multiple="multiple" id="<?php echo $term_field ?>" name="<?php echo $this->get_field_name('term'); ?>[]" style="width:90%;">
        <?php
        if ($instance['taxonomy']) {
            foreach ($instance['taxonomy'] as $itax) {
                $terms = get_terms($itax, 'hide_empty=0&orderby=term_group');
                $optGroupTaxonomy = "";

                if (!is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $option = "";
                        if ($optGroupTaxonomy != $term->taxonomy) {
                            if ($optGroupTaxonomy) {
                                $option .= '</optgroup>';
                            }
                            $optGroupTaxonomy = $term->taxonomy;
                            $optGroupTaxonomyObj = get_taxonomy($optGroupTaxonomy);
                            $option .= '<optgroup label="' . $optGroupTaxonomyObj->labels->name . '">';
                        }
                        $option .= '<option value="' . $term->taxonomy . ";" . $term->term_id;
                        if (is_array($instance['term']) && in_array($term->taxonomy . ";" . $term->term_id, $instance['term'])) {
                            $option .='" selected="selected';
                        }
                        $option .= '">';
                        $option .= $term->name;
                        $option .= ' (' . $term->count . ')';
                        $option .= '</option>';
                        echo $option;
                    }
                }
                if ($optGroupTaxonomy) {
                    echo '</optgroup>';
                }
            }
        } else {
            ?>
                    <option value="0"><?php _e('Choose taxonomy:', 'super_recent_posts'); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Post types:', 'super_recent_posts'); ?></label>
            <select multiple="multiple"  id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>[]" style="width:90%;">
        <?php
        $post_types = get_post_types(array('public' => true, 'show_ui' => true));

        foreach ($post_types as $post_type) {
            $pt = get_post_type_object($post_type);

            $option = '<option value="' . $post_type;
            if (is_array($instance['posttype']) && in_array($post_type, $instance['posttype'])) {
                $option .='" selected="selected';
            }
            $option .= '">';
            $option .= $pt->labels->singular_name;
            $option .= '</option>';
            echo $option;
        }
        ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Posts to show:', 'super_recent_posts'); ?></label>
            <input id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts'] ?>" style="width:20px">

        </p>

        <div style="float:left;display:inline;width:50%">
            <p><label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Show excerpt:', 'super_recent_posts'); ?></label>
                <br/> <input type="checkbox" id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" <?php if ($instance['show_excerpt']) echo 'checked="checked"'; ?> >
            </p></div>

        <div style="float:right;display:inline;width:50%">
            <p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt words count:', 'super_recent_posts'); ?></label>
                <br/> <input type="text" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $instance['excerpt_length']; ?>" style="width:30px">
            </p></div>
        <p>
            <label for="<?php echo $this->get_field_id('excerpt_readmore'); ?>"><?php _e('Read more text:', 'super_recent_posts'); ?></label>
            <input id="<?php echo $this->get_field_id('excerpt_readmore'); ?>" name="<?php echo $this->get_field_name('excerpt_readmore'); ?>" value="<?php echo $instance['excerpt_readmore'] ?>" style="width:90px">

        </p>


        <div style="float:left;display:inline;width:40%">
            <p><label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show thumbnail:', 'super_recent_posts'); ?></label>
                <br/> <input type="checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" <?php if ($instance['show_thumbnail']) echo 'checked="checked"'; ?> >
            </p></div>

        <div style="float:right;display:inline;width:60%">
            <p><label><?php _e('Thumb width,height:', 'super_recent_posts'); ?></label>
                <br/> <input type="text" id="<?php echo $this->get_field_id('thumbnail_w'); ?>" name="<?php echo $this->get_field_name('thumbnail_w'); ?>" value="<?php echo $instance['thumbnail_w']; ?>" style="width:30px">
                x <input type="text" id="<?php echo $this->get_field_id('thumbnail_h'); ?>" name="<?php echo $this->get_field_name('thumbnail_h'); ?>" value="<?php echo $instance['thumbnail_h']; ?>" style="width:30px">
            </p></div>
        <br/>
        <?php
    }

    public static function getFirstImage($post_id = 0, $width = 60, $height = 60, $img_script = '') {
        global $wpdb;
        if ($post_id > 0) {

            // select the post content from the db

            $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
            $row = $wpdb->get_row($sql);
            $the_content = $row->post_content;
            if (strlen($the_content)) {

                // use regex to find the src of the image

                preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
                if (!$matches) {
                    preg_match("/<img class\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
                }
                if (!$matches) {
                    preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
                }

                $the_image = '';
                $the_image_src = $matches[2];
                $frags = preg_split("/(\"|')/", $the_image_src);
                if (count($frags)) {
                    $the_image_src = $frags[0];
                }

                // if an image isn't found yet
                if (!strlen($the_image_src)) {
                    $attachments = get_children(array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));

                    if (count($attachments) > 0) {
                        $q = 0;
                        foreach ($attachments as $id => $attachment) {
                            $q++;
                            if ($q == 1) {
                                $thumbURL = wp_get_attachment_image_src($id, $args['size']);
                                $the_image_src = $thumbURL[0];
                                break;
                            } // if first image
                        } // foreach
                    } // if there are attachments
                } // if no image found yet
                // if src found, then create a new img tag

                if (strlen($the_image_src)) {
                    if (strlen($img_script)) {

                        // if the src starts with http/https, then strip out server name

                        if (preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
                            $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
                            $frags = split("\/", $the_image_src);
                            array_shift($frags);
                            $the_image_src = '/' . join("/", $frags);
                        }
                        $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
                    } else {
                        $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
                    }
                }
                return $the_image_src;
            }
        }
    }

    public static function get_taxonomy_terms() {
        if ($_POST['srp_term']) {
            $pterm = $_POST['srp_term'];
            foreach ($pterm as $tax) {
                $terms = get_terms($tax, 'hide_empty=0&orderby=term_group');
                $optGroupTaxonomy = "";

                if (!is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $option = "";
                        if ($optGroupTaxonomy != $term->taxonomy) {
                            if ($optGroupTaxonomy) {
                                $option .= '</optgroup>';
                            }
                            $optGroupTaxonomy = $term->taxonomy;
                            $optGroupTaxonomyObj = get_taxonomy($optGroupTaxonomy);
                            $option .= '<optgroup label="' . $optGroupTaxonomyObj->labels->name . '">';
                        }
                        $option .= '<option value="' . $term->taxonomy . ";" . $term->term_id . '">';
                        $option .= $term->name;
                        $option .= ' (' . $term->count . ')';
                        $option .= '</option>';
                        echo $option;
                    }
                }
            }
            if ($optGroupTaxonomy) {
                echo '</optgroup>';
            }
            exit;
        }
    }

}
?>