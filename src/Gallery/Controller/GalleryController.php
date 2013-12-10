<?php

namespace Gallery\Controller;

use Response;
use Event;
use MediaAPI;
use Gallery\Model\Gallery;
use Gallery\Presenter\GalleryPresenter;

class GalleryController extends \PublicController
{
	/**
	 * Gallery Album lists action
	 *
	 * @return void
	 */
	public function index()
	{
		$galleries = GalleryPresenter::make(Gallery::live()->get(), true);

		// Event for Gallery Index Page Stylesheet
		if (Event::has('gallery.index.style')) {
			$style = Event::first('gallery.index.style');

			if (is_null($style)) {
				$this->template->gallery_style = $style;
			} else {
				$this->template->style('gallery.css', 'gallery');
			}
		} else {
			$this->template->style('gallery.css', 'gallery');
		}

		$this->template->title('Gallery')
						->setPartial('index', compact('galleries'));
	}

	/**
	 * Gallery Album View
	 *
	 * @param string $slug
	 * @return void
	 */
	public function view($slug)
	{
		$gallery = GalleryPresenter::make(
						Gallery::live()->where('slug', $slug)->first()
					);

		if (is_null($gallery)) return Response::clueless();

		$this->template->gallery = $gallery;

		$script = $this->template->partialRender('script');

		$this->template->title('Gallery '.$gallery->name)
						->style('jquery-photowall.css', 'gallery')
						->script('jquery-photowall.js', 'gallery', 'footer')
						->inlineScript($script, 'footer')
						->setPartial('view');
	}
}
