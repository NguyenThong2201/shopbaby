<?php 
namespace Application\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;

class SexTable extends  AbstractTableGateway{
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->table = 'sex';
	}
	public function getListSex(){
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'name',
		));
		$select->order('id');
		$result = $this->selectWith($select);
		return $result->count() ? $result : NULL;
	}
}
?>