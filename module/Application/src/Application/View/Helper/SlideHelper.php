<?php 
namespace Application\View\Helper;
use Zend\Db\Adapter\Adapter;
use Zend\View\Helper\AbstractHelper;
use Application\Model\SlideTable;

class SlideHelper extends AbstractHelper{
	protected $adapter;
	
	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
	}
	public function __invoke()
	{
		$slideTable = new SlideTable($this->adapter());
		$slide = $slideTable->getListSlide();
		return array(
				'slide'=>$slide,
				
		);
	}
}
?>