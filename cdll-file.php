<?php
defined( 'ABSPATH' ) || exit;

//It updates the wp-config.php file
function eos_cdll_update_wp_config( $activate ){
  if( !function_exists( 'get_filesystem_method' ) ){
    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
  }
  $writeAccess = false;
	$access_type = get_filesystem_method();
	if( $access_type === 'direct' ){
		/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
		$creds = request_filesystem_credentials( admin_url(),'',false,false,array() );
		/* initialize the API */
		if ( ! WP_Filesystem( $creds ) ) {
      die();
      exit;
		}
		global $wp_filesystem;
		$writeAccess = true;
		if( empty( $wp_filesystem ) ){
			require_once ( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
    }
    $config_file_path = ABSPATH.'/wp-config.php';
    if( !file_exists( $config_file_path ) ){
      echo 'Change Debug Log Location was trying to update the file wp-config.php but it looks you have no wp-config.php';
      die();
      exit;
    }
    $config_file = file( $config_file_path );
    $unsetIdx = array();
    $n = 0;
    $new_debug_location = ABSPATH.'/debug-'.substr( md5( ABSPATH ),0,8 ).'.log';
    foreach ( $config_file as &$line ) {
  		if(
        false !== strpos( $line,'WP_DEBUG' )
        || ( false !== strpos( $line,'ini_set' ) && false !== strpos( $line,'log_errors' ) )
        || false !== strpos( $line,$new_debug_location )
      ){
        $unsetIdx[] = $n;
  		}
      ++$n;
  	}
    foreach( $unsetIdx as $idx ){
      if( isset( $config_file[$idx] ) ){
        unset( $config_file[$idx] );
      }
    }
    $handle = @fopen( $config_file_path, 'w' );
    if( $activate ){
      array_shift( $config_file );
  	  array_unshift( $config_file, "<?php\r\n","ini_set( 'log_errors', 1 );\r\n","ini_set( 'error_log','".$new_debug_location."' );\r\n" );
    }
  	// Insert the constant in wp-config.php file.
  	foreach( $config_file as $new_line ) {
  		@fwrite( $handle, $new_line );
  	}
  	@fclose( $handle );
  }
  else{
    echo 'Change Debug Log Location was trying to update the file wp-config.php but it looks you have no access to the file';
    die();
    exit;
  }
}
