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
		if (\Input::get('file_name')) {

		}
		return $this->json($this->api->images());
	}

	public function folder()
	{
		$data = array();

		if (\Input::isPost()) {
			$id = (int) \Input::get('folder_id', 0);

			$data = $this->api->images($id);
		}

		return $this->json($data);
	}

	public function media()
	{
		$this->template->style('admin.gallery.css', 'gallery');
		$this->template->partialOnly()
						->set('images', json_encode($this->api->images()))
						->set('folders', $this->api->treeListForSelect('Chooe From Root'))
						->setPartial('admin/media');
	}
}
