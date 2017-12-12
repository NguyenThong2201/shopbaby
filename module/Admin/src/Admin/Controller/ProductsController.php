<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ProductsTable;
use Admin\Form\ProductsForm;
use Admin\Form\Filter\ProductsFilter;
use Application\Model\ImageTable;

class ProductsController extends AbstractActionController
{

    public function indexAction()
    {
        $productsTable = new ProductsTable($this->getAdapter());
        $products = $productsTable->getListProduct();
        $this->layout('layout/layout-admin');
        return new ViewModel(array(
            'products' => $products,
        ));
    }

    public function addAction()
    {
        $this->layout('layout/layout-admin');
        $form = new ProductsForm('products', $this->getAdapter());
        $productsTable = new ProductsTable($this->getAdapter());
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setInputFilter(new ProductsFilter());
            $form->setData($data);

            if ($form->isValid()) {
                return new ViewModel(array(
                    'form' => $form,
                ));
            }
            $data = $form->getData();
            //echo $number = count($_FILES['image']['tmp_name']);die();
            if (!empty($data['id'])) {
                $params = array(
                    'name' => $data['name'],
                    'id_type' => $data['id_type'],
                    'description' => $data['description'],
                    'unit_price' => $data['unit_price'],
                    'promotion_price' => $data['promotion_price'],
                    'updated_at' => date('Y-m-d H:i:s'),
                    //'unit' => $data['unit'],
                    'new' => $data['new'],
                );
                $productsTable->update($params, [
                    'id' => $data['id'],
                ]);
            } else {
                $params = array(
                    'name' => $data['name'],
                    'id_type' => $data['id_type'],
                    'description' => $data['description'],
                    'unit_price' => $data['unit_price'],
                    'promotion_price' => $data['promotion_price'],
                    'created_at' => date('Y-m-d H:i:s'),
                    //'unit' => $data['unit'],
                    'new' => $data['new'],
                );
                $productsTable->insert($params);
                $number = count($_FILES['image']['tmp_name']);
                $id_product = $productsTable->getLastInsertValue();
                for ($i = 0; $i < $number; $i++) {
                    $name = $_FILES['image']['name'][$i];
                    move_uploaded_file($_FILES['image']['tmp_name'][$i], "public/img/" . $name);
                    $img = array(
                        'img_name' => $name,
                        'id_product' => $id_product,
                    );
                    $imageTable = new ImageTable($this->getAdapter());
                    $imageTable->insert($img);
                }

            }
            $this->redirect()->toRoute("admin-products", [
                'action' => 'index'
            ]);
        }
        if (!empty($id = $this->params()->fromRoute('id'))) {
            $products = $productsTable->getDetailProduct($id);
            $form->setData([
                'id' => $products->id,
                'name' => $products->name,
                'id_type' => $products->id_type,
                'description' => $products->description,
                'unit_price' => $products->unit_price,
                'promotion_price' => $products->promotion_price,
                //'unit' => $products->unit,
                'new' => $products->new,
            ]);
        }
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function ajaxCheckNameProductsAction()
    {
        $id = $this->params()->fromPost('id');
        $name = $this->params()->fromPost('name');
        //$productsTable = $this->getServiceLocator()->get('Application\Model\ProductsTable');
        $productsTable = new ProductsTable($this->getAdapter());
        $flag = $productsTable->checkProductNameExist($name, $id);
        return new JsonModel(array (
            'flag' => ($flag) ? 1 : 0,
            'id' => $id,
            'name' => $name
        ));
    }

    private function getAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }

}

?>