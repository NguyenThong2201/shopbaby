<?php

namespace Company\Form\Filter;

use Zend\InputFilter\InputFilter;

class ManagerFilter extends InputFilter {

	public function __construct() {
		$this->add(array (
				'name' => 'groups',
				'required' => FALSE
		));
		
	}
}