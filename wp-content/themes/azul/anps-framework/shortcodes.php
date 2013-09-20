<?php

load_template(TEMPLATEPATH . '/anps-framework/recaptchalib.php');

function recent_projects_func( $atts,  $content ) {

    global $more, $post;
    $more = 0;

    $args = array(
        'post_type' => 'portfolio',
        'orderby' => 'id',
        'order' => 'DESC',
        'numberposts' => -1,
    );

    $portfolio_posts = get_posts($args);

    $return_data = '';
    $return_data .= '<div class="row-fluid">';

    $counter = 0;

    foreach ($portfolio_posts as $post) : setup_postdata($post); ?>

        <?php
            if($counter++ == $content) break;
        ?>

        <?php $return_data .= '<article class="span3 single-post2">'; ?>
            <?php 
                $number_of_chars = 50;
            ?>
            
            <?php if ( get_the_post_thumbnail($post->ID, 'full') == "" ): ?>
                    <?php 
                        $number_of_chars = 50; 
                    ?>
            <?php else: ?>
                    <?php $return_data .= get_the_post_thumbnail($post->ID, 'full');  ?>
            <?php endif; ?>         
            
            <?php $return_data .= '<div class="single-post2-content">'; ?>
                <?php $return_data .= '<h4>' . get_the_title() . '</h4>'; ?>
                <?php $return_data .= '<p>' . mb_substr(strip_tags(get_the_content('')), 0, $number_of_chars)  . '...</p>'; ?>
                <?php $return_data .= '<span class="single-post2-more">'; ?>
                    <?php $return_data .= '<a class="single-post2-lightbox" data-rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '"></a>'; ?>  
                    <?php $return_data .= '<a class="single-post2-open" href="' . get_permalink() . '"></a>'; ?>                        
                <?php $return_data .= '</span>'; ?>
            <?php $return_data .= '</div>'; ?>
        <?php $return_data .= '</article>'; ?>

    <?php endforeach;

    $return_data .= '</div>';

    return $return_data;
}

add_shortcode( 'recent_projects', 'recent_projects_func' );





function projects_by_id_func( $atts,  $content ) {
    global $post;

    query_posts('category_name=portfolio&order=ASC&posts_per_page=99999');
    
    $number_of_columns = "four-column";
        
    $return_data = '<div class="main-wrapper portfolio-wrapper recent-projects"><ul style="margin : 0" class="portfolio clearfix">';
        
        $args = array(
            'post_type'    => 'portfolio',
            'numberposts'  => -1,
            'post__in'      =>  explode(",", $content)
        );
        
        $thumbnail_args = array(
            'alt'   => "",
            'title' => "",
        );
                
        $current_number = 0;
        $current_class = 1;
        $portfolio_posts = get_posts( $args );
        $first_line = 'style="margin-top: 20px"';
        
        foreach( $portfolio_posts as $post ) :  setup_postdata($post); ?>
                
                <?php
                    $current_number++;

                    if( $current_number == 5 ) {
                        $first_line = '';
                    }
                ?>
                
            <?php $return_data .= '<li ' . $first_line . ' class="isotope-item  page-1 ' . $number_of_columns . '">'; ?> 
                    
                    <?php if( $number_of_columns == "four-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-4-column", $thumbnail_args); ?>
                    <?php elseif ( $number_of_columns == "three-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-3-column", $thumbnail_args); ?>
                    <?php else: ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-2-column", $thumbnail_args); ?>
                    <?php endif; ?>
                    
                    <?php $return_data .= '<div class="portfolio-responsive">' . get_the_post_thumbnail($post->ID, "portfolio-first-responsive", $thumbnail_args) . '</div>';
                    
                    $return_data .= '<h3>' . get_the_title() . '</h3>';
                    
                    $return_data .= '<div class="portfolio-hover">';
                    $return_data .= '<h3>';
                    $return_data .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    $return_data .= '</h3>';
                    $return_data .= '<p>';
                    ?>
                            <?php 
                                global $more;
                                $more = 0;
                                $return_data .= get_the_content(''); 
                            ?>
                        <?php $return_data .= '</p>';
                        $return_data .= '<a data-rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '" class="enlarge"></a>';
                        $return_data .= '<a href="' . get_permalink() . '" class="open"></a>';
                    $return_data .= '</div>';
                    
               $return_data .= '</li>';
        endforeach; 
    $return_data .= '</ul>'; 
$return_data .= '</div><div class="main-wrapper clearfix">';
    


    return $return_data;

}

add_shortcode( 'projects_by_id', 'projects_by_id_func' );







function recent_project_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'link' => '',
        'alt' => '',
        'title' => '',
        'rel' => '',
        'project' => '',

	), $atts ) );



	return '<a data-rel="' . $rel . '" href="' . $link . '"><img src="' . $content . '" alt="' . $alt . '" title="' . $title . '" /><div class="magnifier"><div>' . $project . '<div></div></div></div></a>';

}

add_shortcode( 'recent_project', 'recent_project_func' );









function content_with_menu_wrapper_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

	return '<div class="content" id="content-with-menu"><div class="contentWrapperTop"></div>' . $content . '<div class="clear"></div></div>';

}

add_shortcode( 'content_with_menu_wrapper', 'content_with_menu_wrapper_func' );











function content_menu_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

	return '<ul class="content-menu">' . $content . '</ul>';

}



add_shortcode( 'content_menu', 'content_menu_func' );











function content_menu_item_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => '',

	), $atts ) );

        

        if ( $id == "selected-submenu" ) {

            return '<li id="' . $id . '">' . $content . '<div class="content-menu-over">Developing web</div><div class="content-menu-shadow-right"></div></li>';

        }

        else {

            return '<li>' . $content . '</li>';

        }

}



add_shortcode( 'content_menu_item', 'content_menu_item_func' );











function content_with_menu_wrapper_posts_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        

        $tab_posts = explode( ',', $content );

        

        

        $data = '<div class="content" id="content-with-menu"><div class="contentWrapperTop"></div><ul class="content-menu">';

        

        

        /*

         * 

         *  Get top menu

         * 

         */

        $index = 0;

        

        foreach ( $tab_posts as $post_id ) {

            

            $post = get_post( $post_id );  
            if(!isset($post)) $post->post_title='';
            $title = $post->post_title;

            

            

            if ( $index++ == 0 ) {

                $data .= '<li id="selected-submenu">' . $title . '<div class="content-menu-over">' . $title . '</div><div class="content-menu-shadow-right"></div></li>';

            }

            else {

                $data .= '<li>' . $title . '</li>';

            }

            

        }

        

        $data .= '</ul>';

        

        $index = 1;

        

        foreach ( $tab_posts as $post_id ) {

            

            $post = get_post( $post_id ); 
            $post = get_post( $post_id );  
            if(!isset($post)) { $post->post_title=''; $post->post_content='';}
            $post_title = $post->post_title;

            $post_content = $post->post_content;

            

            $post_content = do_shortcode( shortcode_unautop( $post_content ) );

                 if ( '</p>' == substr( $post_content, 0, 4 )

                 and '<p>' == substr( $post_content, strlen( $post_content ) - 3 ) )

                 $post_content = substr( $post_content, 4, strlen( $post_content ) - 7 );

            if($index==1){

                $data .= '<h2 id="selected-small-heading" class="small-menu-heading">' . $post_title . '</h2>';

            } else {

                $data .= '<h2 class="small-menu-heading">' . $post_title . '</h2>';

            }

            

            $data .= '<div id="menu-content-' . $index++ . '" style="display: block; ">';



            $data .= $post_content . '<br class="clear"></div>';

            

        }

        

	$data .= '<div class="clear"></div></div>';

        

        return $data;

        

}

add_shortcode( 'content_with_menu_wrapper_posts', 'content_with_menu_wrapper_posts_func' );


















/*************************************

****** Column layout shortcodes ******

**************************************/

function content_half_func( $atts,  $content ) {

	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );
    
    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span6">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span6">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span6">' . $content . '</div>';
    }
}

add_shortcode( 'content_half', 'content_half_func' );


function content_third_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );

    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span4">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span4">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span4">' . $content . '</div>';
    }
}

add_shortcode( 'content_third', 'content_third_func' );


function content_two_third_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );

    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span8">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span8">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span8">' . $content . '</div>';
    }

}

add_shortcode( 'content_two_third', 'content_two_third_func' );


function content_quarter_func( $atts,  $content ) {
	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );

    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span3">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span3">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span3">' . $content . '</div>';
    }

}

add_shortcode( 'content_quarter', 'content_quarter_func' );


function content_two_quarter_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );

    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span6">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span6">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span6">' . $content . '</div>';
    }

}

add_shortcode( 'content_two_quarter', 'content_two_quarter_func' );


function content_three_quarter_func( $atts,  $content ) {

	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    if ( '</p>' == substr( $content, 0, 4 )
    and '<p>' == substr( $content, strlen( $content ) - 3 ) )
    $content = substr( $content, 4, strlen( $content ) - 7 );

    if ( $id == "first" ) {
        return '<div class="row">
                <div class="span9">' . $content . '</div>';
    }
    elseif ( $id == "last" ) {
        return '<div class="span9">' . $content . '</div>
                </div>';
    }
    else {
        return '<div class="span9">' . $content . '</div>';
    }
}

add_shortcode( 'content_three_quarter', 'content_three_quarter_func' );
















function left_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );



            return '<div class="left">' . $content . '</div>';

}



add_shortcode( 'left', 'left_func' );



function contact_func( $atts,  $content ) {

	extract( shortcode_atts( array('success' => 'Message sucessfuly sent!'), $atts ) );

    global $social_data; 
    global $contact_data; 
    
    $return_data = '';
		
	$admin_mail = $social_data['email'];

        if(!isset($contact_data))
            return $return_data;

        $return_data .= '<form data-sucess="' . $success . '" class="contact-form">';
			
			$return_data .= '<input data-placeholder="' . $admin_mail . '" class="none" type="text" name="envoo-admin-mail" value="' . $admin_mail . '">';
			
			$element_num = 0;

            if($contact_data):

                foreach ($contact_data as $element) { 

                    $element_num++;

                    $return_data .= '<div class="form-element-wrap">';

                    $placeholder_star = "";

                    $required = '';

                    if (isset($element['is_required']) && $element['is_required'] == 'on') {
                        $required = 'data-required="required"';
                        $placeholder_star = "*";
                    }

                    $validation = $element['validation'];

                    if ($element['input_type'] == 'text') {
                        $return_data .= '<input name="' . urlencode($element['placeholder']) . '" ' . $required . ' id="form-element-' . $element_num . '" type="text" data-validation="' . $validation . '" placeholder="' . $element['placeholder'] . $placeholder_star . '" data-placeholder="' . $element['placeholder'] . $placeholder_star . '" />';
                    } elseif ($element['input_type'] == 'textarea') {
                        $return_data .= '<textarea name="' . urlencode($element['placeholder']) . '" ' . $required . ' id="form-element-' . $element_num . '" data-validation="' . $validation . '" placeholder="' . $element['placeholder'] . $placeholder_star . '" data-placeholder="' . $element['placeholder'] . $placeholder_star . '"></textarea>';
                    } elseif($element['input_type']=='dropdown') {
                        $arr = explode('<br />', nl2br($element['textarea']));
                        $return_data .= '<select name="' . urlencode($element['label']) . '" ' . $required . ' id="form-element-' . $element_num . '">';
                        foreach ($arr as $el) {
                            $return_data .= '<option>' . $el . '</option>';
                        }
                        $return_data .= '</select>';
                    } elseif($element['input_type']=='checkbox') {
                        $arr = explode('<br />', nl2br($element['textarea']));
                        foreach($arr as $item) {
                            $return_data .= '<div class="check-radio"><input type="checkbox" id="'.urlencode($element['label']).'" name="'.  urlencode(trim($item)).'" value="'.trim($item).'"><label for="'.urlencode($element['label']).'">'.$item.'</label></div>';
                        }
                    } elseif($element['input_type']=='radio') {
                        $arr = explode('<br />', nl2br($element['textarea']));
                        foreach($arr as $item) {
                            $return_data .= '<div class="check-radio"><input type="radio" id="'.urlencode($element['label']).'" name="'.urlencode(trim($item)).'" value="'.trim($item).'"><label for="'.urlencode($element['label']).'">'.$item.'</label></div>';
                        }
                    } elseif($element['input_type']=='captcha') {
                        $publickey = $element['public_key']; 
                        $return_data .= "<div class='captcha'>" . recaptcha_get_html($publickey) . "</div>";
                        $return_data .= '<div class="clear"></div>';
                    }
                    
                    $return_data .= '</div>';
                }
    			$return_data .= '<div class="form-buttons">';
    				$return_data .= '<span class="btn" id="reset-form"><input type="button" value="Reset" /></span>';
    				$return_data .= '<span class="btn" id="send-form"><input type="submit" value="Send" /></span>';
    			$return_data .= '</div>';
    	        $return_data .= '</form>';

            return $return_data;
        endif;
}



add_shortcode( 'contact', 'contact_func' );













function services_func( $atts,  $content ) {
    
    global $post;

	extract( shortcode_atts( array(), $atts ) );

	

	$return_data = '';

		

	$return_data .= '<div class="content" style="padding: 0"><div class="slider-arrow-left"></div><div class="slider-arrow-right"></div>   <div id="slider-wrapper"><div  id="slider"><ul class="slides">';

global $wpdb;

            $new_query = new WP_Query();

            $new_query->query( 'category_name=services&posts_per_page=99999' );



            //The Loop

            while ($new_query->have_posts()) : $new_query->the_post();

            $content = get_the_content();

        $return_data .= '<li><article><header><h3>' . get_the_title() . '</h3></header><figure>';

                        $link = get_the_content();  

                        

                        $min = strpos($link, '<span');

                        

                        $link = substr($link, 0, $min);

                        

                        $min = strpos($link, 'href="') + 6;

                        $max = strpos($link, '"', $min);

                        

                        

                        $cur = substr($link, $min, $max-$min);

                        

                        $link1 = substr($link, 0, $max + 1);

                        

                        $link2 = substr($link, $max + 2, strlen($link));

                        

                        #$attachment_ids = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date");

                        

                        $default_attr = array(

                                'class'	=> "services-photo-hover",

                        );

                        

                        

                        $attachments = get_posts( array(

                                'post_type' => 'attachment',

                                'posts_per_page' => -1,

                                'post_parent' => get_the_ID(),

                                'orderby' => 'id',

                                'order' => 'ASC'

                        ) );

                        

                        $att_id = 0;

                        foreach ( $attachments as $attachment ) {

                            if( get_post_thumbnail_id( $post->ID ) != $attachment->ID ) {

                                $att_id = $attachment->ID;

                            }

                        }

                        $link2 = str_replace($cur,'' . get_the_post_thumbnail($post->ID, 100, 64) . wp_get_attachment_image( $att_id, "portfolio", 0, $default_attr),$link2);
                            
                        $return_data = str_replace('0=""','',$return_data);
                        
                        $return_data .= $link1 . " " . $link2;

                        

                    

                    

                $return_data .= '</figure><p>';                   

                 

                     $content = str_replace($cur,"",$content);

                     $return_data .= $content; 
                     
                     $return_data = str_replace('<a href="" target="_blank"></a>','',$return_data);
                     
                $return_data .= '</p></article></li>';



        endwhile;

    $return_data .= '</ul>';

	wp_reset_query();

 $return_data .= '<div class="clear"></div></div></div></div>';





        return $return_data;

}



add_shortcode( 'services', 'services_func' );










function contact_info_func( $atts,  $content ) {

	extract( shortcode_atts( array( 'align' => '', ), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

			

	    global $wpdb;

        $data = $wpdb->get_results("SELECT id, icon, tekst FROM " . $wpdb->prefix . "envoo_contact_info");

		

		$margin = "right";

		

		if($align == "right") {

			$margin = "left";

		} else if( $align == "" ) {

			$margin = "";

			$align = "none";

		}
        
        if(empty($data))  {
            $data[0]->icon = '';
            $data[1]->icon = '';
            $data[2]->icon = '';
            $data[0]->tekst = '';
            $data[1]->tekst = '';
            $data[2]->tekst = '';
        }
                
	$return = '';	
                
	$return .= '<div style="float:' .  $align . '; 	margin-' .  $margin . ': 30px;" class="contact-info-wrapper"><table><tbody><tr>';

        $return .= '<td><div id="pin" style="background: url(' . $data[0]->icon . ');"></div></td>';

        $return .= '<td>' . nl2br($data[0]->tekst) . '

                    </td>

                </tr>

            

            <tr><td style="height: 17px"></td></tr>

            <tr><td>

                    <div id="phone" style="background: url(' . $data[1]->icon . ');"></div></td><td>' . nl2br($data[1]->tekst) . '</td></tr>

           <tr><td><div id="mail" style="background: url(' . $data[2]->icon . ');"></div></td><td>' . nl2br($data[2]->tekst) . '</td></tr></tbody></table></div>';

		
	return '<div class="contact-info-' . $align . '">' . $return . '</div>';

}



add_shortcode( 'contact_info', 'contact_info_func' );













function add_shortcode_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );
        
        global $wpdb;

        $data_blocks = $wpdb->get_results("SELECT id, title, url, icon, hover_icon FROM " . $wpdb->prefix . "envoo_blocks");

        $data_shortcode = $data_blocks[1]->title;

        
        $data_shortcode = do_shortcode( shortcode_unautop( $data_shortcode ) );

        
        
        
        
        
        return $data_shortcode; 

}

add_shortcode( 'add_shortcode', 'add_shortcode_func' );



function statement_box_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'title'   => 'Title',
                'button'  => 'Click here',
                'link'    => ''
            ), $atts ) );
        
	return '<div class="box statement-box">
                    <div class="statement-box-left">
                        <h2>' . $title . '</h2>
                        <p>' . $content . '</p>
                    </div>
                    <div class="statement-box-right">
                        <a href="' . $link . '">
                            <form action="' . $link . '">
                                <button>' . $button . '</button>
                            </form>
                        </a>
                    </div>
              </div>';
}
add_shortcode( 'statement_box', 'statement_box_func' );


function testimonial_func( $atts,  $content ) {

	extract( shortcode_atts( array( 'name' => 'John Doe', ), $atts ) );


	return '<div class="testimonial"><p>' . $content . '</p><span>' . $name . '</span></div>';

}

add_shortcode( 'testimonial', 'testimonial_func' );


$pricing_table_counter = 0;

function pricing_table_func( $atts,  $content ) {
    extract( shortcode_atts( array( 
        'name' => 'John Doe', 
    ), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    global $pricing_table_counter;
    $content = '<div class="clearfix pricing-table pricing-columns-' . $pricing_table_counter . '">' . $content . '</div>';

    $pricing_table_counter = 0; 
    return $content;
}

add_shortcode( 'pricing_table', 'pricing_table_func' );


function pricing_column_func( $atts,  $content ) {

    extract( shortcode_atts( array(
            'exposed' => false
        ), $atts ) );

    global $pricing_table_counter;
    $pricing_table_counter++;

    if($exposed) {
        $exposed = " exposed";
    } else {
        $exposed = "";
    }

    return '<div class="pricing-table-column' . $exposed . '">' . do_shortcode( shortcode_unautop( $content ) ) . "<div class='pricing-table-column-before'></div></div>";
}

add_shortcode( 'pricing_column', 'pricing_column_func' );


function pricing_price_func( $atts,  $content ) {

    extract( shortcode_atts( array(
            'currency' => '&#8364;',
            'decimal_sign' => ',',
            'decimal'  => '00',
            'title' => 'Title'
        ), $atts ) );

    return '<div class="pricing-table-price"><span class="price"><span class="currency">' . $currency . '</span>' . $content . $decimal_sign . '</span><span class="decimal">' . $decimal . '</span></div><div class="pricing-table-title">' . $title . '</div>';
}

add_shortcode( 'pricing_price', 'pricing_price_func' );


function pricing_row_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );

    return '<div class="pricing-table-row">' . $content . "</div>";
}

add_shortcode( 'pricing_row', 'pricing_row_func' );


function pricing_footer_func( $atts,  $content ) {
    extract( shortcode_atts( array(
            'link' => ''
        ), $atts ) );

    return '<div class="pricing-table-footer">'
    . do_shortcode('[button size="small" gradient_top="" gradient_bottom="" font_color="#ffffff" link="' . $link . '" target=""]' . $content . '[/button]') .
    '</div>';
}
add_shortcode( 'pricing_footer', 'pricing_footer_func' );





function slider_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
        
	return '<div class="slider-short">' . do_shortcode( shortcode_unautop( $content ) ) . '
	<div class="slider-short-controls">
            <a class="slider-short-left-control"></a>
            <a class="slider-short-right-control"></a>
    </div>
	</div>';
}

add_shortcode( 'slider', 'slider_func' );


function slide_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'link' => '',
			'target' => ''
        ), $atts ) );
        
		if ( $target != '' ) {
			$target = 'target="' . $target . '"';
		}
		
	return '<a class="slide" ' . $target . ' href="' . $link . '"><img alt="" src="' . do_shortcode( shortcode_unautop( $content ) ) . '" /></a>';
}

add_shortcode( 'slide', 'slide_func' );


















/* Icon shortcode */


function icon_func( $atts,  $content ) {
	extract( shortcode_atts( array(
        'link'    => '',
		'target'  => '',
		'icon_url' => '',
		'title'   => 'Title'    
    ), $atts ) );
    
	if ( $target != '' ) {
		$target = 'target="' . $target . '"';
	}
		
	$return_data = "";

	return  '<a ' . $target . ' href="' . $link . '" class="icons-shortcode">
				<span class="icons-shortcode-left">
					<img alt="icon-image" class="icons-shortcode-img" src="' . $icon_url . '" />
				</span>

                <div class="icons-shortcode-right">
				    <h3>' . $title . '</h3>
				    <p class="icons-shortcode-desc">' . $content . '</p>
                </div>
			</a>';
}

add_shortcode( 'icon', 'icon_func' );


/* Tabs shortcodes */

$tabs = 0;

function tabs_func( $atts,  $content ) {
	extract( shortcode_atts( array(
        'tab1' => '',
		'tab2' => '',
		'tab3' => '',
        'tab4' => '',
        'tab5' => ''
    ), $atts ) );
		
    global $tabs, $tabs_first;
		
	if( $tab1 != '' ) {
		$tab1 = '<li class="active"><a href="#tab-' . $tabs . '-1" data-toggle="tab">'. $tab1 . '</a></li>';
	}
	
	if( $tab2 != '' ) {
		$tab2 = '<li><a href="#tab-' . $tabs . '-2" data-toggle="tab">'. $tab2  . '</a></li>';
	}
	
	if( $tab3 != '' ) {
		$tab3 = '<li><a href="#tab-' . $tabs . '-3" data-toggle="tab">'. $tab3  . '</a></li>';
	}

    if( $tab4 != '' ) {
        $tab4 = '<li><a href="#tab-' . $tabs . '-4" data-toggle="tab">'. $tab4  . '</a></li>';
    }

    if( $tab5 != '' ) {
        $tab5 = '<li><a href="#tab-' . $tabs . '-5" data-toggle="tab">'. $tab5  . '</a></li>';
    }
		
    $content = do_shortcode($content);

    $tabs_single = 0;
    $tabs++;
    $tabs_first = true;

	return '<ul class="nav nav-tabs">
				'. $tab1 .'
				'. $tab2 .'
				'. $tab3 .'
                '. $tab4 .'
                '. $tab5 .'
			</ul>
			<div class="tab-content">' . $content . '</div>';
}

add_shortcode( 'tabs', 'tabs_func' );


$tabs_first = true;
$tabs_single = 0;

function tab_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );

    global $tabs, $tabs_first, $tabs_single;
    $active = "";

    if( $tabs_first ) {
        $active = " active";
    }

	$content = str_replace('&nbsp;', '<p class="blank-line clearfix"><br /></p>', $content);
	
    $tabs_first = false;
    $tabs_single++;

	return '<div id="tab-' . $tabs . '-' . $tabs_single . '" class="tab-pane fade in' . $active . '">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'tab', 'tab_func' );


$accordion_counter = 0;

function accordion_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        "opened" => "true"
    ), $atts ) );
        
    global $accordion_counter;
    $accordion_counter = 0;
    $content = do_shortcode(shortcode_unautop( $content ));

    if(isset($opened) && $opened == "true") {
        $opened = " opened";
    }

    return '<div class="accordion' . $opened . '">' .  $content . '</div>';
}
add_shortcode( 'accordion', 'accordion_func' );


function accordion_item_func( $atts,  $content ) {
    extract( shortcode_atts( array(
            'title' => 'Title'
    ), $atts ) );
        
        global $accordion_counter;
        
        $accordion_counter++;
        return '<div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#collapse' . $accordion_counter . '">' . $title . '</a>
                    </div>
                    <div id="collapse' . $accordion_counter . '" class="accordion-body collapse">
                        <div class="accordion-inner">' .  do_shortcode($content) . '</div>
                    </div>
                </div>';
}
add_shortcode( 'accordion_item', 'accordion_item_func' );


function progress_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        'percentage' => '100'
    ), $atts ) );
        
    return  '<div class="progress-bar">
                <div class="progres-bar-progress animatable" data-width="' . $percentage . '%"></div>
                <div class="progress-bar-inner">' . $content . ' / ' . $percentage . '%</div>
            </div>';
}
add_shortcode( 'progress', 'progress_func' );


function alert_func( $atts,  $content ) {
    extract( shortcode_atts( array(
            'type' => 'info'
    ), $atts ) );

    return '<div class="alert alert-' . $type . '">' . 
                '<div class="alert-desc">' . $content . '</div>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';
}
add_shortcode( 'alert', 'alert_func' );


function quote_func( $atts,  $content ) {

    extract( shortcode_atts( array( 'sub' => '' ), $atts ) );

    if($sub) {
        $sub = '<span class="quote-sub">' . $sub . '</span>';
    }

    return '<blockquote>' . $content . $sub . '</blockquote>';

}

add_shortcode( 'quote', 'quote_func' );


function quote_box_func( $atts,  $content ) {

    extract( shortcode_atts( array( 'align' => 'left' ), $atts ) );

    return '<div class="quotebox quotebox-' . $align . '">' . $content . '</div>';

}

add_shortcode( 'quote_box', 'quote_box_func' );


function breadcrumbs_func( $atts,  $content ) {

    extract( shortcode_atts( array(), $atts ) );

    return '<div class="breadcrumbs">' . the_breadcrumb() . '</div>';

}

add_shortcode( 'breadcrumbs', 'breadcrumbs_func' );


$google_maps_counter = 0;

function google_maps_func( $atts,  $content ) {

    global $google_maps_counter;
    $google_maps_counter++;

    extract( shortcode_atts( array(
                'height' => '500',
                'layout' => 'boxed',
                'zoom' => '15'
        ), $atts ) );        

        return "<script>
                jQuery(document).ready(function( $ ) { 
                    $('#google-map$google_maps_counter').gmap3(
                    { action:'init',
                        options:{
                            zoom: {$zoom}
                        }
                    },
                    {
                        action: 'getLatLng',
                        address: '" . $content .  "',
                        callback: function(result){
                            $(this).gmap3(
                            {
                                action: 'setCenter', 
                                args:[ result[0].geometry.location ]
                            });
                        } 
                    }, 
                    {
                        action: 'addMarker',
                        address: '" . $content .  "'
                    }
                    );    
                });

                </script>
                <div style='height:{$height}px' class='google-maps' id='google-map$google_maps_counter'></div>
                ";
}



add_shortcode( 'google_maps', 'google_maps_func' );


function vimeo_func( $atts,  $content ) {

    extract( shortcode_atts( array(), $atts ) );
        
        return '<div class="video-wrapper"><iframe src="http://player.vimeo.com/video/' . $content . '" width="320" height="240" style="border: none !important"></iframe></div>';
}

add_shortcode( 'vimeo', 'vimeo_func' );


function youtube_func( $atts,  $content ) {

    extract( shortcode_atts( array(), $atts ) );

        return '<div class="video-wrapper"><iframe src="http://www.youtube.com/embed/' . $content . '?wmode=transparent" width="560" height="315" style="border: none !important"></iframe></div>';
}

add_shortcode( 'youtube', 'youtube_func' );


function person_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        'name'      => 'John Doe',
        'picture'   => '',
        'title'     => 'Title',
        'facebook'  => '',
        'twitter'   => '',
        'linkedin'  => '',
        'dribble'   => '',
        'google'    => ''
    ), $atts ) );
        
    $data_return = "<article class='person'>";
    $data_return .= '<header><img alt="Person image" class="clearfix" src="' . $picture . '"></header>';
    $data_return .= '<h3>' . $name . ' / <em>' . $title . '</em></h3>';
    $data_return .= '<p>' . $content . '</p>';
    $data_return .= '<div>';
    $before = false;

        if( $facebook ) {
            $data_return .= '<a href="' . $facebook . '">Facebook</a>';
            $before = true;
        }
        if ( $twitter ) {
            if($before) {
                $data_return .= '<span>/</span>';
            }
            $data_return .= '<a href="' . $twitter . '">Twitter</a>';
            $before = true;
        }
        if ( $dribble ) {
            if($before) {
                $data_return .= '<span>/</span>';
            }
            $data_return .= '<a href="' . $dribble . '">Dribble</a>';
            $before = true;
        }
        if ( $google ) {
            if($before) {
                $data_return .= '<span>/</span>';
            }
            $data_return .= '<a href="' . $google . '">Google</a>';
            $before = true;
        }
        if ( $linkedin ) {
            if($before) {
                $data_return .= '<span>/</span>';
            }
            $data_return .= '<a href="' . $linkedin . '">LinkedIn</a>';
            $before = true;
        }

    $data_return .= '</div>';
    $data_return .= '</article>';
        
    return  $data_return;
}
add_shortcode( 'person', 'person_func' );


$number_of_logos = 0;

function logo_box_func( $atts,  $content ) {
    extract( shortcode_atts( array(
    ), $atts ) );
        
        
        $content = do_shortcode( shortcode_unautop( $content ) );
        
        global $number_of_logos;
        
        $type = "more";
        
        switch ( $number_of_logos ) {
            case 1: $type = 'one'; break;
            case 2: $type = 'two'; break;
            case 3: $type = 'three'; break;
        }
        
        $number_of_logos = 0;
        
    return '<div class="box logo-box logo-box-' . $type . '">' . $content . '</div></div>';
}

add_shortcode( 'logo_box', 'logo_box_func' );


function logo_func( $atts,  $content ) {
    extract( shortcode_atts( array(
            'link' => ''
    ), $atts ) );
        
        
        global $number_of_logos;
        
        $number_of_logos++;
        
        $return_data  = '';
        
        if( $number_of_logos == 1 ) {
            $return_data  = '<div class="logo-box-row">';
        } else if ( $number_of_logos %5 == 0 ) {
            $return_data  = '</div><div class="logo-box-row">';
        }
        
    return $return_data . '<div class="logo"><a target="_blank" href="' . $link . '"><img alt="logo" src="' .  $content . '" /></a></div>';
}

add_shortcode( 'logo', 'logo_func' );


function button_func( $atts,  $content ) {

    extract( shortcode_atts( array(
        'link'       => '',
        'target'     => '',
        'size'       => 'small',
        'style'      => '',
        'color'      => '',
        'background' => '',

    ), $atts ) );
     
    $style_attr = "";

    if($color) {
        $style_attr .= "color: " . $color . ";";
    }

    if($background) {
        $style_attr .= "background: " . $background . ";";
    }

    if ( $target != '' ) {
        $target = ' target="' . $target . '"';
    }
    
    switch($size) {
        case "large": $size = "btn-large"; break;
        case "medium": $size = ""; break;
        case "small": $size = "btn-small"; break;
    }

    return '<a' . $target . ' href="' . $link . '" style="' . $style_attr . '" class="btn ' . $size . ' btn-' . $style . '"><span>' . $content . '</span></a>';

}

add_shortcode( 'button', 'button_func' );


function list_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        'type' => 'default'
            ), $atts ) );
    
        $tags = 'ul';
        
        if ( $type == 'number' ) {
            $tags = 'ol';
        }
        
    return '<' . $tags . ' class="list list-' . $type . '">' . do_shortcode( shortcode_unautop( $content ) ) . '</' . $tags . '>';
}

add_shortcode( 'list', 'list_func' );


function list_item_func( $atts,  $content ) {
    extract( shortcode_atts( array(
    ), $atts ) );
        
    return '<li>' . $content . '</li>';
}

add_shortcode( 'list_item', 'list_item_func' );


function recent_posts_func( $atts,  $content ) {

    $query = new WP_Query();
    $query->query( 'posts_per_page=' . $content . '&paged=-1&post_type=post' );
    
    $return_data = '';
    
    global $more, $post;
    $more = 0;
    
    $return_data .= '<div class="row-fluid">';

    while ($query->have_posts()) : $query->the_post(); ?>
        <?php $return_data .= '<article class="span3 single-post2">'; ?>
            <?php 
                $number_of_chars = 50;
            ?>
            
            <?php if ( get_the_post_thumbnail($post->ID, 'full') == "" ): ?>
                    <?php 
                        $number_of_chars = 50; 
                    ?>
            <?php else: ?>
                    <?php $return_data .= get_the_post_thumbnail($post->ID, 'full');  ?>
            <?php endif; ?>         
            
            <?php $return_data .= '<div class="single-post2-content">'; ?>
                <?php $return_data .= '<h4>' . get_the_title() . '</h4>'; ?>
                <?php $return_data .= '<p>' . mb_substr(strip_tags(get_the_content('')), 0, $number_of_chars)  . '...</p>'; ?>
                <?php $return_data .= '<span class="single-post2-more">'; ?>
                    <?php $return_data .= '<a class="single-post2-lightbox" data-rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '"></a>'; ?>  
                    <?php $return_data .= '<a class="single-post2-open" href="' . get_permalink() . '"></a>'; ?>                        
                <?php $return_data .= '</span>'; ?>
            <?php $return_data .= '</div>'; ?>
        <?php $return_data .= '</article>'; ?>
    <?php endwhile;

    $return_data .= '</div>';

    return $return_data;

}

add_shortcode( 'recent_posts', 'recent_posts_func' );


function projects_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        'type' => 'default',
        'orderby' => 'id',
        'order' => 'DESC',
        'categories' => ''
    ), $atts ) );

    $current_ID = get_the_ID();

    global $more, $post;
    $more = 0;

    $args = array(
        'post_type' => 'portfolio',
        'orderby' => $orderby,
        'order' => $order,
        'numberposts' => -1,
    );

    $categories = explode(",", $categories);

    $portfolio_posts = get_posts($args);

    $return_data = '';
    $return_data .= '<div class="row-fluid">';

    $counter = 0;

    foreach ($portfolio_posts as $post) : setup_postdata($post); ?>

        <?php
            $continue = true;
            if (get_the_terms($post->ID, 'portfolio_category' && (count($categories) > 0  && $categories[0] != "" ))) {
                $continue = false;

                foreach (get_the_terms($post->ID, 'portfolio_category') as $cat) {
                    foreach ( $categories as $category ) {
                        if( strtolower($cat->name) == trim(strtolower($category)) ) {
                            $continue = true;
                            break;
                        }
                    }

                    if($continue) {
                        break;
                    }
                }
            }

            if(!$continue || $current_ID == $post->ID) {
                continue;
            }
            if($counter++ == $content) break;
        ?>

        <?php $return_data .= '<article class="span3 single-post2">'; ?>
            <?php 
                $number_of_chars = 50;
            ?>
            
            <?php if ( get_the_post_thumbnail($post->ID, 'full') == "" ): ?>
                    <?php 
                        $number_of_chars = 50; 
                    ?>
            <?php else: ?>
                    <?php $return_data .= get_the_post_thumbnail($post->ID, 'full');  ?>
            <?php endif; ?>         
            
            <?php $return_data .= '<div class="single-post2-content">'; ?>
                <?php $return_data .= '<h4>' . get_the_title() . '</h4>'; ?>
                <?php $return_data .= '<p>' . mb_substr(strip_tags(get_the_content('')), 0, $number_of_chars)  . '...</p>'; ?>
                <?php $return_data .= '<span class="single-post2-more">'; ?>
                    <?php $return_data .= '<a class="single-post2-lightbox" data-rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '"></a>'; ?>  
                    <?php $return_data .= '<a class="single-post2-open" href="' . get_permalink() . '"></a>'; ?>                        
                <?php $return_data .= '</span>'; ?>
            <?php $return_data .= '</div>'; ?>
        <?php $return_data .= '</article>'; ?>

    <?php endforeach;

    $return_data .= '</div>';

    return $return_data;
}

add_shortcode( 'projects', 'projects_func' );






















function error_404_func( $atts,  $content ) {
	extract( shortcode_atts( array(
        'before' => '',
        'after' => ''
    ), $atts ) );
		
	return '<div class="error-404">
                <h2>' .  htmlspecialchars($before) . '</h2>
                <h1 class="error_title">' . $content . '</h1>
                <h3>' . htmlspecialchars_decode($after) . '</h3>
            </div>';
}

add_shortcode( 'error_404', 'error_404_func' );


function error_sub_title_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h3 class="error_sub_title">' . $content . '</h3>';
}

add_shortcode( 'error_sub_title', 'error_sub_title_func' );



function error_text_large_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h4 class="error_text_large">' . $content . '</h4>';
}

add_shortcode( 'error_text_large', 'error_text_large_func' );


function error_text_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h5 class="error_text">' . $content . '</h5>';
}

add_shortcode( 'error_text', 'error_text_func' );



$photostreams = 0;

function photostream_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'limit' => '8',
			'title' => 'Photostream',
			'social_network' => 'dribbble'
        ), $atts ) );
        
		global $photostreams;
		
		$root = get_stylesheet_directory_uri() . "/photostream/";

        wp_register_script( 'bra_photostream', $root."bra_photostream_widget.js", array('jquery'), '1.3', true );
        wp_enqueue_script( 'bra_photostream' );
        
        wp_register_style( 'bra_photostream', $root."bra_photostream_widget.css");
        wp_enqueue_style( 'bra_photostream' );

        
        $hover_color = '#ffffff';
	
		 $user = $content;
        
	    $unique_id =  $user . $social_network . $limit . $photostreams ;
	    $html = '<div class="photostream clearfix" id="' . $unique_id . $photostreams  .'"></div>';
	    $html .= '<script type="text/javascript"> jQuery(document).ready(function($){ ';
	    $html .= '$("#' . $unique_id  . $photostreams .'").bra_photostream({user: "' . $content . '", limit:' . $limit . ', social_network: "' . $social_network . '"});';
	    $html .= '});</script>';
		
		$photostreams++;
		
		return "<h4>" . $title . "</h4>" . $html;
}

add_shortcode( 'photostream', 'photostream_func' );






function image_links_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '</div><div class="main-wrapper portfolio-wrapper recent-projects "><ul class="portfolio clearfix image_links">' . do_shortcode($content) . '</ul></div><div>';
}

add_shortcode( 'image_links', 'image_links_func' );



function image_link_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'title' => 'Title',
			'url' => 'http://anpsthemes.com/azul/',
			'target' => '_blank',
			'image_url' => ''
        ), $atts ) );
		$val = '<img src="' . $image_url . '"><div class="portfolio-responsive"><img src="' . $image_url . '" class="attachment-portfolio-first-responsive wp-post-image" alt="" title=""></div><div class="portfolio-hover"><h3><a target="' . $target. '" href="' . $url . '">' . $title . '</a></h3><p>' . $content. '</p><a target="' . $target. '" href="' . $url . '" class="open"></a></div>';
		return '<li class="isotope-item  page-1 four-column">' . $val . '<h3>' . $title . '</h3></li>';
}

add_shortcode( 'image_link', 'image_link_func' );



function mega_product_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );

    $args = array( 'post_type' => 'product', "p" => $content );
    $loop = new WP_Query( $args );
    $return = "";

    ob_start();

    while ( $loop->have_posts() ) : $loop->the_post();

        woocommerce_get_template( 'loop/price.php' );

        echo '<a href="' . get_permalink($content) . '">' . get_the_post_thumbnail($content, "full") . '</a>';

    endwhile; wp_reset_query();

    return ob_get_clean();
}

add_shortcode( 'mega_product', 'mega_product_func' );