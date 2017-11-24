<?php

namespace Company\Form;

use Zend\Form\Form;

class ProfileForm extends Form {

	public function __construct($name = null) {
		parent::__construct('form_profile');
		$this->add(array(
			'type'    => 'Zend\Form\Element\Csrf',
			'name'    => 'csrf',
			'options' => array(
				'csrf_options' => array(
					'timeout' => 7200
				)
			)
		));
	}

}