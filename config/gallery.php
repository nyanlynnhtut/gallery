<?php

/**
 * Configuration File for Gallery Module
 *
 */

return array(

	/**
	 * Gallery Validation Rules
	 */
	'rules' => array(
		'name' => 'required|maxLength:200',
		'slug' => 'maxLength:210',
		'status' => 'required',
		'cover' => 'maxLength:200',
	),

);
