<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/
return array(
    // 'js' => array('//js/file1.js', '//js/file2.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
    'js' => array($min_documentRoot.'/js/date.js', $min_documentRoot.'/js/jquery.dataTables.min.js', $min_documentRoot.'/js/jquery-add-ons.js', $min_documentRoot.'/js/tooltips.js',),
    'css' => array($min_documentRoot.'/css/tabs.css', $min_documentRoot.'/css/style.css', $min_documentRoot.'/css/demo_page.css', $min_documentRoot.'/css/demo_table_jui.css', $min_documentRoot.'/themes/smoothness/jquery-ui-1.8.4.custom.css'),
);