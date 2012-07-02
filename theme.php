<?php

define('DEBUG_THEME', true);

class HeavyTheme extends WaziTheme
{
	/**
	 * Add the headline block template
	 */
	public function action_init()
	{
		$this->add_template('block.headlines', dirname( __FILE__ ) . '/block.headlines.php' );
	}

	/**
	 * Shiv IE, add the stylesheet
	 * @param Theme $theme
	 */
	function action_template_header($theme) {
		// Add the HTML5 shiv for IE < 9
		Stack::add('template_header_javascript', array('http://cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.js', null, '<!--[if lt IE 9]>%s<![endif]-->'), 'html5_shiv');

		// Add this line to your config.php to show an error and a notice, and
		// to process the raw LESS code via javascript instead of the rendered CSS:  define('DEBUG_THEME', 1);
		if(defined('DEBUG_THEME')) {
//			Session::error('This is a <b>sample error</b>');
//			Session::notice('This is a <b>sample notice</b> for ' . $_SERVER['REQUEST_URI']);

			Stack::add('template_header_javascript', $theme->get_url('/less/less-1.3.0.min.js'), 'less');
			Stack::add('template_stylesheet', array($theme->get_url('/less/style.less'), null, array('type'=> null, 'rel' => 'stylesheet/less')), 'style');
		}
		else {
			Stack::add('template_stylesheet', $theme->get_url('/css/style.css'), 'style');
		}
	}

	/**
	 * Add the Headlines block type to the list
	 * @param array $block_list
	 * @return array
	 */
	public function filter_block_list($block_list)
	{
		$block_list['headlines'] = _t( 'Headlines');
		return $block_list;
	}

	/**
	 * Add posts from the "headlines" preset to the headlines block
	 * @param Block $block
	 * @param Theme $theme
	 */
	public function action_block_content_headlines($block, $theme)
	{
		$block->posts = Posts::get('headlines');
	}

	/**
	 * Add the "headlines" preset to the list of presets
	 * @param array $presets
	 * @return array
	 */
	public function filter_posts_get_all_presets($presets)
	{
		$presets['headlines'] = array( 'content_type' => 'entry', 'status' => 'published', 'tags:term' => 'headline' );
		return $presets;
	}

	/**
	 * Add the Key Image field to the post publication form, and allow it to be set from silos
	 * @param FormUI $form
	 * @param Post $post
	 */
	public function action_form_publish_entry($form, $post)
	{
		$form->insert('publish_controls', new FormControlText('keyimage', $post, 'Key Image', 'admincontrol_text'));

		$imageinsert = $form->insert('content', 'static', 'imageinsert', '');
		$imageinsert->caption = <<< CAPTION_SCRIPT
<script type="text/javascript">
function add_photo_to_set(fileindex, fileobj) {
	$('#keyimage').val(fileobj.url);
}
$(function(){
	$.extend(habari.media.output.image_jpeg, {
		set_key_image: add_photo_to_set
	});
	$.extend(habari.media.output.image_png, {
		set_key_image: add_photo_to_set
	});
	$.extend(habari.media.output.image_gif, {
		set_key_image: add_photo_to_set
	});
	$.extend(habari.media.output.flickr, {
		set_key_image: add_photo_to_set
	});
});
</script>
CAPTION_SCRIPT;

	}
}

?>