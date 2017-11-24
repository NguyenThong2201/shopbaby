<?php 
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\TypeProductsTable;
use Zend\View\Model\ViewModel;
use Admin\Form\TypeForm;
use Admin\Form\Filter\TypeFilter;

class TypeController extends  AbstractActionController{
	public function listAction(){
		$typeTable = new TypeProductsTable($this->getAdapter());
		$type = $typeTable->getListTypeProducts();
		$this->layout('layout/layout-admin');
		return new ViewModel(array(
				'type'=>$type
		));
	}
	public function addAction(){
		$this->layout('layout/layout-admin');
		$form = new TypeForm('type', $this->getAdapter());
		$typeTable = new TypeProductsTable($this->getAdapter());
		$request = $this->getRequest();
		if ($request->isPost()){
			$data = $request->getPost();
			$form->setInputFilter(new TypeFilter());
			$form->setData($data);
			if (!$form->isValid()){
				return new ViewModel([
					'form' => $form,
				]);
			}
			$data = $form->getData();
			if (!empty($data['id'])){
				$params =array(
						'name_type' => $data['nametype'],
						'description_type' => $data['description'],
						'id_sex' => $data['sex'],
						'updated_at' => date('Y-m-d H:i:s'),
				);
				$typeTable->update($params,[
						'id' => $data['id']
				]);
			}else {
				$params =array(
						'name_type' => $data['nametype'],
						'description_type' => $data['description'],
						'id_sex' => $data['sex'],
						'created_at' => date('Y-m-d H:i:s'),
				);
				$typeTable->insert($params);
			}
            return $this->redirect()->tourl($this->url()->fromRoute('admin-type'));
		}
		if (!empty($id = $this->params()->fromRoute('id'))){
			$type = $typeTable->getTypeProductsById($id);
			$form->setData(array(
					'id' => $type->id,
					'nametype' => $type->name_type,
					'description' => $type->description_type,
			));
		}
		return new ViewModel(array(
				'form' => $form,
		));
	}
	private function getAdapter(){
		return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
	}
}
?>