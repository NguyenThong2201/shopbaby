<?php 
namespace Application\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;

class ImageTable extends  AbstractTableGateway{
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->table = 'img_product';
	}
}
?>