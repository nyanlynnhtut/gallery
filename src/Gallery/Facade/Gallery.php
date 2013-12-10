<?php

namespace Gallery\Facade;

use Gallery\Decorator\SlideJs;
use Gallery\Decorator\GlideJs;
use Gallery\Presenter\GalleryPresenter;
use Gallery\Model\Gallery as GalleryModel;

/**
 * Gallery Facade Class
 *
 * @package Gallery
 * @author Nyan Lynn Htut
 **/
class Gallery
{

	/**
	 * Get all Live Gallery List.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 **/
	public static function all()
	{
		return GalleryPresenter::make(GalleryModel::live()->get(), true);
	}

	/**
	 * Get gallery by name
	 *
	 * @param string $name Gallery name
	 * @return \Gallery\Model\Gallery
	 **/
	public static function get($name)
	{
		return static::getGallery($name);
	}

	/**
	 * Get gallery files for given name
	 *
	 * @param string $name Gallery name
	 * @return \Gallery\Model\Gallery
	 **/
	public static function files($name)
	{
		$gallery = static::getGallery($name);

		if (is_null($gallery)) return null;

		return $gallery->files;
	}

	/**
	 * Get Gallery File Slider with SlideJS 3.
	 *
	 * Slide JS Site : http://www.slidesjs.com/
	 *
	 * @param string $gallery Gallery Name
	 * @param int $width Slider image width for slidejs
	 * @param int $height Slider image height for slidejs
	 * @return \Gallery\Decorator\SlideJs
	 **/
	public static function slidejs($gallery, $width = 940, $height = 0)
	{
		$galleries = static::getGallery($gallery);

		return new SlideJs($galleries, $width, $height);
	}

	/**
	 * Get Gallery File Slider with GlideJS.
	 *
	 * Slide JS Site : http://jedrzejchalubek.com/glide/
	 *
	 * @param string $gallery Gallery Name
	 * @param int $width Slider image width for slidejs
	 * @param int $height Slider image height for slidejs
	 * @return \Gallery\Decorator\GlideJs
	 **/
	public static function glidejs($gallery, $width = 940, $height = 0)
	{
		$galleries = static::getGallery($gallery);

		return new GlideJs($galleries, $width, $height);
	}

	/**
	 * Get Gallery Dat by Gallery "name"
	 *
	 * @param string $name
	 * @return \Gallery\Model\Gallery
	 **/
	protected static function getGallery($name)
	{
		$gallery = GalleryModel::live()->where('name', '=', $name)->first();

		if (is_null($gallery)) {
			return null;
		}

		return GalleryPresenter::make($gallery);
	}

} // END class Gallery
