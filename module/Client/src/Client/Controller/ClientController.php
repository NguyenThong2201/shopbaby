<?php

namespace Company\Controller;
use Zend\View\Model\ViewModel;

class ClientController{
 
	public function indexAction() {
		if (!$this->isCustomerService() && ! $this->isCompanyAdmin() && $this->isCompanyManager()) {
			throw new \Exception('Request Not Found.');
		}
		return new ViewModel();
	}

	
}