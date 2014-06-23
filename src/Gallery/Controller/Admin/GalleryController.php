<?php

namespace Gallery\Controller\Admin;

use Input, Flash, Config, Redirect, Validation, Response, Auth;
use Reborn\Form\ValidationError;
use Gallery\Model\Gallery;
use Gallery\Presenter\GalleryPresenter;

class GalleryController extends \AdminController
{
	public function before()
	{
		$this->menu->activeParent('media');
		$this->template->style('admin.gallery.css', 'gallery')
						->script('jquery.tmpl.min.js', 'gallery')
						->script('gallery.js', 'gallery', 'footer');
	}

	/**
	 * Main Index action for gallery album
	 *
	 * @param int $id
	 * @return void
	 **/
	public function index()
	{
		$galleries = GalleryPresenter::make(Gallery::all(), true);

		$this->template->title('Gallery')
						->setPartial('admin/index', array('galleries' => $galleries));
	}

	/**
	 * Create action for new gallery album
	 *
	 * @return void
	 **/
	public function create()
	{
		$g = new Gallery;

		$errors = new ValidationError;

		if (Input::isPost()) {
			$v = Validation::create(Input::get('*'), Config::get('gallery::gallery.rules'));
			if ($v->valid()) {
				$g->name = Input::get('name');
				$g->slug = Input::get('name');
				$g->description = Input::get('description');
				$g->user_id = Auth::getUserId();
				$g->status = Input::get('status');
				$g->cover = Input::get('cover');

				if ($g->save()) {
					Flash::success('Gallery is successfully created. Add files to this gallery.');

					return Redirect::module('add-files/'.$g->id);
				} else {
					Flash::error('Error ouucred to create new gallery!');

					return Redirect::module('create');
				}
			} else {
				$errors = $v->getErrors();
			}
		}

		$this->template->title('Create Gallery')
						->set('gallery', $g)
						->set('errors', $errors)
						->setPartial('admin/form');
	}

	/**
	 * Add Files to new Gallery
	 *
	 * @return void
	 **/
	public function addFiles()
	{
		$gallery = Gallery::find((int) $this->param('id'));

		if (is_null($gallery)) return Response::clueless();

		if (Input::isPost()) {
			if ( $ids = $gallery->saveFiles(Input::get('*')) ) {
				Flash::success('Add files for gallery "'.$gallery->name.'" is success.');

				return Redirect::module();
			} else {
				Flash::error('Error occured to add file at gallery "'.$gallery->name.'"');
			}
		}

		$this->template->title('Add files to '.$gallery->name)
						->set('gallery', GalleryPresenter::make($gallery))
						->jsValue('gallery', $gallery->files->toArray())
						->setPartial('admin/files');
	}

	/**
	 * Remove File to new Gallery
	 *
	 * @return \Reborn\Http\Redirect|\Reborn\Http\Response
	 **/
	public function removeFile()
	{
		$success = false;

		if (Gallery::removeFile((int) $this->param('id'))) {
			$success = true;
		}

		if ($this->request->isAjax()) {
			if ($success) {
				$data = array('status' => 'success', 'message' => 'Removed file from gallery');
			} else {
				$data = array('status' => 'fail', 'message' => 'Error occured to remove file from gallery!');
			}

			return Response::json($data);
		}

		if ($success) {
			Flash::success('Removed file from gallery');
		} else {
			Flash::error('Error occured to remove file from gallery!');
		}

		return Redirect::to(Input::referer());
	}

	/**
	 * Edit action for gallery album
	 *
	 * @param int $id
	 * @return void
	 **/
	public function edit($id)
	{
		$g = Gallery::find($id);

		if (is_null($g)) return Response::clueless();

		$errors = new ValidationError;

		if (Input::isPost()) {
			$v = Validation::create(Input::get('*'), Config::get('gallery::gallery.rules'));
			if ($v->valid()) {
				$g->name = Input::get('name');
				$g->slug = Input::get('name');
				$g->description = Input::get('description');
				$g->status = Input::get('status');
				$g->cover = Input::get('cover');

				if ($g->save()) {
					Flash::success('Gallery is successfully edited');

					return Redirect::module('add-files/'.$g->id);
				} else {
					Flash::error('Error ouucred to edit gallery!');

					return Redirect::module('create');
				}
			} else {
				$errors = $v->getErrors();
			}
		}

		$this->template->title('Edit Gallery')
						->set('gallery', $g)
						->set('errors', $errors)
						->setPartial('admin/form');
	}

	/**
	 * Delete action for gallery album
	 *
	 * @param int $id
	 * @return void
	 **/
	public function delete($id)
	{
		$g = Gallery::find($id);

		if (is_null($g)) return Response::clueless();

		$g->delete();

		\Event::call('gallery.delete', array($id));

		Flash::success('Gallery is successfully deleted');

		return Redirect::module();
	}
}
