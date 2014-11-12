<?php

namespace Gallery\Decorator;

/**
 * Flux Slider Decorator
 * Flux Slider Url : http://www.joelambert.co.uk/flux/
 *
 * @package Gallery Module
 * @author Nyan Lynn Htut
 **/

class Flux extends AbstractBase
{
	/**
	 * Slider wrapper element's ID attribute
	 *
	 * @var string
	 **/
	protected $id = 'gallery-slider-flux';

	/**
	 * Slider view file name
	 *
	 * @var string
	 **/
	protected $view = 'flux';

	/**
	 * Slider options data lists
	 *
	 * @var array
	 **/
	protected $options = array(
			'autoplay' => true, 
			'pagination' => false, 
			'controls' => false,
			'captions' => false,
			'delay' => 4000
		);

	/**
	 * Get class attribute value string for slider wrapper
	 *
	 * @return string
	 **/
	public function getClassString()
	{
		return is_null($this->classes) ? 'flux-slider' : 'flux-slider '.$this->classes;
	}

	/**
	 * Set Flux slider autoplay option.
	 * Default value is true
	 * @param boolean $play
	 * @return  \Gallery\Decorator\Flux
	 */
	public function autoplay($play = true)
	{
		$this->options['autoplay'] = (boolean) $play;

		return $this;
	}

	/**
	 * Set Flux slider pagination option.
	 * Default option value is false
	 * @param boolean $show Default is true
	 * @return  \Gallery\Decorator\Flux
	 */
	public function pagi($show = true)
	{
		$this->options['pagination'] = (boolean) $show;

		return $this;
	}

	/**
	 * Set Flux slider previous next control option.
	 * Default option value is false
	 * @param boolean $show Default is true
	 * @return  \Gallery\Decorator\Flux
	 */
	public function controls($show = true)
	{
		$this->options['controls'] = (boolean) $show;

		return $this;
	}

	/**
	 * Set Flux slider captions option.
	 * Caption text will be use Gallery image label attribute.
	 * Default option value is false
	 * @param boolean $show Default is true
	 * @return  \Gallery\Decorator\Flux
	 */
	public function captions($show = true)
	{
		$this->options['captions'] = (boolean) $show;

		return $this;
	}

	/**
	 * Set Flux slider delay option.
	 * Delay is the number of milliseconds to wait between image transitions.
	 * Default option value is 4000
	 * @param boolean $delay
	 * @return  \Gallery\Decorator\Flux
	 */
	public function delay($delay)
	{
		$delay = (int) $delay;

		if ($delay >= 2000) {
			$this->options['delay'] = $delay;
		}

		return $this;
	}

	/**
	 * Set Flux slider transation option.
	 * See detail at https://github.com/joelambert/Flux-Slider
	 * Supported transitions :
	 *  - bars (2D transation)
	 *  - blinds (2D transation)
	 *  - blocks (2D transation)
	 *  - blocks2 (2D transation)
	 *  - concentric (2D transation)
	 *  - dissolve (2D transation)
	 *  - slide (2D transation)
	 *  - warp (2D transation)
	 *  - zip (2D transation)
	 *  - bars3d (3D transation)
	 *  - blinds3d (3D transation)
	 *  - cube (3D transation)
	 *  - tiles3d (3D transation)
	 *  - turn (3D transation)
	 * 
	 * @param array $transitions
	 * @return  \Gallery\Decorator\Flux
	 */
	public function transitions(array $transitions)
	{
		if ( ! empty($transitions)) {
			$this->options['transitions'] = $transitions;
		}

		return $this;
	}
}