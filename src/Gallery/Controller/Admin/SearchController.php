<?php

namespace Gallery\Controller\Admin;

class SearchController extends \AdminController
{
	protected $api;

	public function __construct(\Media\Api $api)
	{
		$this->api = $api;
	}

	public function images()
	{
		return $this->json($this->api->images());
	}

	public function media()
	{
		$this->template->partialOnly()
						->set('images', json_encode($this->api->images()))
						->setPartial('admin/media');
	}
}
