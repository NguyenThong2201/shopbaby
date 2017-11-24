<?php

namespace Company\Form\Invoice;

use Zend\Form\Form;

class OngoingForm extends Form {

	public function __construct($name = null) {

		parent::__construct('form_ongoing');

		$this->add(array(
			'type'    => 'Zend\Form\Element\Csrf',
			'name'    => 'csrf',
			'options' => array(
				'csrf_options' => array(
					'timeout' => 3600
				)
			)
		));

		$this->add(array(
			'name'       => 'from_date',
			'type'       => 'text',
			'options'    => array(
				'id' => 'from_date'
			),
			'attributes' => array(
				'class'    => 'form-control date-picker',
				'title'    => 'From date',
				'value'    => date_create(date('Y-m-d'))->modify('-1 month')->format('d-m-Y')
			)
		));

		$this->add(array(
			'name'       => 'to_date',
			'type'       => 'text',
			'options'    => array(
				'id' => 'to_date'
			),
			'attributes' => array(
				'class' => 'form-control date-picker',
				'title' => 'To date',
				'value' => date('d-m-Y')
			)
		));
	}

}