<?php

namespace Company\Form\Filter;

use Zend\InputFilter\InputFilter;

class UserFormFilter extends InputFilter {

	public function __construct($adapter) {
		$this->add(array (
				'name' => 'groups',
				'required' => FALSE 
		
		));
		$this->add(array (
				'name' => 'email',
				'required' => FALSE,
				'allow_empty' => TRUE,
				'validators' => array (
						array (
								'name' => 'EmailAddress',
								'messages' => array (
										'emailAddressInvalid' => 'Email is invalid.',
										'emailAddressInvalidFormat' => 'Email is invalid.' 
								) 
						),
						array (
								'name' => 'Db\NoRecordExists  ',
								'options' => array (
										'table' => 'users',
										'field' => 'email',
										'adapter' => $adapter,
										'exclude' => ($_POST['user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'E-mail') 
										) 
								) 
						) 
				
				) 
		));
		$this->add(array (
				'required' => FALSE,
				'name' => 'phone_number',
				'validators' => array (
						array (
								'name' => 'Db\NoRecordExists',
								'options' => array (
										'table' => 'users',
										'field' => 'phone_number',
										'adapter' => $adapter,
										'exclude' => ($_POST['user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'Mobile phone') 
										) 
								) 
						) 
				) 
		));
	}
}