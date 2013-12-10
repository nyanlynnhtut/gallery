<?php

// Route file for module Gallery
/*Route::get('@admin/gallery', 'Gallery\Controller\Admin\Gallery::index', 'gallery_index');
Route::add('@admin/gallery/create', 'Gallery\Controller\Admin\Gallery::create', 'gallery_create');
Route::get('@admin/gallery/edit/{int:id}', 'Gallery\Controller\Admin\Gallery', 'gallery_index');*/

Route::crud('@admin/gallery', 'Gallery\Admin\Gallery', 'admin_gallery');

Route::add('@admin/gallery/add-files/{int:id}', 'Gallery\Admin\Gallery::addFiles', 'add_files_to_gallery');

Route::add('@admin/gallery/remove-file/{int:id}', 'Gallery\Admin\Gallery::removeFile', 'remove_file_to_gallery');

// Image API Search Routes
Route::group('@admin/gallery/search', function(){
	Route::get('images', 'Gallery\Admin\Search::images', 'gallery_image_search');

	Route::get('media', 'Gallery\Admin\Search::media', 'gallery_media_manager');
});

// Frontend Routes
Route::group('gallery', function(){
	Route::get('', 'Gallery\Gallery::index', 'gallery_index');

	Route::get('{str:slug}', 'Gallery\Gallery::view', 'gallery_album');
});
