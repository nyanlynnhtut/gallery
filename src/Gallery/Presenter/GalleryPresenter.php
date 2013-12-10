<?php

namespace Gallery\Presenter;

use Reborn\Presenter\Presentation;

class GalleryPresenter extends Presentation
{

    /**
     * Extend data saveing and deleting method from
     * \Gallery\Model\Gallery
     *
     * @return void
     **/
    protected function extendSkipMethods()
    {
        $this->skip_methods = array_merge($this->skip_methods, array('saveFiles', 'removeFile'));
    }

    /**
     * Get Gallery's File Image Presenter Collection
     *
     * @return \Reborn\Presenter\Collection
     **/
    public function attributeFiles()
    {
        return FilePresenter::make($this->resource->files, true);
    }

	/**
     * Get Gallery Cover Image Url
     *
     * @return string
     **/
    public function attributeCoverUrl()
    {
        if ($this->resource->cover !== '') {
            return rbUrl('image/'.$this->resource->cover.'/150/150');
        }

        return image_data(GALLERY_ASSET.'img'.DS.'cover.png');
    }

    /**
     * JSON Attribute for PhotoWall JS (Use in single view).
     *
     * @return string
     **/
    public function attributePhotoWall()
    {
        $files = $this->attributeFiles();

        $photos = array();

        $tw = (int) \Setting::get('gallery_image_width');
        
        $zoom = (float) \Setting::get('gallery_photowall_zoomsize');

        if ($zoom < 1) {
            $zoom = 1.5;
        }

        foreach ($files as $k => $file) {
            $th = $this->calculateHeight($tw, $file->width, $file->height);
            $id = $k + 1;
            $h = $file->height;
            $w = $file->width;
            $zw = round($tw * $zoom);
            $zh = round($th * $zoom);
            $zsrc = $file->url.'/'.$zw.'/'.$zh;
            $thumb = $file->url.'/'.$tw.'/'.$th;

            $photos[$id] = array(
                "id" => $id,
                "img" => $file->url.'/'.$w.'/'.$h,
                "width" => $w,
                "height" => $h,
                "th" => array(
                    "src" => $thumb,
                    "width" => $tw,
                    "height" => $th,
                    "zoom_src" => $zsrc,
                    "zoom_factor" => $zoom
                )
            );
        }

        return json_encode($photos);
    }

    /**
     * Calcualte Image Height base on given width.
     *
     * @param integer $w
     * @param integer $width Image Original Width
     * @param integer $height Image Original Height
     * @return float
     **/
    protected function calculateHeight($w, $width, $height)
    {
        $aspect_ratio = $height / $width;

        return round($w * $aspect_ratio);
    }
}
