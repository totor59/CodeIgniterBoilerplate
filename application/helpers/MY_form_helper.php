<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ------------------------------------------------------------------------

	/**
	 * Bootstrap Form Helper
	 *
	 * @require Bootstrap3 and Form_validation
   * @author Victor Marechal <victormarechal59@gmail.com>
	 */
// ------------------------------------------------------------------------

	/**
	 * Text Input Field
	 *
	 * @param	array  $data = array(
   *              'label' => NULL,
   *              'type' => 'text',
   *		         	'name' => '',
   *			        'value' => '',
   *			        'placeholder' => '',
   *			        'class' => '',
   *			        'id' => '',
   *
   *
	 * @return	string
	 */
	function bform_input($data = array(
    'type' => 'text',
  ))
	{
		$def = array(
			'type' => isset($data['type']) ? $data['type'] : 'text',
			'name' => isset($data['name']) ? $data['name'] : '',
			'value' => set_value($data['name']) ?: '',
			'placeholder' => isset($data['placeholder']) ? $data['placeholder'] : '',
			'class' => isset($data['class']) ? $data['class'].' form-control' : 'form-control',
			'id' => isset($data['id']) ? $data['id'] : '',
		);
		$formclass = NULL;
		$span = NULL;
    $label = isset($data['label']) ? '<label class="control-label" for="'.$data['name'].'">'.$data['label'].'</label>' : NULL;
    if($def['value'] != '')
    // Success input
    {
			$formclass = "has-success has-feedback";
			$span = "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";
			$value = $def['value'];
    }
    elseif(!empty(form_error($def['name'])))
    // Warning input
    {
			$formclass = "has-error has-feedback";
			$span = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$def['placeholder'] = form_error($def['name']);
			$def['value'] = '';
    }
		return 	"\n<div class='form-group ".$formclass."'>\n".
			$label
			."\n<input type='".$def['type']."' name='".$def['name']."' value='".$def['value']."' placeholder='".$def['placeholder']."' class='".$def['class']."' id='".$def['id']."' data-html='true' />\n
			".$span."
			</div>";
	}

// ------------------------------------------------------------------------
