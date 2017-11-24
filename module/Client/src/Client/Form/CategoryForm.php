<?php

namespace Company\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class CategoryForm extends Form {

	public function __construct($name ) {
		parent::__construct($name);
		$this->setAttributes(array (
				'method' => 'post',
				'class' => "{$name} fade-in-effect form-horizontal",
				"role" => "form",
				"id" => $name 
		));
		
		$this->add(array (
				'name' => 'category_id',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'category_id',
				)
		));
		$this->add(array (
				'name' => 'task',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'task',
				)
		));
		
		$this->add(array (
				'type' => 'Select',
				'name' => 'category_type',
				'options' => array (
						'empty_option' => 'Choose type',
						'value_options' => unserialize(CATEGORY_TYPE_LIST)
				),
				'attributes' => array (
						'class' => 'form-control',
						'id' => 'category_type',
						'multiple' => FALSE
				)
		));
		
		$this->add(array (
				'name' => 'category_name',
				'type' => 'text',
				'options' => array (
						'id' => 'category_name' 
				),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Category Name' 
				) 
		));
		
		$this->add(array (
				'type' => 'Select',
				'name' => 'valid_flg',
				'options' => array (
						'empty_option' => 'Choose Status',
						'value_options' => unserialize(VALID_FLG_LIST) 
				),
				'attributes' => array (
						'class' => 'form-control',
						'id' => 'valid_flg',
						'multiple' => FALSE 
				) 
		));
		
		$this->add(array (
				'type' => 'submit',
				'name' => 'save',
				'attributes' => array (
						'type' => 'submit',
						'class' => 'btn btn-blue' ,
						'id' => 'save',
						'value' => 'Save'
				) 
		));
		$this->add(array (
				'type' => 'submit',
				'name' => 'cancel',
				'attributes' => array (
						'type' => 'submit',
						'class' => 'btn btn-white',
						'id' => 'cancel',
						'value' => 'Cancel'
				) 
		));
		
		$this->add(array (
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'category_csrf',
				'options' => array (
						'csrf_options' => array (
								'timeout' => 3600 
						) 
				) 
		));
	}
}