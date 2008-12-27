<?php
/*
Plugin Name: Mini Mugshot
Plugin Author: Jeremy Visser
Author URI: http://jeremy.visser.name/
Plugin URI: http://wordpress.org/extend/plugins/mini-mugshot/
Version: 1.0
Description: Enables a Mini Mugshot widget that you can add to your sidebar. If you have the <a href="http://wordpress.org/extend/plugins/fauxml/">fauxML</a> plugin installed, you can also use the [mugshot <em>profile-url</em>] syntax within posts to display your Mini Mugshot.
*/

class mini_mugshot {

	function output($user, $type = 'mini') {

		$sizes = array(
			'mini' => array(
				'width' => 250,
				'height' => 74
			),
			'3' => array(
				'width' => 250,
				'height' => 180
			),
			'5' => array(
				'width' => 250,
				'height' => 255
			),
			'nowplaying' => array(
				'width' => 440,
				'height' => 120
			)
		);

		preg_match('/who=(.*)/', $user, $matches);

		$user = $matches[1];

		$urls = array(
			'mini'		=>	'http://mugshot.org/flash/userSummary.swf?who=' . $user . '&amp;baseUrl=http%3A%2F%2Fmugshot.org',
			'3'		=>	'http://mugshot.org/flash/userSummary.swf?who=' . $user . '&amp;baseUrl=http%3A%2F%2Fmugshot.org',
			'5'		=>	'http://mugshot.org/flash/userSummary.swf?who=' . $user . '&amp;baseUrl=http%3A%2F%2Fmugshot.org',
			'nowplaying'	=>	'http://mugshot.org/flash/nowPlaying.swf?who=' . $user . '&amp;baseUrl=http%3A%2F%2Fmugshot.org'
		);

		$markup = '<object type="application/x-shockwave-flash" data="' . $urls[$type] . '" width="' . $sizes[$type]['width'] . '" height="' . $sizes[$type]['height'] . '" class="mugshot">
			<param name="movie" value="' . $urls[$type] . '" />
			<param name="quality" value="best" />
			<param name="allowScriptAccess" value="always" />
			</object>';

		return $markup;

	}

	function sidebar_widget( $args ) {
		$options = get_option('mini_mugshot_widget');
		extract($args);

		echo $before_widget;
		echo $before_title . 'Mini Mugshot' . $after_title;
		echo mini_mugshot::output($options['mini-mugshot-widget-user'], $options['mini-mugshot-widget-style']);
		echo $after_widget;

	}

	function widget_options() {
		$options = $newoptions = get_option('mini_mugshot_widget');

		if ( $_POST['mini-mugshot-widget-style'] )
			$newoptions['mini-mugshot-widget-style'] = strip_tags(stripslashes($_POST['mini-mugshot-widget-style']));
		if ( $_POST['mini-mugshot-widget-user'] )
			$newoptions['mini-mugshot-widget-user'] = strip_tags(stripslashes($_POST['mini-mugshot-widget-user']));

		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('mini_mugshot_widget', $options);
		}

		$selected = 'selected="yes"';
		?>
		<p>	<label>
				Style:
				<select name="mini-mugshot-widget-style">
					<option value="mini"       <?php if ($options['mini-mugshot-widget-style'] == 'mini') echo $selected; ?>>Mini</option>
					<option value="3"          <?php if ($options['mini-mugshot-widget-style'] == '3') echo $selected; ?>>3-line</option>
					<option value="5"          <?php if ($options['mini-mugshot-widget-style'] == '5') echo $selected; ?>>5-line</option>
					<option value="nowplaying" <?php if ($options['mini-mugshot-widget-style'] == 'nowplaying') echo $selected; ?>>Now Playing</option>
				</select>
			</label>
		</p>

		<p>	<label>
				Profile Page URL:
				<input type="text" name="mini-mugshot-widget-user" value="<?php echo attribute_escape($options['mini-mugshot-widget-user']) ?>" />
			</label>
			<br />
			<em>e.g.</em> <small><code>http://mugshot.org/person?who=G3yH5GwMpAN1DW</code></small>
		</p>
		<?php
	}

	function tag_parser( $widget_data ) {
		$url = $widget_data[2];
		$type = $widget_data[1];

		if (empty($type))
			$type = 'mini';
		return mini_mugshot::output($url, $type);
	}

	function init() {
		if ( function_exists('wp_register_sidebar_widget') )
			wp_register_sidebar_widget( 'mini-mugshot', 'Mini Mugshot', array('mini_mugshot', 'sidebar_widget') );
		if ( function_exists('wp_register_widget_control') )
			wp_register_widget_control( 'mini-mugshot', 'Mini Mugshot', array('mini_mugshot', 'widget_options') );

		if ( function_exists('wp_add_faux_ml') )
			wp_add_faux_ml( '!\[mugshot-?(mini|3|5|nowplaying|)[ =](.*?)\]!i', array('mini_mugshot', 'tag_parser') );
	}

}

add_action('plugins_loaded', array('mini_mugshot', 'init'));
 
?>
