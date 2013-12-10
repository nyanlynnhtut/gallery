<?php

namespace Gallery\Presenter;

use Reborn\Presenter\Presentation;

class FilePresenter extends Presentation
{

	/**
	 * Get file's gallery relation data
	 *
	 * @return \Gallery\Presenter\GalleryPresenter
	 **/
	public function attributeGallery()
	{
		return GalleryPresenter::make($this->resource->gallery);
	}

	/**
     * Has a Label Value for this File?
     *
     * @return boolean
     **/
    public function attributeHasLabel()
    {
    	return ($this->resource->label !== '');
    }

    /**
     * Has a Description Value for this File?
     *
     * @return boolean
     **/
    public function attributeHasDescription()
    {
    	return ($this->resource->description !== '');
    }

    /**
     * Has a Label and Description Values for this File?
     *
     * @return boolean
     **/
    public function attributeHasLabelAndDescription()
    {
    	return ($this->resource->description !== '' && $this->resource->label !== '');
    }

    /**
	 * Get Gallery File's File URL.
	 *
	 * @return string
	 **/
	public function attributeUrl()
	{
		$type = $this->resource->type;

		switch ($type) {

			case 'image':
				return rtrim(rbUrl('image/'.$this->resource->file_id), '/');
				break;

			default:
				return $this->resource->file_url;
				break;
		}
	}

	/**
	 * Get Gallery File's File URL Data Only.
	 *
	 * @return string
	 **/
	public function attributeUrlData()
	{
		$type = $this->resource->type;

		switch ($type) {

			case 'image':
				return $this->resource->file_id;
				break;

			default:
				return $this->resource->file_url;
				break;
		}
	}

}
