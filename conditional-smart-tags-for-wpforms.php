<?php
/**
* Plugin Name: Conditional If/Then/Else Smart Tags for WPForms
* Plugin URI: https://wordpress.org/plugins/conditional-smart-tags-for-wpforms
* Description: Adds a custom if-then-else smart tag syntax to conditionally show or hide content based on a field value in WPForms.
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 7.2
* Author: Maximum.Software
* Author URI: https://maximum.software
* Text Domain: conditional-smart-tags-for-wpforms
* License: GPL-2.0-or-later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly.
if( ! defined( 'ABSPATH' ) )
	exit;

class WPForms_Conditional_Smart_Tags
{
	/**
	* Constructor to hook into WPForms smart tag processing.
	*/
	public function __construct()
	{
		add_filter( 'wpforms_process_smart_tags', [ $this, 'process_if_else_smart_tags' ], 10, 4 );
	}

	/**
	* Callback to parse {if field_id="X" value="Y"} ... {else} ... {/if}.
	*
	* @param string $content   The content (notification, confirmation) containing smart tags.
	* @param array  $form_data Data about the current form.
	* @param array  $fields    Submitted fields data.
	* @param int    $entry_id  The current entry ID.
	*
	* @return string Processed content with if/else blocks replaced accordingly.
	*/
	public function process_if_else_smart_tags( $content, $form_data, $fields, $entry_id )
	{
		$max_iterations = 10; // Prevent infinite loops
		$iteration = 0;
		
		while(strpos($content, '{if') !== false && $iteration < $max_iterations)
		{
			$content = $this->process_innermost_if($content, $fields);
			$iteration++;
		}
		
		return $content;
	}

	/**
	 * Process the innermost if statement in the content.
	 * 
	 * @param string $content The content to process
	 * @param array $fields The form fields
	 * @return string Processed content
	 */
	private function process_innermost_if($content, $fields)
	{
		// Find the innermost {if} that doesn't contain another {if}
		$pattern = '/\{if\s+field_id="(\d+)"\s+value="([^"]*)"\}((?:(?!\{if).)*?)(?:\{else\}((?:(?!\{if).)*?))?\{\/if\}/s';
		
		return preg_replace_callback($pattern, function($matches) use ($fields) {
			$field_id = $matches[1];
			$required_value = $matches[2];
			$if_content = $matches[3];
			$else_content = isset($matches[4]) ? $matches[4] : '';

			// Get the submitted value, if present
			$submitted_value = '';
			if(isset($fields[$field_id]['value']))
				$submitted_value = trim($fields[$field_id]['value']);
			
			// Compare and return if_content or else_content
			return ($submitted_value === $required_value) ? $if_content : $else_content;
		}, $content);
	}
}

$wpfcst_instance = new WPForms_Conditional_Smart_Tags();
