<?php 
namespace Admin\Form;
use Zend\Form\Form;

class SlideForm extends Form{
	public function __construct($name, $adapter){
		parent::__construct($name);
		$this->setAttributes(array(
				'method' => 'post',
				"role" => "form",
				"id" => $name,
				"enctype" => "multipart/form-data",
		));
		$this->add(array(
				'name' => 'id',
				'type' => 'hidden',
				'attributes' => array(
						'id' => 'id',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'description',
				'type' => 'textarea',
				'attributes' => array(
						'id' => 'description',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'image',
				'type' => 'file',
				'attributes' => array(
						'id' => 'id',
						'class' => 'form-control file',
				)
		));
		$this->add(array (
				'name' => 'submit',
				'attributes' => array (
						'type' => 'submit',
						'class' => 'btn btn-success',
						'id' => 'save',
						'value' => 'Save'
				)
		));
	}
}
?>