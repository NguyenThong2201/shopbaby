<?php 
namespace Application\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;

class SlideTable extends  AbstractTableGateway{
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->table = 'slide';
	}
	public function getListSlide(){
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'image',
				'description',
				'link'
		));
		$result = $this->selectWith($select);
		return $result->count() ? $result : NULL;
	}

	public function getNameSlideById($id){
	    $select = new Select($this->table);
	    $select->columns(array(
	        'image'
        ))->where(array('id'=> $id));
        $result = $this->selectWith($select);
        return $result->count() ? $result : NULL;
    }
	public function getSlideById($id){
		if (empty($id)){
			throw new \InvalidArgumentException("Invalid $id");
		}
		$select = new Select();
		$select->columns(array(
				'id',
				'description',
				'link',
				'image',
		));
		$select->where(array('id'=>$id));
		$result = $this->selectWith($select);
		return $result->count() ? $result->current() : NULL;
	}
}
?>