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
		'status' => 'required',
		'cover' => 'maxLength:200',
	),

);
