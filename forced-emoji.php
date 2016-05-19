<?php
/**
 * Plugin Name: forced-emoji
 * Plugin URI:  http://brad.party
 * Description: randomly forces emoji into your content where it can
 * Version:     0.1.0
 * Author:      bradparbs
 * Author URI:  http://brad.party
 * Donate link: http://brad.party
 * License:     GPLv2
 * Text Domain: forced-emoji
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2016 bradparbs (email : brad@bradparbs.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp
 */


/**
 * Autoloads files with classes when needed
 *
 * @since  0.1.0
 * @param  string $class_name Name of the class being requested
 * @return void
 */
function forced_emoji_autoload_classes( $class_name ) {
	if ( 0 !== strpos( $class_name, 'F-_' ) ) {
		return;
	}

	$filename = strtolower( str_replace(
		'_', '-',
		substr( $class_name, strlen( 'F-_' ) )
	) );

	Forced-emoji::include_file( $filename );
}
spl_autoload_register( 'forced_emoji_autoload_classes' );


/**
 * Main initiation class
 *
 * @since  0.1.0
 * @var  string $version  Plugin version
 * @var  string $basename Plugin basename
 * @var  string $url      Plugin URL
 * @var  string $path     Plugin Path
 */
class ForcedEmoji {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  0.1.0
	 */
	const VERSION = '0.1.0';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $basename = '';

	/**
	 * Singleton instance of plugin
	 *
	 * @var Forced-emoji
	 * @since  0.1.0
	 */
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  0.1.0
	 * @return Forced-emoji A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  0.1.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );

		$this->plugin_classes();
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		// $this->plugin_class = new F-_Plugin_Class( $this );
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function hooks() {
		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );

		add_action( 'init', array( $this, 'init' ) );
	}
	/**
	 * Init hooks
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function init() {
		load_plugin_textdomain( 'forced-emoji', false, dirname( $this->basename ) . '/languages/' );

		global $wp_filter;

		// Make sure we have some filters first
		if ( ! is_array( $wp_filter ) ) {
			return;
		}

		// Loop through all our filters
		foreach ( $wp_filter as $key => $value ) {
			if ( 'template_include' != $key ) {
				add_filter( $key, array( $this, 'filter' ), 99999999 );
			}
		}
	}

	public function filter( $value ) {
		if (
			is_string( $value ) &&
			( false === filter_var( $value, FILTER_VALIDATE_URL ) )
		) {
			$position_to_replace = rand( 0, strlen( $value ) );
			$value = substr_replace( $value, $this->get_random_emoji(), $position_to_replace, 1 );
		}

		return $value;
	}

	/**
	 * Gets a random emoji
	 * @return string an emoji
	 */
	public function get_random_emoji() {
		$emojis = array(
			'😀',
			'😬',
			'😁',
			'😂',
			'😃',
			'😄',
			'😅',
			'😆',
			'😇',
			'😉',
			'😊',
			'😋',
			'😌',
			'😍',
			'😘',
			'😗',
			'😙',
			'😚',
			'😜',
			'😝',
			'😛',
			'😎',
			'😏',
			'😶',
			'😐',
			'😑',
			'😒',
			'😳',
			'😞',
			'😟',
			'😠',
			'😡',
			'😔',
			'😕',
			'😣',
			'😖',
			'😫',
			'😩',
			'😤',
			'😮',
			'😱',
			'😨',
			'😰',
			'😯',
			'😦',
			'😧',
			'😢',
			'😥',
			'😪',
			'😓',
			'😭',
			'😵',
			'😲',
			'😷',
			'😴',
			'💤',
			'💩',
			'😈',
			'👿',
			'👹',
			'👺',
			'💀',
			'👻',
			'👽',
			'😺',
			'😸',
			'😹',
			'😻',
			'😼',
			'😽',
			'🙀',
			'😿',
			'😾',
			'🙌',
			'👏',
			'👋',
			'👍',
			'👊',
			'✊',
			'✌️',
			'👌',
			'✋',
			'💪',
			'🙏',
			'☝️',
			'👆',
			'👇',
			'👈',
			'👉',
			'🖖',
			'✍️',
			'💅',
			'👄',
			'👅',
			'👂',
			'👃',
			'👀',
			'👤',
			'👶',
			'👦',
			'👧',
			'👨',
			'👩',
			'👱',
			'👴',
			'👵',
			'👲',
			'👳',
			'👮',
			'👷',
			'💂',
			'🎅',
			'👼',
			'👸',
			'👰',
			'🚶',
			'🏃',
			'💃',
			'👯',
			'👫',
			'👬',
			'👭',
			'🙇',
			'💁',
			'🙅',
			'🙆',
			'🙋',
			'🙎',
			'🙍',
			'💇',
			'💆',
			'💑',
			'👩‍',
			'👨‍',
			'💏',
			'👪',
			'👚',
			'👕',
			'👖',
			'👔',
			'👗',
			'👙',
			'👘',
			'💄',
			'💋',
			'👣',
			'👠',
			'👡',
			'👢',
			'👞',
			'👟',
			'👒',
			'🎩',
			'🎓',
			'👑',
			'🎒',
			'👝',
			'👛',
			'👜',
			'💼',
			'👓',
			'💍',
			'🌂',
			'🐶',
			'🐱',
			'🐭',
			'🐹',
			'🐰',
			'🐻',
			'🐼',
			'🐨',
			'🐯',
			'🐮',
			'🐷',
			'🐽',
			'🐸',
			'🐙',
			'🐵',
			'🙈',
			'🙉',
			'🙊',
			'🐒',
			'🐔',
			'🐧',
			'🐦',
			'🐤',
			'🐣',
			'🐥',
			'🐺',
			'🐗',
			'🐴',
			'🐝',
			'🐛',
			'🐌',
			'🐞',
			'🐜',
			'🐍',
			'🐢',
			'🐠',
			'🐟',
			'🐡',
			'🐬',
			'🐳',
			'🐋',
			'🐊',
			'🐆',
			'🐅',
			'🐃',
			'🐂',
			'🐄',
			'🐪',
			'🐫',
			'🐘',
			'🐐',
			'🐏',
			'🐑',
			'🐎',
			'🐖',
			'🐀',
			'🐁',
			'🐓',
			'🐕',
			'🐩',
			'🐈',
			'🐇',
			'🐾',
			'🐉',
			'🐲',
			'🌵',
			'🎄',
			'🌲',
			'🌳',
			'🌴',
			'🌱',
			'🌿',
			'☘',
			'🍀',
			'🎍',
			'🎋',
			'🍃',
			'🍂',
			'🍁',
			'🌾',
			'🌺',
			'🌻',
			'🌹',
			'🌷',
			'🌼',
			'🌸',
			'💐',
			'🍄',
			'🌰',
			'🎃',
			'🐚',
			'🌎',
			'🌍',
			'🌏',
			'🌕',
			'🌖',
			'🌗',
			'🌘',
			'🌑',
			'🌒',
			'🌓',
			'🌔',
			'🌚',
			'🌝',
			'🌛',
			'🌜',
			'🌞',
			'🌙',
			'⭐️',
			'🌟',
			'💫',
			'✨',
			'☄',
			'☀️',
			'⛅️',
			'☁️',
			'⚡️',
			'🔥',
			'💥',
			'❄️',
			'🔥',
			'💥',
			'❄️',
			'☃️',
			'⛄️',
			'💨',
			'☂️',
			'☔️',
			'💧',
			'💦',
			'🌊',
			'🍏',
			'🍎',
			'🍐',
			'🍊',
			'🍋',
			'🍌',
			'🍉',
			'🍇',
			'🍓',
			'🍈',
			'🍒',
			'🍑',
			'🍍',
			'🍅',
			'🍆',
			'🌽',
			'🍠',
			'🍯',
			'🍞',
			'🍗',
			'🍖',
			'🍤',
			'🍳',
			'🍔',
			'🍟',
			'🍕',
			'🍝',
			'🍜',
			'🍲',
			'🍥',
			'🍣',
			'🍱',
			'🍛',
			'🍙',
			'🍚',
			'🍘',
			'🍢',
			'🍡',
			'🍧',
			'🍨',
			'🍦',
			'🍰',
			'🎂',
			'🍮',
			'🍬',
			'🍭',
			'🍫',
			'🍩',
			'🍪',
			'🍺',
			'🍻',
			'🍷',
			'🍸',
			'🍹',
			'🍶',
			'🍵',
			'☕️',
			'🍼',
			'🍴',
			'⚽️',
			'🏀',
			'🏈',
			'⚾️',
			'🎾',
			'🏉',
			'🎱',
			'⛳️',
			'🎿',
			'🏂',
			'🎣',
			'🚣',
			'🏊',
			'🏄',
			'🛀',
			'🚴',
			'🚵',
			'🏇',
			'🏆',
			'🎽',
			'🎫',
			'🎭',
			'🎨',
			'🎪',
			'🎤',
			'🎧',
			'🎼',
			'🎹',
			'🎷',
			'🎺',
			'🎸',
			'🎻',
			'🎬',
			'🎮',
			'👾',
			'🎯',
			'🎲',
			'🎰',
			'🎳',
			'🚗',
			'🚕',
			'🚙',
			'🚌',
			'🚎',
			'🚓',
			'🚑',
			'🚒',
			'🚐',
			'🚚',
			'🚛',
			'🚜',
			'🚲',
			'🚨',
			'🚔',
			'🚍',
			'🚘',
			'🚖',
			'🚡',
			'🚠',
			'🚟',
			'🚃',
			'🚋',
			'🚝',
			'🚄',
			'🚅',
			'🚈',
			'🚞',
			'🚂',
			'🚆',
			'🚇',
			'🚊',
			'🚉',
			'🚁',
			'✈️',
			'⛵️',
			'🚤',
			'🚀',
			'💺',
			'⚓️',
			'🚧',
			'⛽️',
			'🚏',
			'🚦',
			'🚥',
			'🏁',
			'🚢',
			'🎡',
			'🎢',
			'🎠',
			'🌁',
			'🗼',
			'🏭',
			'⛲️',
			'🎑',
			'🗻',
			'🌋',
			'🗾',
			'⛺️',
			'🌅',
			'🌄',
			'🌇',
			'🌆',
			'🌃',
			'🌉',
			'🌌',
			'🌠',
			'🎇',
			'🎆',
			'🌈',
			'🏰',
			'🏯',
			'🗽',
			'🏠',
			'🏡',
			'🏢',
			'🏬',
			'🏣',
			'🏤',
			'🏥',
			'🏦',
			'🏨',
			'🏪',
			'🏫',
			'🏩',
			'💒',
			'⛪️',
			'⌚️',
			'📱',
			'📲',
			'💻',
			'⌨',
			'💽',
			'💾',
			'💿',
			'📀',
			'📼',
			'📷',
			'📹',
			'🎥',
			'📞',
			'☎️',
			'📟',
			'📠',
			'📺',
			'📻',
			'⏰',
			'⏳',
			'⌛️',
			'📡',
			'🔋',
			'🔌',
			'💡',
			'🔦',
			'💸',
			'💵',
			'💴',
			'💶',
			'💷',
			'💰',
			'💳',
			'💎',
			'⚖',
			'🔧',
			'🔨',
			'⚒',
			'🔩',
			'⚙',
			'🔫',
			'💣',
			'🔪',
			'⚔',
			'🚬',
			'☠',
			'⚰',
			'⚱',
			'🔮',
			'💈',
			'⚗',
			'🔭',
			'🔬',
			'💊',
			'💉',
			'🔖',
			'🚽',
			'🚿',
			'🛁',
			'🔑',
			'🚪',
			'🗿',
			'🎈',
			'🎏',
			'🎀',
			'🎁',
			'🎊',
			'🎉',
			'🎎',
			'🎐',
			'🎌',
			'🏮',
			'✉️',
			'📩',
			'📨',
			'📧',
			'💌',
			'📮',
			'📪',
			'📫',
			'📬',
			'📭',
			'📦',
			'📯',
			'📥',
			'📤',
			'📜',
			'📃',
			'📑',
			'📊',
			'📈',
			'📉',
			'📄',
			'📅',
			'📆',
			'📇',
			'📋',
			'📁',
			'📂',
			'📰',
			'📓',
			'📕',
			'📗',
			'📘',
			'📙',
			'📔',
			'📒',
			'📚',
			'📖',
			'🔗',
			'📎',
			'✂️',
			'📐',
			'📏',
			'📌',
			'📍',
			'🚩',
			'🔐',
			'🔒',
			'🔓',
			'🔏',
			'✒️',
			'📝',
			'🔍',
			'🔎',
			'❤️',
			'💛',
			'💙',
			'💜',
			'💔',
			'❣️',
			'💕',
			'💞',
			'💓',
			'💗',
			'💖',
			'💘',
			'💝',
			'💟',
			'☮',
			'✝️',
			'☪',
			'☸',
			'✡️',
			'🔯',
			'☯️',
			'☦',
			'⛎',
			'♈️',
			'♉️',
			'♊️',
			'♋️',
			'♌️',
			'♍️',
			'♎️',
			'♏️',
			'♐️',
			'♑️',
			'♒️',
			'♓️',
			'🆔',
			'⚛',
			'🈳',
			'🈹',
			'☢',
			'☣',
			'📴',
			'📳',
			'🈶',
			'🈚️',
			'🈸',
			'🈺',
			'🈷️',
			'✴️',
			'🆚',
			'🉑',
			'💮',
			'🉐',
			'㊙️',
			'㊗️',
			'🈴',
			'🈵',
			'🈲',
			'🅰️',
			'🅱️',
			'🆎',
			'🆑',
			'🅾️',
			'🆘',
			'⛔️',
			'📛',
			'🚫',
			'❌',
			'⭕️',
			'💢',
			'♨️',
			'🚷',
			'🚯',
			'🚳',
			'🚱',
			'🔞',
			'📵',
			'❗️',
			'❕',
			'❓',
			'❔',
			'‼️',
			'⁉️',
			'💯',
			'🔅',
			'🔆',
			'🔱',
			'⚜',
			'〽️',
			'⚠️',
			'🚸',
			'🔰',
			'♻️',
			'🈯️',
			'💹',
			'❎',
			'✅',
			'💠',
			'🌀',
			'➿',
			'🌐',
			'Ⓜ️',
			'🏧',
			'🛂',
			'🛃',
			'🛄',
			'🛅',
			'♿️',
			'🚭',
			'🚾',
			'🅿️',
			'🚰',
			'🚹',
			'🚺',
			'🚼',
			'🚻',
			'🚮',
			'🎦',
			'📶',
			'🈁',
			'🆖',
			'🆗',
			'🆙',
			'🆒',
			'🆕',
			'🆓',
			'🔟',
			'🔢',
			'▶️',
			'⏩',
			'⏪',
			'🔀',
			'🔁',
			'🔂',
			'◀️',
			'🔼',
			'🔽',
			'⏫',
			'⏬',
			'➡️',
			'⬅️',
			'⬆️',
			'⬇️',
			'↗️',
			'↘️',
			'↙️',
			'↖️',
			'↕️',
			'↔️',
			'🔄',
			'↪️',
			'↩️',
			'⤴️',
			'⤵️',
			'ℹ️',
			'🔤',
			'🔡',
			'🔠',
			'🔣',
			'🎵',
			'🎶',
			'➰',
			'🔃',
			'➕',
			'➖',
			'➗',
			'💲',
			'💱',
			'©️',
			'®️',
			'™️',
			'🔚',
			'🔙',
			'🔛',
			'🔝',
			'🔜',
			'☑️',
			'🔘',
			'⚪️',
			'⚫️',
			'🔴',
			'🔵',
			'🔸',
			'🔹',
			'🔶',
			'🔷',
			'🔺',
			'⬛️',
			'⬜️',
			'🔻',
			'◼️',
			'◾️',
			'◽️',
			'🔲',
			'🔳',
			'🔈',
			'🔉',
			'🔊',
			'🔇',
			'📣',
			'📢',
			'🔔',
			'🔕',
			'🃏',
			'🀄️',
			'🎴',
			'💭',
			'💬',
			'🕐',
			'🕑',
			'🕒',
			'🕓',
			'🕔',
			'🕕',
			'🕖',
			'🕗',
			'🕘',
			'🕙',
			'🕚',
			'🕛',
			'🕜',
			'🕝',
			'🕞',
			'🕟',
			'🕠',
			'🕡',
			'🕢',
			'🕣',
			'🕤',
			'🕥',
			'🕦',
			'🕧',
		);
		return wp_encode_emoji( $emojis[ array_rand( $emojis ) ] );
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  0.1.0
	 * @param string $field
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}

}

/**
 * Grab the Forced-emoji object and return it.
 * Wrapper for Forced-emoji::get_instance()
 *
 * @since  0.1.0
 * @return Forced-emoji  Singleton instance of plugin class.
 */
function forced_emoji() {
	return ForcedEmoji::get_instance();
}

// Kick it off
add_action( 'plugins_loaded', array( forced_emoji(), 'hooks' ) );
