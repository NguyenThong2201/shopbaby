<?php
namespace Admin\Form;
use Zend\Form\Form;
use Application\Model\TypeProductsTable;

class ProductsForm extends Form{
	public function __construct($name,$adapter) {
		parent::__construct($name);
		$this->setAttributes(array (
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
				'name' => 'name',
				'type' => 'text',
				'attributes' => array(
						'id' => 'name',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'unit_price',
				'type' => 'text',
				
				'attributes' => array(
						'id' => 'unit_price',
						'placeholder' => '2.500.000',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'promotion_price',
				'type' => 'text',
				'attributes' => array(
						'id' => 'promotion_price',
						'placeholder' => '2.000.000',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'description',
				'type' => 'textarea',
				'attributes' => array(
						'id' => 'description',
						'placeholder' => 'Bán chứ không cho ...',
						'class' => 'form-control',
				)
		));
		$this->add(array(
				'name' => 'image',
				'type' => 'file',
				
				'attributes' => array(
						'id' => 'imgInp',
						'class' => 'form-control',
						'multiple' => 'multiple',
				)
		));
		$TypeProductsTable = new TypeProductsTable($adapter);
		$data = $TypeProductsTable->getListTypeProducts();
		$listType = [];
		foreach ($data as $item){
			$listType[$item -> id] = $item ->name_type;
		}
		$this->add(array (
				'name' => 'id_type',
				'id'	=> 'type',
				'type' => 'Zend\Form\Element\Select',
				'attributes' => array (
						'class' => 'form-control'
				),
				'options' => array (
						'value_options' => $listType,
				)
		));
		$this->add(array(
				'name'	=> 'sex',
				'id' => 'sex',
				'type' => 'Zend\Form\Element\Radio',
				'atributes'=> array(
						'class' => 'form-control',
				),
				'option' => array(
						'value_options' => array(
								'1' => 'Men',
								'2' => 'Woment',
						),
				)
		));
		$this->add(array (
				'name' => 'new',
				'id'	=> 'new',
				'type' => 'Zend\Form\Element\Select',
				'attributes' => array (
						'class' => 'form-control'
				),
				'options' => array (
						'value_options' => array(
								'0'=>'New',
								'1'=>'Off New',
						),
				)
		));
// 		$this->add(array (
// 				'name' => 'unit',
// 				'id'	=> 'unit',
// 				'type' => 'Zend\Form\Element\Select',
// 				'attributes' => array (
// 						'class' => 'form-control'
// 				),
// 				'options' => array (
// 						'value_options' => array(
// 								'Cái'=>'Cái',
// 								'Bộ'=>'Bộ'
// 						),
// 				)
// 		));
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