<?php
namespace Admin\Form\Filter;
use Zend\InputFilter\InputFilter;

class  SlideFilter extends InputFilter{
	public function __construct(){
		$this->add(array(
				'name' => 'image',
				'required' => TRUE,
				'validators' => array (
						array (
								'name' => 'NotEmpty'
						),
						array (
								'name' => 'StringLength',
								'options' => array (
										'min' => 4,
										'max' => 100
								)
						)
				) 
		));
	}
}
?>