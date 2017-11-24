<?php 
namespace Admin\Form;
use Zend\Form\Form;
use Application\Model\SexTable;

class TypeForm extends Form{
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
				'name' => 'nametype',
				'type' => 'text',
				'attributes' => array(
						'id' => 'nametype',
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
		$sexTable = new  SexTable($adapter);
		$data = $sexTable->getListSex();
		$listSex = [];
		foreach ($data as $item){
			$listSex[$item -> id] = $item ->name;
		}
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'sex',
				'attributes' => array(
						'id' => 'description',
						'class' => 'form-control',
				),
				'options' => array (
						'value_options' => $listSex,
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