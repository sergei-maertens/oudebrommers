<?php
/**
*
* @package watermark
* @version $Id: watermark_message_text_user.php 2010-05-03 11:06:13Z 4seven $
* @copyright (c) 2010 4seven
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

   // let's start the watermark procedure  - check if it's a pic
   if (file_exists($phpbb_root_path . 'files/' . $filedata['physical_filename'])){

   // make a backup of un-watermarked fullsize images
   if ($config['watermark_backup_on_off'] == 1){

   // backup folder path
   $backup_path = $phpbb_root_path . 'files/backup/';

   copy($phpbb_root_path . 'files/' . $filedata['physical_filename'], $phpbb_root_path . 'files/backup/' . $filedata['physical_filename']);}

   // Text Watermark Engine
   if (!defined('WATERMARK_MARGIN_ADJUST')){
   define( 'WATERMARK_MARGIN_ADJUST', 5 );}
   if (!defined('WATERMARK_FONT_REALPATH')){
   define( 'WATERMARK_FONT_REALPATH', $phpbb_root_path . 'includes/watermark/fonts/' );}

   if(!function_exists('render_text_on_gd_image')){
   function render_text_on_gd_image( &$source_gd_image, $text, $font, $size, $color, $opacity, $rotation, $align )
    {

  $source_width = imagesx( $source_gd_image );
  $source_height = imagesy( $source_gd_image );

  $bb = imagettfbbox_fixed( $size, $rotation, $font, $text );

  $x0 = min( $bb[ 0 ], $bb[ 2 ], $bb[ 4 ], $bb[ 6 ] ) - WATERMARK_MARGIN_ADJUST;
  $x1 = max( $bb[ 0 ], $bb[ 2 ], $bb[ 4 ], $bb[ 6 ] ) + WATERMARK_MARGIN_ADJUST;
  $y0 = min( $bb[ 1 ], $bb[ 3 ], $bb[ 5 ], $bb[ 7 ] ) - WATERMARK_MARGIN_ADJUST;
  $y1 = max( $bb[ 1 ], $bb[ 3 ], $bb[ 5 ], $bb[ 7 ] ) + WATERMARK_MARGIN_ADJUST;

  $bb_width = abs( $x1 - $x0 );
  $bb_height = abs( $y1 - $y0 );

  switch ( $align )
  {
   case 'TL':
    $bpy = -$y0;
    $bpx = -$x0;
    break;
   case 'TM':
    $bpy = -$y0;
    $bpx = $source_width / 2 - $bb_width / 2 - $x0;
    break;
   case 'TR':
    $bpy = -$y0;
    $bpx = $source_width - $x1;
    break;
   case 'CL':
    $bpy = $source_height / 2 - $bb_height / 2 - $y0;
    $bpx = -$x0;
    break;
   case 'C':
    $bpy = $source_height / 2 - $bb_height / 2 - $y0;
    $bpx = $source_width / 2 - $bb_width / 2 - $x0;
    break;
   case 'CR':
    $bpy = $source_height / 2 - $bb_height / 2 - $y0;
    $bpx = $source_width - $x1;
    break;
   case 'BL':
    $bpy = $source_height - $y1;
    $bpx = -$x0;
    break;
   case 'BM':
    $bpy = $source_height - $y1;
    $bpx = $source_width / 2 - $bb_width / 2 - $x0;
    break;
   case 'BR';
    $bpy = $source_height - $y1;
    $bpx = $source_width - $x1;
    break;
   }

   $alpha_color = imagecolorallocatealpha(
   $source_gd_image,
   hexdec( substr( $color, 0, 2 ) ),
   hexdec( substr( $color, 2, 2 ) ),
   hexdec( substr( $color, 4, 2 ) ),
   127 * ( 100 - $opacity ) / 100
   );

   // Only for the '© username, submitted @' Construct
   global $config;

   $blend_color = imagecolorallocatealpha(
   $source_gd_image,
   hexdec( substr( $config['watermark_text_sha_color'], 0, 2 ) ),
   hexdec( substr( $config['watermark_text_sha_color'], 2, 2 ) ),
   hexdec( substr( $config['watermark_text_sha_color'], 4, 2 ) ),
   127 * ( 100 ) / 100
   );

   // Text transform
   $raw_text_func = utf8_normalize_nfc($config['watermark_text']);

   // Formular
   if((request_var('watermarkyes', '', true) == 'user')
   &&((request_var('poswmuser', '', true) == 'BL')
   or (request_var('poswmuser', '', true) == 'BM')
   or (request_var('poswmuser', '', true) == 'BR'))) {
   $maskenbild=imagecreatetruecolor($source_width,$size+$size);
   imagefill($maskenbild,0,0,$blend_color);
   imagecopymerge($source_gd_image,$maskenbild,0,$source_height-($size+$size),0,0,$source_width,$size+$size,$config['watermark_sha_text_pos']);}

   // Formular
   if((request_var('watermarkyes', '', true) == 'user')
   &&((request_var('poswmuser', '', true) == 'TL')
   or (request_var('poswmuser', '', true) == 'TM')
   or (request_var('poswmuser', '', true) == 'TR'))){
   $maskenbild=imagecreatetruecolor($source_width,$size+$size);
   imagefill($maskenbild,0,0,$blend_color);
   imagecopymerge($source_gd_image,$maskenbild,0,0,0,0,$source_width,$size+$size,$config['watermark_sha_text_pos']);}

   // imagettftext($source_gd_image, $size, $rotation, $bpx+2, $bpy+2, $blend_color, WATERMARK_FONT_REALPATH . $font, $text);

   return imagettftext($source_gd_image, $size, $rotation, $bpx, $bpy, $alpha_color, WATERMARK_FONT_REALPATH . $font, $text);

       }
    }

 // imagettfbbox_fixed
 // FIX FOR THE BUGGY IMAGETTFBBOX IMPLEMENTATION IN GD LIBRARY

 if(!function_exists('imagettfbbox_fixed')){
 function imagettfbbox_fixed( $size, $rotation, $font, $text )
 {
  $bb = imagettfbbox( $size, 0, WATERMARK_FONT_REALPATH . $font, $text );
  $aa = deg2rad( $rotation );
  $cc = cos( $aa );
  $ss = sin( $aa );
  $rr = array( );
  for( $i = 0; $i < 7; $i += 2 )
  {
   $rr[ $i + 0 ] = round( $bb[ $i + 0 ] * $cc + $bb[ $i + 1 ] * $ss );
   $rr[ $i + 1 ] = round( $bb[ $i + 1 ] * $cc - $bb[ $i + 0 ] * $ss );
  }
  return $rr;
 }
 }

 // CREATE WATERMARK FUNCTION

 if (!defined('WATERMARK_OUTPUT_QUALITY')){
 define( 'WATERMARK_OUTPUT_QUALITY', 100 );}

 if(!function_exists('create_watermark_from_string')){
 function create_watermark_from_string( $source_file_path, $output_file_path, $text, $font, $size, $color, $opacity, $rotation, $align )
 {
  list( $source_width, $source_height, $source_type ) = getimagesize( $source_file_path );

  if ( $source_type === NULL )
  {
   return false;
  }

  switch ( $source_type )
  {
   case IMAGETYPE_GIF:
    $source_gd_image = imagecreatefromgif( $source_file_path );
    break;
   case IMAGETYPE_JPEG:
    $source_gd_image = imagecreatefromjpeg( $source_file_path );
    break;
   case IMAGETYPE_PNG:
    $source_gd_image = imagecreatefrompng( $source_file_path );
    break;
   default:
    return false;
  }

  render_text_on_gd_image( $source_gd_image, $text, $font, $size, $color, $opacity, $rotation, $align );

  imagejpeg( $source_gd_image, $output_file_path, WATERMARK_OUTPUT_QUALITY );
  imagedestroy( $source_gd_image );
       }
    }

  //-------------------------------------------

   // Check if Private Watermark Text is empty
   $private_wm = utf8_normalize_nfc(request_var('watermarktext', '', true));

  // Text transform and wordwrap
  $raw_text =  htmlspecialchars_decode(utf8_normalize_nfc($config['watermark_text']));
  $new_text = wordwrap($raw_text, $config['watermark_text_cut'], "\n");

   if(!empty($private_wm)){
   $private_watermark = true;
   $private_wm_text   = htmlspecialchars_decode($private_wm);}
   elseif(!empty($new_text)){
   $private_watermark = true;
   $private_wm_text   = $new_text;}
   else{
   $private_watermark = false;
   $private_wm_text   = '';}

  //  No-Thumbs Path Variables
  $uploaded_file_path  = $phpbb_root_path . 'files/' . $filedata['physical_filename'];
  $processed_file_path = $uploaded_file_path;

  // Clear Anonymous Namespace
  if ($user->data['username']  == 'Anonymous'){
  $user->data['username'] = str_replace('Anonymous', $user->lang['GUEST'], $user->data['username']);}

  // Check Size of Attachment
  $source_w            = getimagesize( $uploaded_file_path );
  $source_w            = $source_w[0];

  // Formular Data
  $wm_size    = request_var('sizwm', '', true);
  $wm_size_u  = request_var('sizwmuser', '', true);
  $wm_color   = request_var('farbe_2', '', true);
  $wm_color_u = request_var('farbe_1', '', true);
  $wm_pos     = request_var('poswm', '', true);
  $wm_pos_u   = request_var('poswmuser', '', true);
  $wm_deg     = request_var('degwm', '', true);
  $wm_font    = request_var('fontwm', '', true);
  $wm_font_u  = request_var('fontwmuser', '', true);

  // Thumbing Attachment
  // PRIVAT MODE
  if (($private_watermark) && (request_var('watermarkyes', '', true) == 'privat')){
  create_watermark_from_string(
  $uploaded_file_path, $processed_file_path,
  $private_wm_text,
  $wm_font,
  round($source_w / $wm_size),
  $wm_color,
  $config['watermark_text_transparency'],
  $wm_deg,
  $wm_pos );}

  // USER MODE
  else if ((request_var('watermarkyes', '', true) == 'user')
  && (($wm_pos_u !== 'CL') or ($wm_pos_u !== 'C') or ($wm_pos_u !== 'CR'))){
  create_watermark_from_string(
  $uploaded_file_path, $processed_file_path,
  '© ' . $user->data['username'] . ', submitted ' . date($config['default_dateformat'],
  $filedata['filetime']),
  $wm_font_u,
  round($source_w / $wm_size_u),
  $wm_color_u,
  $config['watermark_text_transparency'],
  0,
  $wm_pos_u );}

  //-------------------------------------------

  // Let's start the watermark procedure for thumb images - check if it's a pic
  if (file_exists($phpbb_root_path . 'files/thumb_' .$filedata['physical_filename'])){

  // Make a backup of un-watermarked thumb images
  if ($config['watermark_backup_on_off'] == 1){
  copy($phpbb_root_path . 'files/thumb_' . $filedata['physical_filename'],
  $phpbb_root_path . 'files/backup/thumb_' . $filedata['physical_filename']);}

  // Thumbs Path Variables
  $uploaded_file_path_th  = $phpbb_root_path . 'files/thumb_' . $filedata['physical_filename'];
  $processed_file_path_th = $uploaded_file_path_th;

  // Check Size of Attachment Thumb
  $source_w_th = getimagesize( $uploaded_file_path_th );
  $source_w_th = $source_w_th[0];


  // Thumbing Attachment Thumb
  // PRIVAT MODE
  if (($private_watermark) && (request_var('watermarkyes', '', true) == 'privat')){
  create_watermark_from_string(
  $uploaded_file_path_th, $processed_file_path_th,
  $private_wm_text,
  $wm_font,
  round($source_w_th / $wm_size),
  $wm_color,
  $config['watermark_text_transparency'],
  $wm_deg,
  $wm_pos );}

  // USER MODE
  else if ((request_var('watermarkyes', '', true) == 'user')
  && (($wm_pos_u !== 'CL') or ($wm_pos_u !== 'C') or ($wm_pos_u !== 'CR'))){
  create_watermark_from_string(
  $uploaded_file_path_th, $processed_file_path_th,
  '© ' . $user->data['username'] . ', submitted ' . date($config['default_dateformat'],
  $filedata['filetime']),
  $wm_font_u,
  round($source_w_th / $wm_size_u),
  $wm_color_u,
  $config['watermark_text_transparency'],
  0,
  $wm_pos_u );}

    }
  }
?>