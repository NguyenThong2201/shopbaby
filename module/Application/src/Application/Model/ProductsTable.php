<?php

namespace Application\Model;

use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Http\Header\Expect;

class ProductsTable extends AbstractTableGateway {

	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		$this->table = "products";
	}

	public function getListProduct() {
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'name',
				'unit_price',
				'promotion_price',
				'description',
				'new',
		));
		$select->join('type_products','type_products.id = products.id_type',array(
				'name_type',
				'id_sex',
				'description_type',
		),$select::JOIN_INNER);
        $result = $this->selectWith($select);

        $arr = [];
        foreach ($result as  $sp){
            $listImg = $this->getListImgByIdProduct($sp['id']);
            $sp['imgs'] = $listImg;
            $arr[] = $sp;
        }
		return $arr;
	}
	public  function getCountProducts(){
        $select = new Select('products');
        $select->columns([new Expression("count(*) as total")]);
    }
	public function getListImgByIdProduct($id){
		$select = new Select('img_product');
		$select->columns(array(
			'id',
			'img_name',
			'id_product',
		))->where(array('id_product' => $id));
		$result = $this->selectWith($select);
		return $result->count() ? $result : null;
	}
	public function  getDetailProduct($id){
		if (empty($id)){
			throw new \InvalidArgumentException("Invalid $id");
		}
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'name',
				'id_type',
				'unit_price',
				'promotion_price',
				'description',
				'unit',
				'new',
		));
		$select->where(array('id'=>$id));
		$result = $this->selectWith($select);
		return $result->count() ? $result->current() : NULL;
	}
	public function getListProductNew() {
		$select = new Select('products');
		$select->columns(array(
				'id',
				'name',
				'unit_price',
				'promotion_price',
				'description',
				'new',
		));
		$select->join('type_products','type_products.id = products.id_type',array(
				'name_type',
				'id_sex',
				'description_type',
		),$select::JOIN_INNER);
		$select->join('img_product', 'img_product.id_product = products.id',array(
				'img_name',
		),$select::JOIN_INNER);
		$select->where(array('products.new' => 0));
		$result = $this->selectWith($select);
		return $result->count() ? $result : null;
	}
	public function getListProductSale() {
		$select = new Select('products');
		$select->columns(array(
				'id',
				'name',
				'unit_price',
				'promotion_price',
				'description',
				'new',
		));
		$select->join('type_products','type_products.id = products.id_type',array(
				'name_type',
				'id_sex',
				'description_type',
		),$select::JOIN_INNER);
		$select->join('img_product', 'img_product.id_product = products.id',array(
				'img_name',
		),$select::JOIN_INNER);
		$select->where(array('products.promotion_price < products.unit_price'));
		$result = $this->selectWith($select);
//		var_dump($result);
//		die();
		return $result->count() ? $result : null;
	}

    function checkProductNameExist($name, $id) {
        $result = $this->select(function (Select $select) use ($name, $id) {
            $select->columns(array (
                'name'
            ));
            if ($id) {
                $select->where(array (
                    'name' => $name,
                    'valid_flg IS NOT NULL'
                ));
                $select->where->notEqualTo('id', $id);
            } else {
                $select->where(array (
                    'group_name' => $name,
                    'valid_flg IS NOT NULL'
                ));
            }
        });
        return $result->count() ? TRUE : FALSE;
    }
	public function getNameProductById($id){
        $select = new Select('products');
        $select->columns(array(
            'name',
        ));
        $select->where(array('id'=>$id));
    }
}
?>