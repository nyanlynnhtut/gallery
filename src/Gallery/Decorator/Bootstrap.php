<?php

namespace Gallery\Decorator;

class Bootstrap extends AbstractBase
{
	/**
	 * Slider wrapper element's ID attribute
	 *
	 * @var string
	 **/
	protected $id = 'gallery-slider-bootstrap';

	/**
	 * Slider view file name
	 *
	 * @var string
	 **/
	protected $view = 'bootstrap';

	/**
	 * Options lists for bootstrap
	 *
	 * @var array
	 **/
	protected $bootstrap_options = array(
				'bs_use_indicator'	=> true,
				'bs_use_controls'	=> true,
				'bs_use_caption'	=> true,
				'bs_interval'		=> null,
				'bs_arrow_class'	=> array(
										'left' => 'glyphicon glyphicon-chevron-left',
										'right' => 'glyphicon glyphicon-chevron-right'
										)
			);

	/**
	 * Get class attribute value string for slider wrapper
	 *
	 * @return string
	 **/
	public function getClassString()
	{
		return is_null($this->classes) ? 'carousel' : 'carousel '.$this->classes;
	}

	/**
	 * Set pagination (indicator) show or not.
	 *
	 * @param boolean $value
	 * @return \Gallery\Decorator\Bootstrap
	 **/
	public function pagi($value = true)
	{
		$this->bootstrap_options['bs_use_indicator'] = (boolean) $value;

		return $this;
	}

	/**
	 * Set controls (prev, next) show or not.
	 *
	 * @param boolean $value
	 * @return \Gallery\Decorator\Bootstrap
	 **/
	public function control($value = true)
	{
		$this->bootstrap_options['bs_use_controls'] = (boolean) $value;

		return $this;
	}

	/**
	 * Set caption area show or not.
	 *
	 * @param boolean $value
	 * @return \Gallery\Decorator\Bootstrap
	 **/
	public function caption($value = true)
	{
		$this->bootstrap_options['bs_use_caption'] = (boolean) $value;

		return $this;
	}

	/**
	 * Set data-interval for slider.
	 *
	 * @param integer $value
	 * @return \Gallery\Decorator\Bootstrap
	 **/
	public function interval($value)
	{
		$this->bootstrap_options['bs_interval'] = (int) $value;

		return $this;
	}

	public function arrowClass($left, $right)
	{
		$arr = array('left' => $left, 'right' => $right);

		$this->bootstrap_options['bs_arrow_class'] = $arr;

		return $this;
	}

	/**
	 * Custom slider view rendering method.
	 *
	 * @param \Reborn\MVC\View\View $view
	 * @param string $file
	 * @return string
	 **/
	protected function customRender($instance, $file)
	{
		$instance->set($this->bootstrap_options);

		return $instance->render($file);
	}

}
