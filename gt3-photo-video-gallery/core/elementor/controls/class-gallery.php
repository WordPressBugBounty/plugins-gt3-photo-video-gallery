<?php

namespace GT3\PhotoVideoGallery\Elementor\Controls;

defined('ABSPATH') OR exit;

use Elementor\Base_Data_Control;

class Gallery extends Base_Data_Control {

	const TYPE = 'gt3pg-pro--gallery';

	public function get_type(){
		return self::TYPE;
	}

	public function get_default_value(){
		return '';
	}

	public function get_value($control, $widget){

		if(isset($widget[$control['name']]) && !empty($widget[$control['name']])) {
			$value = $widget[$control['name']];

			// Handle case when value is already an array
			if (is_array($value)) {
				$images = array();
				foreach($value as $image) {
					$images[] = is_array($image) && isset($image['id']) ? $image['id'] : $image;
				}
			} else {
				$images = json_decode($value, true);
				if(!json_last_error() && is_array($images)) {
					foreach($images as &$image) {
						$image = $image['id'];
					}
				} else {
					$images = explode(',', $value);
				}
			}
		} else {
			$images = array();
		}

		return $images;
	}

	public function content_template(){
		?>
		<div class="elementor-control-field">
			<div class="elementor-control-gt3-gallery elementor-control-type-gallery">
				<div class="control-gt3-gallery-title">{{ label }}</div>
			</div>
		</div>
		<?php
	}
}






