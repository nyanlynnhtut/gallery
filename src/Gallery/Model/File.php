<?php

namespace Gallery\Model;

class File extends \Eloquent
{
	protected $table = 'gallery_files';

	protected $multisite = true;

	/**
     * Get Relation Gallery
     * Gallery and Gallery Files Relation is One To Many
     *
     * @return \Gallery\Model\Gallery
     **/
    public function gallery()
    {
    	return $this->belongsTo('\Gallery\Model\Gallery');
    }
}
