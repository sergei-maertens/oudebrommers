<?php
/**
*
* @package watermark
* @version $Id: watermark_afterward_text_acp.php 2356 2010-05-28 11:06:13Z 4seven $
* @copyright (c) 2010 / 4seven
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
?>