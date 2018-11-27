<?php
/**
 * Created by PhpStorm.
 * User: Donghui Huo
 * Date: 2018/11/27
 * Time: 13:21
 */

function scanwp_buttons($buttons)
{
    array_unshift($buttons, 'fontselect');
    array_unshift($buttons, 'fontsizeselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'scanwp_buttons');
function scanwp_font_size($initArray)
{
    $initArray['fontsize_formats'] = "9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 24px 26px 28px 30px 36px 40px 48px 55px 60px 72px 100px";
    return $initArray;
}

add_filter('tiny_mce_before_init', 'scanwp_font_size');

// change section order
function change_frontpage_orders($value, $type)
{
    if ('hestia_subscribe' == $type) {
        return 60;
    } else if ('hestia_blog' == $type) {
        return 55;
    } else {
        return $value;
    }
}

add_filter('hestia_section_priority', 'change_frontpage_orders', 10, 2);


