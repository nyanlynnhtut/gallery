<?php

namespace Gallery\Model;

use Gallery\Presenter\FilePresenter;

class Gallery extends \Eloquent
{
    protected $table = 'galleries';

    protected $multisite = true;

    /**
     * Scope Query for Live Album Only
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     **/
    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    /**
     * Get Relation Gallery Files
     * Gallery and Gallery Files Relation is One To Many
     *
     * @return \Illuminate\Database\Eloquent\Collection
     **/
    public function files()
    {
    	return $this->hasMany('\Gallery\Model\File', 'gallery_id')
                    ->orderBy('position', 'asc');
    }

    /**
     * Set Gallery's "slug" column value
     *
     * @param string $value
     * @return void
     **/
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = slug($value);
    }

    /**
     * Set Gallery's "cover" column value
     *
     * @param string $value
     * @return void
     **/
    public function setCoverAttribute($value)
    {
        $value = explode('/', $value);

        $this->attributes['cover'] = $value[0];
    }

    /**
     * Save File for This Gallery Album
     *
     * @param array $inputs Input file data
     * @return boolean
     **/
    public function saveFiles(array $inputs)
    {
        $lists = array();
        $i = 1;

        $exits = $this->files->toArray();

        if (!empty($exits)) {
            $ids = array_map(function($i){
                return $i['id'];
            }, $exits);

            File::destroy($ids);
        }

        $time = $this->freshTimestamp();

        foreach ($inputs['files'] as $k => $v) {
            if ($v !== '') {
                $list = array();
                $list['gallery_id'] = $this->attributes['id'];
                $list['label'] = $inputs['file_label'][$k];
                $list['description'] = $inputs['file_description'][$k];
                $list['type'] = 'image';
                $list['file_id'] = $v;
                $list['file_url'] = '';
                $list['position'] = $i;
                if (isset($inputs['file_target_url'][$k])) {
                    $list['target_url'] = $inputs['file_target_url'][$k];
                }
                $list['width'] = $inputs['file_width'][$k];
                $list['height'] = $inputs['file_height'][$k];
                $list['created_at'] = $time;
                $list['updated_at'] = $time;
                $lists[] = $list;
                $i++;
            }
        }

        if (empty($lists)) return true;

        return File::insert($lists);
    }

    /**
     * Remove File form this gallery
     *
     * @param int $id File ID
     * @return boolean
     **/
    public static function removeFile($id)
    {
        $file = File::find($id);

        if (is_null($file)) return false;

        $file->delete();

        return true;
    }

}
