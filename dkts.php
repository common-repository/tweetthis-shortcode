<?php
/**
Plugin Name: TweetThis Shortcode
Plugin URI: https://martech.zone/tweetthis-shortcode/
Description: Provides a shortcode to autopopulate a tweet, automatically shortens the link and attaches it to the tweet.
Version: 1.8.0
Author: Douglas Karr
Author URI: https://dknewmedia.com/
License: GPL2
Text Domain: tweetthis-shortcode

	Copyright 2015 Douglas Karr (email: info@dknewmedia.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

**/

add_action( 'admin_menu', 'dkts_add_admin_menu' );
add_action( 'admin_init', 'dkts_settings_init' );
add_action( 'wp_head', 'dkts_css' );
add_action( 'wp_enqueue_scripts', 'dkts_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'dkts_enqueue_scripts' );

// Add an Admin Menu option for Settings
function dkts_add_admin_menu(  ) { 
	add_options_page( 'TweetThis Shortcode', 'TweetThis Shortcode', 'manage_options', 'tweetthis_shortcode', 'tweetthis_shortcode_options_page' );
}

// Add the Savings Calculator settings to the Settings Page
function dkts_settings_init(  ) { 
	register_setting( 'pluginPage', 'dkts_settings' );

	add_settings_section(
		'dkts_pluginPage_section', 
		__( 'Settings Page', 'tweetthis-shortcode' ), 
		'dkts_settings_section_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'dkts_twitter', 
		__( 'Twitter Account', 'tweetthis-shortcode' ), 
		'dkts_twitter_render', 
		'pluginPage', 
		'dkts_pluginPage_section' 
	);

	add_settings_field( 
		'dkts_bitlylogin', 
		__( 'Bitly Login', 'tweetthis-shortcode' ), 
		'dkts_bitlylogin_render', 
		'pluginPage', 
		'dkts_pluginPage_section' 
	);
	
	add_settings_field( 
		'dkts_bitlyapikey', 
		__( 'Bitly API Key', 'tweetthis-shortcode' ), 
		'dkts_bitlyapikey_render', 
		'pluginPage', 
		'dkts_pluginPage_section' 
	);
	
}

// Set the Twitter Account field to render
function dkts_twitter_render() { 
	$dkts_options = get_option( 'dkts_settings' );
	?>
	<input type='text' name='dkts_settings[dkts_twitter]' value='<?php echo $dkts_options['dkts_twitter']; ?>'>
	<?php
}

// Set the Bit.ly Login input field to render
function dkts_bitlylogin_render() { 
	$dkts_options = get_option( 'dkts_settings' );
	?>
	<input type='text' name='dkts_settings[dkts_bitlylogin]' value='<?php echo $dkts_options['dkts_bitlylogin']; ?>'>
	<?php
}

// Set the Bit.ly API Key input field to render
function dkts_bitlyapikey_render() { 
	$dkts_options = get_option( 'dkts_settings' );
	?>
	<input type='text' name='dkts_settings[dkts_bitlyapikey]' value='<?php echo $dkts_options['dkts_bitlyapikey']; ?>'>
	<?php
}

// Set the Settings Section
function dkts_settings_section_callback() { 
	echo __( 'TweetThis Shortcode Settings Page', 'tweetthis-shortcode' );
}

// Build the Administrative form to save the default amount
function tweetthis_shortcode_options_page() { 
	$dkts_options = get_option( 'dkts_settings' );
	?>
	<form action='options.php' method='post'>
		
		<h2>TweetThis Shortcode</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>

	<?php if( strlen( $dkts_options["dkts_bitlylogin"] ) > 0 ) { ?>
	<h3>TweetThis Shortcode Bit.ly Results</h3>	
	<p>Click on your Bit.ly link to open up Bit.ly and see the statistics associated with the link.</p>
	<?php 
	// Get the latest posts with Bitly Links created
	$meta_query_args = array(
	'meta_query' => array(
		array(
			'key'     => 'dkts_bitlylink',
			'compare' => 'EXISTS',
		),
	),
	);
	$meta_query = new WP_Query( $meta_query_args );
	
	if ( $meta_query->have_posts() ) {
	
	echo '<ul style="margin-left: 20px; list-style-type: square;">';
	while ( $meta_query->have_posts() ) {
		$meta_query->the_post();
		$dkts_bitlylink =  get_post_meta( get_the_ID(), 'dkts_bitlylink', true );
		echo '<li><a href="'.get_the_permalink().'" title="View the Post" target="_blank"><i class="fa fa-link"></i></a> <a href="' . $dkts_bitlylink . '+" "View the Bit.ly Report" target="_blank"><i class="fa fa-bar-chart"></i></a>&nbsp;' . get_the_title() . '</li>';
	}
	echo '</ul>';
	} else {
		echo 'No posts found';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	?>
	<?php } ?>
	
	<h3>TweetThis Shortcode Instructions</h3>
	<p>Obtain your credentials from Bit.ly from your <a href="https://bitly.com/a/settings/advanced" target="_blank">Advanced Settings</a> page.</p>
	<p>Example with hashtags:</p>
	<ul style="margin-left: 20px">
		<li><strong>[tweetthis hashtag="wordpress"]</strong>Best plugin EVER!<strong>[/tweetthis]</strong></li>
		<li><?php echo do_shortcode( '[tweetthis hashtag="wordpress"]Best plugin EVER![/tweetthis]' ); ?></li>
	</ul>
	<p>Example without hashtags:</p>
	<ul style="margin-left: 20px">
		<li><strong>[tweetthis]</strong>Best plugin EVER!<strong>[/tweetthis]</strong></li>
		<li><?php echo do_shortcode( '[tweetthis]Best plugin EVER![/tweetthis]' ); ?></li>
	</ul>
	
	<p>Built by <a href="https://dknewmedia.com/" target="_blank">DK New Media</a>. Be sure to check out our publication, the <a href="https://martech.zone" target="_blank">MarTech</a> for the latest updates on WordPress and Marketing Technology!</p>
	<?php
}

/* returns the shortened url */
function dkts_get_bitly_short_url( $dkts_url, $dkts_format='txt') {
	$dkts_options = get_option( 'dkts_settings' );
	$dkts_apiurl = 'http://api.bit.ly/v3/shorten?login='.$dkts_options["dkts_bitlylogin"].'&apiKey='.$dkts_options["dkts_bitlyapikey"].'&uri='.urlencode( $dkts_url).'&format='.$dkts_format;
	$response = wp_remote_get( $dkts_apiurl);
	return $response['body'];
}

function dkts_tweetthis( $atts, $dkts_content = null ) {
	global $post; 
	$dkts_postid = $post->ID;
	$dkts_bitlylink =  get_post_meta( $dkts_postid, 'dkts_bitlylink', true );
	$dkts_permalink = get_permalink( $dkts_postid );
	$dkts_options = get_option( 'dkts_settings' );
	$dkts_length = 0;
	$dkts_hashtags = '';
	
	if( strlen($dkts_permalink) < 1) {
		$dkts_permalink = 'https://martech.zone/tweetthis-shortcode/';
	}
	
	if( strlen( $dkts_options["dkts_twitter"] ) >0 ) {
		$dkts_twitter = $dkts_options['dkts_twitter'];
	}

	$dkts_content = html_entity_decode ( $dkts_content );
	$dkts_htmlcontent = str_replace('#','',$dkts_content);
	$dkts_content = strip_tags( $dkts_content );	
	
	if( ( get_post_status ( $dkts_postid ) == 'publish' ) && ( strlen( $dkts_options["dkts_bitlylogin"] ) > 0 ) ) {
		if ( ! empty( $dkts_bitlylink ) ) {
			$dkts_surl = $dkts_bitlylink;
		} else {
			$dkts_surl = dkts_get_bitly_short_url( $dkts_permalink );
			update_post_meta( $dkts_postid , 'dkts_bitlylink', $dkts_surl );
		}
	} else {
		$dkts_surl = urlencode( $dkts_permalink );	
	}
	
	$dkts_urlcontent = substr( $dkts_content, 0, 280 );
	$dkts_urlcontent = rawurlencode( $dkts_urlcontent );
	
	if( is_array( $atts ) ) extract( $atts);
	
	if(strlen( $dkts_twitter)>0) {
		$dkts_twitter = '&via='.$dkts_twitter;
	}
	
	if(strlen( $hashtag)>0) {
		$hashtag = str_replace('#','',$hashtag);
		$hashtags = explode(' ',$hashtag);
		$dkts_hashtags = '';
		foreach( $hashtags as $tag) {    
    		$dkts_hashtags .= htmlentities(','.$tag); 
		}
		if(substr($dkts_hashtags,0,1)==",") {
			$dkts_hashtags = substr($dkts_hashtags,1,strlen($dkts_hashtags)-1);
		}
		$dkts_hashtags = '&hashtags='.$dkts_hashtags;
	}
	
	// Build the output
	$dkts_tweet = $dkts_htmlcontent;
	$dkts_tweet .= '&nbsp;<a href="https://twitter.com/intent/tweet?text='.$dkts_urlcontent;
	$dkts_tweet .= '&url='.$dkts_surl;
	$dkts_tweet .= $dkts_hashtags;
	$dkts_tweet .= $dkts_twitter;
	$dkts_tweet .= '" target="_blank"><i class="fa fa-twitter">&nbsp;</i>Tweet This!</a>';
	
	return $dkts_tweet;
}
add_shortcode('tweetthis', 'dkts_tweetthis');

function dkts_enqueue_scripts() {
       /* Add Stylesheet for Font Awesome. */
       wp_enqueue_style( 'dkts_stylesheet', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
}

function dkts_css() {
	$dkts_output = "<style type=\"text/css\">
			.tweetthis_btn {
  				background: #55acee;
  				background-image: linear-gradient(#fff,#f5f8fa);
  				-webkit-border-radius: 4;
  				-moz-border-radius: 4;
  				border-radius: 4px;
  				color: #ffffff;
  				padding: 8px 12px 8px 12px;
  				border: solid #3b88c3 1px;
  				text-decoration: none;
			}

			.tweetthis_btn:hover {
  				background: #3cb0fd;
  				background-image: linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0.05));
  				text-decoration: none;
			}
	</style>";
	echo $dkts_output;
}
?>