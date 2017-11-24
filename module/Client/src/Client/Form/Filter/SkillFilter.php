<?php

namespace Company\Form\Filter;

use Zend\InputFilter\InputFilter;

class SkillFilter extends InputFilter {

	public function __construct() {
		
		$this->add(array (
				'name' => 'users',
				'required' => FALSE
		));
	}
}