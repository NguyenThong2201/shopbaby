<?php

namespace Company\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class AvailabilitiesForm extends Form {

	public function __construct($name, $dbAdapter, $companyId) {
		parent::__construct($name);
		$skill = $dbAdapter->get('Application\Model\SkillTable');
		$this->setAttributes(array (
				'method' => 'post',
				'class' => "{$name} form-horizontal",
				"role" => "form",
				"id" => $name 
		));
		
		$this->add(array (
				'name' => 'client_place_name',
				'type' => 'Text',
				'attributes' => array (
						'class' => 'form-control address',
						'id' => 'client_place_name',
						'placeholder' => 'Enter Client name, place'
				)
		));
		$this->add(array (
				'name' => 'address',
				'type' => 'Text',
				'attributes' => array (
						'class' => 'form-control',
						'id' => 'address',
						'placeholder' => 'Address'
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
				'name' => 'from_date',
				'type' => 'text',
				'attributes' => array (
						'id' => 'from_date',
						'class' => 'form-control datepicker',
						'data-format' => 'D, dd MM yyyy',
						'data-start-date'=> "+1d"
				)
		));
		$this->add(array (
				'name'	=> 'place_id',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'place_id'
				)
		));
		$this->add(array (
				'name'	=> 'client_id',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'client_id'
				)
		));
		$this->add(array (
				'name'	=> 'state',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'administrative_area_level_1'
				)
		));
		$this->add(array (
				'name'	=> 'postcode',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'postal_code'
				)
		));
		$this->add(array (
				'name'	=> 'longitude',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'longitude'
				)
		));
		$this->add(array (
				'name'	=> 'suburb',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'locality'
				)
		));
		$this->add(array (
				'name'	=> 'suburb',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'locality'
				)
		));
		$this->add(array (
				'name'	=> 'latitude',
				'type'	=> 'hidden',
				'attributes' => array (
						'id'	=> 'latitude'
				)
		));
		$this->add(array (
				'name'	=> 'request_type',
				'type'	=> 'radio',
				'options' => array(
						'value_options' => array(
							1 => 'Once Off',
							2 => 'Ongoing'
						)
				),
				'attributes' => array (
						'id'	=> 'request_type',
						'value'	=> 1
				),
		));
		$this->add(array (
				'type' => 'Select',
				'name' => 'skills',
				'options' => array(
						'value_options' => $skill->getListOption($companyId),
				),
				'attributes' => array (
						'multiple' => true,
						'class' => 'form-control',
						'id' => 'skill'
				)
		));
		$this->add(array (
				'name' => 'repeat_type',
				'type' => 'Select',
				'options' => array(
						'value_options' => unserialize(REPEAT_LIST),
						'empty_option' => 'Please choose',
				),
				'attributes' => array (
						'class' => 'form-control',
						'id' => 'repeat',
						'multiple' => FALSE
				)
		));
		$this->add(array (
				'name' => 'weekly_day',
				'type' => 'MultiCheckbox',
				'options' => array (
						'value_options' => unserialize(DAY_LIST_SHOT),
						'use_hidden_element' => false,
						'unchecked_value' => ''
				),
				'attributes' => array(
						'id' => 'weekly_day',
				)
		));
		$this->add(array (
				'name' => 'submit',
				'type' => 'submit',
				'attributes' => array (
						'id' => 'submit',
						'class' => 'btn btn-blue',
						'value' => 'Check'
				),
		));
		
		$this->add(array (
				'name' => 'invite',
				'type' => 'submit',
				'attributes' => array (
						'id' => 'invite',
						'class' => 'btn btn-blue',
						'value' => 'Invite to request'
				),
		));
		
		$this->add(array (
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'worker_csrf',
				'options' => array (
						'csrf_options' => array (
								'timeout' => 3600 
						) 
				) 
		));
	}
}