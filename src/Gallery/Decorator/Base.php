<?php

namespace Gallery\Decorator;

use Reborn\Cores\Facade;
use Gallery\Presenter\GalleryPresenter;

class Base
{
	/**
	 * Application (IOC) container instance
	 *
	 * @var \Reborn\Cores\Application
	 **/
	protected $app;

	/**
	 * GalleryPresenter instance for photo resource
	 *
	 * @var \Gallery\Presenter\GalleryPresenter
	 **/
	protected $gallery;

	/**
	 * Slider options data lists
	 *
	 * @var array
	 **/
	protected $options = array();

	/**
	 * Slider wrapper element's ID attribute
	 *
	 * @var string
	 **/
	protected $id = 'gallery-slider-wrapper';

	/**
	 * Slider view file name
	 *
	 * @var string
	 **/
	protected $view;

	/**
	 * Slider width
	 *
	 * @var integer
	 **/
	protected $width;

	/**
	 * Slider height
	 *
	 * @var integer
	 **/
	protected $height;

	/**
	 * Create default instance
	 *
	 * @param \Gallery\Presenter\GalleryPresenter $gallery
	 * @param integer $width
	 * @param integer $height
	 * @return void
	 */
	public function __construct(GalleryPresenter $gallery, $width = 940, $height = 0)
	{
		$this->gallery = $gallery;

		$this->app = Facade::getApplication();

		$this->width = $width;
		$this->height = $height;
	}

	/**
	 * Set slider options.
	 *
	 * @param string|array $key
	 * @param mixed $value
	 * @return \Gallery\Decorator\Base
	 **/
	public function options($key, $value = null)
	{
		if (is_array($key)) {
			foreach ($key as $name => $value) {
				$this->options[$name] = $value;
			}
		} else {
			$this->options[$key] = $value;
		}

		return $this;
	}

	/**
	 * Render slider view
	 *
	 * @return string
	 */
	public function render()
	{
		if (is_null($this->gallery)) return null;

		$options = $this->getSliderOptions();

		$view = $this->app->view;

		$view->set(array(
			'_width' => $this->width,
			'_height' => $this->height,
			'_options' => $options,
			'galleries' => $this->gallery,
			'files' => $this->gallery->files
		));

		$view->set('_id', $this->id);

		$file = GALLERY_VIEW.'slider'.DS.$this->view.'.html';

		return $view->render($file);
	}

	/**
	 * Dynamic render with PHP's magic method
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}

	/**
	 * Get Slider Options string
	 *
	 * @return string
	 **/
	protected function getSliderOptions()
	{
		$options = '';

		foreach ($this->options as $key => $value) {
			$options .= ','.$key.': '.$this->getOptionValue($value);
		}

		return ltrim($options,',');
	}

	/**
	 * Get option vlaue.
	 *
	 * @param mixed $value
	 * @return string
	 **/
	protected function getOptionValue($value)
	{
		if (is_numeric($value)) {
			return $value;
		} elseif (is_bool($value)) {
			return $this->getBooleanValue($value);
		} elseif (is_array($value)) {
			return $this->getArrayValue($value);
		}

		return '"'.$value.'"';
	}

	/**
	 * Get boolean type value
	 *
	 * @param string $value
	 * @return string
	 **/
	protected function getBooleanValue($value)
	{
		if (1 == $value) {
			return 'true';
		}

		return 'false';
	}

	/**
	 * Get boolean type value
	 *
	 * @param string $value
	 * @return string
	 **/
	protected function getArrayValue($value)
	{
		$val = '';

		foreach ($value as $k => $v) {
			$val .= ','.$k.': '.$this->getOptionValue($v);
		}

		return '{'.ltrim($val, ',').'}';
	}
}
