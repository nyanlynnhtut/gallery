<?php

namespace Gallery\Decorator;

class GlideJs extends Base
{
	/**
	 * Slider wrapper element's ID attribute
	 *
	 * @var string
	 **/
	protected $id = 'gallery-slider-glidejs';

	/**
	 * Slider view file name
	 *
	 * @var string
	 **/
	protected $view = 'glidejs';

	/**
	 * Slider options data lists
	 *
	 * @var array
	 **/
	protected $options = array('autoplay' => 4000);

	/**
	 * Set GlideJs nav options attribute.
	 * See detail at https://github.com/jedrzejchalubek/Glide.js
	 *
	 * @param integer $speed
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public function nav($show = true, $center = true) {

		$this->options['nav'] = (bool) $show;
		$this->options['navCenter'] =  (bool) $center;

		return $this;
	}

	/**
	 * Set GlideJs arrows options attribute.
	 * See detail at https://github.com/jedrzejchalubek/Glide.js
	 *
	 * @param boolean $show
	 * @param string $left Left arrow text
	 * @param string $right Right arrow text
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public function arrows($show = true, $left = 'Prev', $right = 'Next')
	{
		$this->options['arrows'] = (bool) $show;

		if ((bool) $show) {
			$this->options['arrowLeftText'] =  $left;
			$this->options['arrowRightText'] =  $right;
		}

		return $this;
	}
}
