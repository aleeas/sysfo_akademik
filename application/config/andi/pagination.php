<?php
/**
 * Description of pagination
 *
 * @author Andi Susilo
 */
$config = array(
        'per_page' => 10,
        'uri_segment' => 3,
        'first_tag_open' => '<li class="first">',
        'first_tag_close' => '</li>',
        'prev_tag_open' => '<li class="prev">',
        'prev_tag_close' => '</li>',
        'next_tag_open' => '<li class="next">',
        'next_tag_close' => '</li>',
        'last_tag_open' => '<li class="last">',
        'last_tag_close' => '</li>',
        'cur_tag_open' => '<li class="selected"><a href="#">',
        'cur_tag_close' => '</a></li>',
        'num_tag_open' => '<li>',
        'num_tag_close' => '</li>',
//        'display_pages' => false,

        'per_pages' => array( 10, 25, 50, 100, 200 ),
        'per_page_changer_prefix' => 'Show: ',
);
