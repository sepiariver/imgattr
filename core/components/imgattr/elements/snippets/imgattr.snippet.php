<?php
/**
 * imgattr
 *
 * @author @sepiariver
 * Huge shout-out and thank you to @netProphET
 * https://gist.github.com/netProphET
 * for testing, code review and improvements
 * 
 * GPL2, no warranties, no liability, etc.
 * 
 * DESCRIPTION
 *
 * An output filter that returns attributes from an image file, using PHP getimagesize().
 *
 * USAGE:
 *
 * Where the value of [[*image_tv]] is 'assets/images/photo.jpg' with dimensions 100px x 50px.
 * [[*image_tv:imgattr=`filename`]] => 'photo.jpg'
 * [[*image_tv:imgattr=`filenameNoExt`]] => 'photo'
 * [[*image_tv:imgattr=`width`]] => '100'
 * [[*image_tv:imgattr=`height`]] => '50'
 * [[*image_tv:imgattr=`dimensions`]] => 'width="100" height="50"'
 * [[*image_tv:imgattr=`mime`]] => 'image/jpeg'
 *
 */

/* $input is required */
$input = $modx->getOption('input', $scriptProperties, '');
if (!isset($input) || empty($input)) {
    $modx->log(modX::LOG_LEVEL_WARN, '[imgattr] No input provided.');
    return;
}

/* Prepend image paths with base path */
$input = parse_url($input, PHP_URL_PATH);
$base_url = $modx->getOption('base_url');
$base_path = $modx->getOption('base_path');
if (substr($input, 0, strlen($base_url)) == $base_url) {
    $input = substr($input, strlen($base_url));
}
$input = $base_path . $input;

/* Check for readable file */
if (!file_exists($input) || !is_readable($input)) {
    $modx->log(modX::LOG_LEVEL_ERROR, "[imgattr] No readable input file $input");
    return;
}

/* Get image attributes */
$attr = array();
$attr = getimagesize($input);

/* Did we do that right? */
if (!$attr) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[imgattr] Failed to retrieve image attributes.');
    return;
}

/* Get the pathinfo */
$pathinfo = array();
$pathinfo = pathinfo($input);

/* Output array */
$output = array(
    'filename' => $pathinfo['basename'],
    'filenameNoExt' => $pathinfo['filename'],
    'width' => $attr[0],
    'height' => $attr[1],
    'dimensions' => $attr[3],
    'mime' => $attr['mime'],
);

/* Set options */
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '');
if (empty($toPlaceholder)) return $output[(string) $options];
$modx->setPlaceholder($toPlaceholder, $output[(string) $options]);