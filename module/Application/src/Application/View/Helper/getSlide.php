<?php
namespace Application\View\Helper;

use Application\Model\SlideTable;
use Zend\View\Helper\AbstractHelper;

class getSlide extends AbstractHelper{
    protected $dbAdapter = null;
    public function __construct($dbAdapter) {
        if (!$this->dbAdapter) {
            $this->dbAdapter = $dbAdapter;
        }
    }
    public function __invoke() {
        $slideTable = new SlideTable($this->dbAdapter);
        $this->getList = $slideTable->getListSlide();
        return $this;
    }
}
?>