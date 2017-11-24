<?php

namespace Company\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class AssignSkillForm extends Form {

	public function __construct($name, $params = array()) {
		parent::__construct($name);
		$this->setAttributes(array (
				'method' => 'post',
				'class' => "{$name} fade-in-effect form-horizontal",
				"role" => "form",
				"id" => $name 
		));
		
				$this->add(array (
				'name' => 'worker_id',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'worker_id',
				)
		));
		
		$this->add(array (
				'name' => 'worker_name',
				'type' => 'text',
				'options' => array (
						'id' => 'worker_name'
				),
				'attributes' => array (
						'id' => 'worker_name',
						'class' => 'form-control',
						'placeholder' => 'Firtname + Last Name'
				)
		));
		
		$this->add(array (
				'type' => 'MultiCheckbox',
				'name' => 'skills',
				'options' => array (
						'value_options' => $params['skillTable']->getListOptionByCompanyId($params['company_id'], $params['is_name'])
				),
				'attributes' => array (
						'class' => 'check'
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
				'name' => 'place_csrf',
				'options' => array (
						'csrf_options' => array (
								'timeout' => 3600 
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'task',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'task',
				)
		));
	}
}