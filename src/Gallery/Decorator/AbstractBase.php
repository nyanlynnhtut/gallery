<?php

namespace Gallery\Decorator;

use Reborn\Cores\Facade;
use Gallery\Presenter\GalleryPresenter;

abstract class AbstractBase
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
	 * Class attribute for slider wrapper element.
	 *
	 * @var string
	 **/
	protected $classes;

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
	 * Set slider wrapper's ID attribute.
	 *
	 * @param string
	 * @return \Gallery\Decorator\Base
	 **/
	public function id($id)
	{
		$this->id = (string) $id;

		return $this;
	}

	/**
	 * Set slider wrapper's class attribute.
	 *
	 * @param string
	 * @return \Gallery\Decorator\Base
	 **/
	public function classes($classes)
	{
		$this->classes = (string) $classes;

		return $this;
	}

	/**
	 * Render slider view
	 *
	 * @param string $id
	 * @return string
	 */
	public function render()
	{
		if (is_null($this->gallery)) return null;

		$options = array_merge(array('width' => $this->width), $this->options);

		if ($this->height > 0) {
			$options['height'] = $this->height;
		}

		$options = \ToolKit::jsEncode($options);

		$view_instance = $this->app->view;

		$view_instance->set(array(
			'_width' => $this->width,
			'_height' => $this->height,
			'_options' => $options,
			'galleries' => $this->gallery,
			'files' => $this->gallery->files
		));

		$view_instance->set('_id', $this->id);

		$view_instance->set('_class', $this->getClassString());

		$file = GALLERY_VIEW.'slider'.DS.$this->view.'.html';

		// Check for custom rendering method.
		if (method_exists($this, 'customRender')) {
			return $this->customRender($view_instance, $file);
		}

		return $view_instance->render($file);
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
}
