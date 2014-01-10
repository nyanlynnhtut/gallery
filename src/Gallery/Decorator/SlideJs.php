<?php

namespace Gallery\Decorator;

class SlideJs extends AbstractBase
{
	/**
	 * Slider wrapper element's ID attribute
	 *
	 * @var string
	 **/
	protected $id = 'gallery-slider-slidejs';

	/**
	 * Slider view file name
	 *
	 * @var string
	 **/
	protected $view = 'slidejs';

	/**
	 * Set SlideJs fade effect options attribute.
	 * See detail at http://www.slidesjs.com/
	 *
	 * @param integer $speed
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public function fade($speed = 900) {
		$speed = ((int) $speed < 200 ) ? 300 : $speed;

		$this->options['effect'] = array(
			'fade' => array(
				'speed' => $speed
			)
		);

		$value = array('effect' => 'fade');

		$this->options['navigation'] = $this->mergeOption('navigation', $value);
		$this->options['pagination'] =  $this->mergeOption('pagination', $value);

		return $this;
	}

	/**
	 * Set SlideJs slide effect options attribute.
	 * See detail at http://www.slidesjs.com/
	 *
	 * @param integer $speed
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public function slide($speed = 600)
	{
		$this->options['effect'] = array(
			'slide' => array(
				'speed' => $speed
			)
		);

		$value = array('effect' => 'slide');

		$this->options['navigation'] = $this->mergeOption('navigation', $value);
		$this->options['pagination'] =  $this->mergeOption('pagination', $value);

		return $this;
	}

	/**
	 * Set SlideJs play options attribute.
	 * See detail at http://www.slidesjs.com/
	 *
	 * @param boolean $auto
	 * @param integer $interval
	 * @param boolean $pauseOnHover
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public function play($auto = true, $interval = 5000, $pauseOnHover = false)
	{
		$value = array(
			'interval'		=> $interval,
			'auto'			=> $auto,
			'pauseOnHover'	=> $pauseOnHover
		);

		$this->options['play'] =  $this->mergeOption('play', $value);

		return $this;
	}

	/**
	 * Get class attribute value string for slider wrapper
	 *
	 * @return string
	 **/
	public function getClassString()
	{
		return is_null($this->classes) ? 'slidejs' : 'slidejs '.$this->classes;
	}

	/**
	 * Merge Slidejs options
	 *
	 * @param string $key
	 * @param array $value
	 * @return array
	 **/
	protected function mergeOption($key, $value)
	{
		if (isset($this->options[$key])) {
			return array_merge_recursive($this->options[$key], $value);
		}

		return $value;
	}
}
