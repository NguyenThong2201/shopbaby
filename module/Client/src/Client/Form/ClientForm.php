<?php

namespace Company\Form;

use Application\Model\AgencyTable;
use Application\Model\GroupTable;
use Zend\Form\Form;

class ClientForm extends Form {

	public function __construct($name, $params = array()) {
		parent::__construct($name);
		
		$this->setAttributes(array (
				'method' => 'post',
				'class' => "{$name} fade-in-effect form-horizontal",
				"role" => "form",
				"id" => $name,
				'autocomplete' => 'off' 
		));
		$this->add(array (
				'name' => 'task',
				'type' => 'Zend\Form\Element\Hidden',
				'attributes' => array (
						'id' => 'task' 
				) 
		));

		$this->add(array (
				'name' => 'faf_id',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'faf_id'
				) ,

		));
		$this->add(array (
				'name' => 'faf_user_id',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'faf_user_id'
				),
		));
		$this->add(array (
			'name' => 'secondary_faf_id',
			'type' => 'hidden',
			'attributes' => array (
				'id' => 'secondary_faf_id'
			) ,

		));
		$this->add(array (
			'name' => 'secondary_faf_user_id',
			'type' => 'hidden',
			'attributes' => array (
				'id' => 'secondary_faf_user_id'
			),
		));
		$this->add(array (
				'name' => 'user_id',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'user_id'
				),
		));
		
		$this->add(array (
				'name' => 'hayylo_user_id',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'id' => 'hayylo_user_id',
						'disabled' => TRUE
				)
		));
		
		$this->add(array (
				'name' => 'client_number',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Client Number',
						'maxlength' => 20,
						'id' => 'client_number' 
				) 
		));

		$this->add(array (
			'name' => 'avatar',
			'type' => 'hidden',
		));
		$this->add(array (
			'name' => 'tempFile',
			'type' => 'hidden',
		));

		$this->add(array (
				'name' => 'first_name',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'First name',
						'maxlength' => 255,
						'id' => 'first_name' 
				) 
		));
		
		$this->add(array (
				'name' => 'last_name',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Last name',
						'maxlength' => 255,
						'id' => 'last_name' 
				) 
		));
		$this->add(array (
				'name' => 'date_birth',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control datepicker',
						'placeholder' => 'Date of Birth',
						'data-format' => 'D, dd MM yyyy',
						'id' => 'date_birth' 
				) 
		));
		$this->add(array (
				'name' => 'address',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Address',
						'maxlength' => 255,
						'id' => 'address' 
				) 
		));
		$this->add(array (
				'name' => 'email',
				'type' => 'Zend\Form\Element\Email',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Email',
						'maxlength' => 255,
						'id' => 'email' 
				) 
		));
		$this->add(array (
				'name' => 'home_phone',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Home phone',
						'maxlength' => 14,
						'id' => 'home_phone',
						'data-mask' => '(99) 9999 9999'
				) 
		));
		$this->add(array (
				'name' => 'mobile_phone',
				'type' => 'Zend\Form\Element\Text',
				'options' => array (),
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Mobile phone',
						'maxlength' => 13,
						'id' => 'mobile_phone',
						'data-mask' => '9999 999 999'
				) 
		));
		$this->add(array (
				'name' => 'payment_method',
				'type' => 'Zend\Form\Element\Select',
				'options' => array (
						'value_options' => array (
								'0' => 'Pay by Invoice',
								'1' => 'Pay by Credit Card' 
						) 
				),
				'attributes' => array (
						'class' => 'form-control sboxit',
						'id' => 'payment_method' 
				) 
		));
		$this->add(array (
				'type' => 'Zend\Form\Element\Checkbox',
				'name' => 'client_hayylo',
				'options' => array (
						'value_options' => array (),
						'attributes' => array (
								'value' => '1' 
						) ,
						'use_hidden_element' => FALSE,
				),
				'attributes' => array (
						'class' => 'cbr',
						'id' => 'client_hayylo' 
				) 
		));
		$agencyTable = new AgencyTable($params['adapter']);
		$agency = $agencyTable->getListAgency($params['company_id']);
		$option[''] = 'None';
		if ($agency){
			foreach ($agency as $val){
				$option[$val->agency_id] = $val->agency_name;
			}
		}
		$this->add(array (
				'name' => 'agency_id',
				'type' => 'Zend\Form\Element\Select',
				'options' => array (
						'value_options' =>$option
				),
				'attributes' => array (
						'class' => 'form-control sboxit',
						'id' => 'agency_id' 
				) 
		));
		$groupTable = new GroupTable($params['adapter']);
		$this->add(array (
				'type' => 'Zend\Form\Element\MultiCheckbox',
				'name' => 'groups',
				'options' => array (
						'value_options' => $groupTable->getGroupByCompanyId($params['company_id'], TRUE) 
				),
				'attributes' => array (
						'class' => 'cbr' 
				) 
		
		));
		$this->add(array (
				'type' => 'Zend\Form\Element\Textarea',
				'name' => 'note',
				'options' => array (),
				'attributes' => array (
						'class' => 'note',
						'id' => 'note',
						'cols' => 5,
						'rows' => 5,
						'class' => 'form-control' 
				) 
		));
		$this->add(array (
				'name' => 'primary_first_name',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'First name',
						'id' => 'primary_first_name' 
				) 
		));
		$this->add(array (
				'name' => 'primary_last_name',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Last name',
						'id' => 'primary_last_name' 
				) 
		));
		$this->add(array (
				'name' => 'primary_email',
				'type' => 'Zend\Form\Element\Email',
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'E-mail',
						'id' => 'primary_email' 
				) 
		));
		$this->add(array (
				'name' => 'primary_home_phone',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Home Phone',
						'id' => 'primary_home_phone',
						'maxlength' => 14,
						'data-mask' => '(99) 9999 9999'
				) 
		));
		$this->add(array (
				'name' => 'primary_mobile_phone',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array (
						'class' => 'form-control',
						'placeholder' => 'Mobile phone',
						'id' => 'primary_mobile_phone',
						'maxlength' => 13,
						'data-mask' => '9999 999 999'
				) 
		));
		$this->add(array (
				'type' => 'Zend\Form\Element\Checkbox',
				'name' => 'primary_client_hayylo',
				'options' => array (
						'value_options' => array (),
						'attributes' => array (
								'value' => '1' 
						),
						'use_hidden_element' => FALSE,
				),
				'attributes' => array (
						'use_hidden_element' => FALSE,
						'class' => 'cbr',
						'id' => 'primary_client_hayylo' 
				) 
		));

		//secondary contact
		$this->add(array (
			'name' => 'secondary_first_name',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array (
				'class' => 'form-control',
				'placeholder' => 'First name',
				'id' => 'secondary_first_name'
			)
		));
		$this->add(array (
			'name' => 'secondary_last_name',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array (
				'class' => 'form-control',
				'placeholder' => 'Last name',
				'id' => 'secondary_last_name'
			)
		));
		$this->add(array (
			'name' => 'secondary_email',
			'type' => 'Zend\Form\Element\Email',
			'attributes' => array (
				'class' => 'form-control',
				'placeholder' => 'E-mail',
				'id' => 'secondary_email'
			)
		));
		$this->add(array (
			'name' => 'secondary_home_phone',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array (
				'class' => 'form-control',
				'placeholder' => 'Home Phone',
				'id' => 'secondary_home_phone',
				'maxlength' => 14,
				'data-mask' => '(99) 9999 9999'
			)
		));
		$this->add(array (
			'name' => 'secondary_mobile_phone',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array (
				'class' => 'form-control',
				'placeholder' => 'Mobile phone',
				'id' => 'secondary_mobile_phone',
				'maxlength' => 13,
				'data-mask' => '9999 999 999'
			)
		));
		$this->add(array (
			'type' => 'Zend\Form\Element\Checkbox',
			'name' => 'secondary_client_hayylo',
			'options' => array (
				'value_options' => array (),
				'attributes' => array (
					'value' => '1'
				),
				'use_hidden_element' => FALSE,
			),
			'attributes' => array (
				'use_hidden_element' => FALSE,
				'class' => 'cbr',
				'id' => 'secondary_client_hayylo'
			)
		));

		$this->add(array (
				'type' => 'submit',
				'name' => 'save',
				'attributes' => array (
						'type' => 'submit',
						'class' => 'btn btn-pink pull-right',
						'id' => 'save',
						'value' => 'Save' 
				) 
		));
		
		$this->add(array (
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'client_csrf',
				'options' => array (
						'csrf_options' => array (
								'timeout' => 3600 
						) 
				) 
		));
	}
}