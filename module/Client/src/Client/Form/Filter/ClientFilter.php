<?php

namespace Company\Form\Filter;

use Zend\InputFilter\InputFilter;

class ClientFilter extends InputFilter {

	public function __construct($dbAdapter) {
		$this->add(array (
				'name' => 'faf_id',
				'required' => TRUE,
				'allow_empty' => TRUE,
				'validators' => array () 
		));
		$this->add(array (
			'name' => 'secondary_faf_id',
			'required' => TRUE,
			'allow_empty' => TRUE,
			'validators' => array ()
		));
		$this->add(array (
				'name' => 'user_id',
				'required' => TRUE,
				'allow_empty' => TRUE,
				'validators' => array () 
		));
		$this->add(array (
				'name' => 'client_number',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 20 
								) 
						) 
				) 
		));
		$this->add(array (
				'name' => 'first_name',
				'required' => TRUE,
				'validators' => array (
						array (
								'name' => 'NotEmpty' 
						),
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 255 
								) 
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'last_name',
				'required' => TRUE,
				'validators' => array (
						array (
								'name' => 'NotEmpty' 
						
						),
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 255 
								) 
						) 
				) 
		));
		$this->add(array (
				'name' => 'date_birth',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'NotEmpty' 
						) 
				) 
		));
		$this->add(array (
				'name' => 'address',
				'required' => TRUE,
				'validators' => array (
						array (
								'name' => 'NotEmpty' 
						) 
				) 
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
										'adapter' => $dbAdapter,
										'exclude' => ($_POST['user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'E-mail') 
										) 
								) 
						),
				
				) 
		));
		$this->add(array (
				'required' => FALSE,
				'name' => 'home_phone',
				'validators' => array () 
		));
		$this->add(array (
				'required' => FALSE,
				'name' => 'mobile_phone',
				'validators' => array (
						array (
								'name' => 'Db\NoRecordExists',
								'options' => array (
										'table' => 'users',
										'field' => 'phone_number',
										'adapter' => $dbAdapter,
										'exclude' => ($_POST['user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'Mobile phone') 
										) 
								) 
						) 
				) 
		));
		$this->add(array (
				'name' => 'payment_method',
				'required' => FALSE,
				'validators' => array (
						 
				) 
		));
		$this->add(array (
				'required' => FALSE,
				'name' => 'client_hayylo',
				
		));
		
		$this->add(array (
				'name' => 'agency_id',
				'required' => FALSE,
				'validators' => array () 
		));
		
		$this->add(array (
				'name' => 'groups',
				'required' => FALSE,
				
		));
		
		$this->add(array (
				'name' => 'note',
				'required' => FALSE,
				'validators' => array () 
		));
		
		$this->add(array (
				'name' => 'primary_first_name',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 255 
								) 
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'primary_last_name',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 255 
								) 
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'primary_email',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'EmailAddress',
								'messages' => array (
										'emailAddressInvalid' => 'Email is invalid.',
										'emailAddressInvalidFormat' => 'Email is invalid.' 
								) 
						),
						array (
								'name' => 'Db\NoRecordExists',
								'options' => array (
										'table' => 'users',
										'field' => 'email',
										'adapter' => $dbAdapter,
										'exclude' => ($_POST['faf_user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['faf_user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'E-mail') 
										) 
								) 
						),
						array (
								'name' => 'Callback',
								'options' => array (
										'callback' => function () {
											return ($_POST['primary_email'] != $_POST['email']);
										},
										'messages' => array (
												'callbackValue' => "Connections E-mail is not same Client E-mail" 
										) 
								) 
						
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'primary_home_phone',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 15
								) 
						) 
				
				) 
		));
		
		$this->add(array (
				'name' => 'primary_mobile_phone',
				'required' => FALSE,
				'validators' => array (
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 1,
										'max' => 13
								) 
						),
						array (
								'name' => 'Db\NoRecordExists',
								'options' => array (
										'table' => 'users',
										'field' => 'phone_number',
										'adapter' => $dbAdapter,
										'exclude' => ($_POST['faf_user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['faf_user_id']}'" : "valid_flg IS NOT NULL",
										'messages' => array (
												'recordFound' => sprintf(E000018, 'Mobile phone') 
										) 
								) 
						
						),
						array (
								'name' => 'Callback',
								'options' => array (
										'callback' => function () {
											return ($_POST['primary_mobile_phone'] != $_POST['mobile_phone']);
										},
										'messages' => array (
												'callbackValue' => "Connections Mobile phone is not same Client Mobile phone" 
										) 
								) 
						) 
				) 
		));
		
		$this->add(array (
				'name' => 'primary_client_hayylo',
				'required' => FALSE,
				'validators' => array () 
		));

		//secondary contact
		$this->add(array (
			'name' => 'secondary_first_name',
			'required' => FALSE,
			'validators' => array (
				array (
					'name' => 'StringLength',
					'options' => array (
						'min' => 1,
						'max' => 255
					)
				)
			)
		));

		$this->add(array (
			'name' => 'secondary_last_name',
			'required' => FALSE,
			'validators' => array (
				array (
					'name' => 'StringLength',
					'options' => array (
						'min' => 1,
						'max' => 255
					)
				)
			)
		));

		$this->add(array (
			'name' => 'secondary_email',
			'required' => FALSE,
			'validators' => array (
				array (
					'name' => 'EmailAddress',
					'messages' => array (
						'emailAddressInvalid' => 'Email is invalid.',
						'emailAddressInvalidFormat' => 'Email is invalid.'
					)
				),
				array (
					'name' => 'Db\NoRecordExists',
					'options' => array (
						'table' => 'users',
						'field' => 'email',
						'adapter' => $dbAdapter,
						'exclude' => ($_POST['secondary_faf_user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['secondary_faf_user_id']}'" : "valid_flg IS NOT NULL",
						'messages' => array (
							'recordFound' => sprintf(E000018, 'E-mail')
						)
					)
				),
				array (
					'name' => 'Callback',
					'options' => array (
						'callback' => function () {
							return ($_POST['secondary_email'] != $_POST['email']);
						},
						'messages' => array (
							'callbackValue' => "Connections E-mail is not same Client E-mail"
						)
					)

				),
				array (
					'name' => 'Callback',
					'options' => array (
						'callback' => function () {
							return ($_POST['secondary_email'] != $_POST['primary_email']);
						},
						'messages' => array (
							'callbackValue' => "E-mail is not same Primary Contact E-mail"
						)
					)
				)
			)
		));

		$this->add(array (
			'name' => 'secondary_home_phone',
			'required' => FALSE,
			'validators' => array (
				array (
					'name' => 'StringLength',
					'options' => array (
						'min' => 1,
						'max' => 15
					)
				)

			)
		));

		$this->add(array (
			'name' => 'secondary_mobile_phone',
			'required' => FALSE,
			'validators' => array (
				array (
					'name' => 'StringLength',
					'options' => array (
						'min' => 1,
						'max' => 13
					)
				),
				array (
					'name' => 'Db\NoRecordExists',
					'options' => array (
						'table' => 'users',
						'field' => 'phone_number',
						'adapter' => $dbAdapter,
						'exclude' => ($_POST['secondary_faf_user_id']) ? "valid_flg IS NOT NULL AND user_id != '{$_POST['secondary_faf_user_id']}'" : "valid_flg IS NOT NULL",
						'messages' => array (
							'recordFound' => sprintf(E000018, 'Mobile phone')
						)
					)

				),
				array (
					'name' => 'Callback',
					'options' => array (
						'callback' => function () {
							return ($_POST['secondary_mobile_phone'] != $_POST['mobile_phone']);
						},
						'messages' => array (
							'callbackValue' => "Connections Mobile phone is not same Client Mobile phone"
						)
					)
				),
				array (
					'name' => 'Callback',
					'options' => array (
						'callback' => function () {
							return ($_POST['secondary_mobile_phone'] != $_POST['primary_mobile_phone']);
						},
						'messages' => array (
							'callbackValue' => "Mobile phone is not same Primary Contact Mobile phone"
						)
					)
				)
			)
		));

		$this->add(array (
			'name' => 'secondary_client_hayylo',
			'required' => FALSE,
			'validators' => array ()
		));

		$this->add(array (
				'name' => 'client_csrf',
				'required' => TRUE,
				'validators' => array () 
		));
	}
}