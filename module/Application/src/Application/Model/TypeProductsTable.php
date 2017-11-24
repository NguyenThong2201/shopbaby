<?php 
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class TypeProductsTable extends AbstractTableGateway {
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->table = 'type_products';
	}
	public function getListTypeProducts(){
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'name_type',
				'description_type',
				'image',
				'id_sex',
				'created_at',
				'updated_at',
		));
		$result = $this->selectWith($select);
		return $result->count() ? $result : NULL;
	}
	public function getTypeProductsById($id){
		if (empty($id)){
			throw new \InvalidArgumentException("Invalid $id");
		}
		$select = new Select('type_products');
		$select->columns(array(
				'id',
				'name_type',
				'description_type',
				'image',
				'id_sex',
				'created_at',
				'updated_at',
		));
		$select->where(array('id'=>$id));
		$result = $this->selectWith($select);
		return $result->count() ? $result->current() : NULL;
	}
}
?>