<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\SlideTable;
use Zend\View\Model\ViewModel;
use Admin\Form\SlideForm;
use Admin\Form\Filter\SlideFilter;

class SlideController extends AbstractActionController
{
    public function listAction()
    {
        $slideTable = new SlideTable($this->getAdapter());
        $slide = $slideTable->getListSlide();
        $this->layout('layout/layout-admin');
        return new ViewModel(array(
            'slide' => $slide,
        ));

    }

    public function addAction()
    {
        $this->layout('layout/layout-admin');
        $form = new SlideForm('slide', $this->getAdapter());
        $slideTable = new SlideTable($this->getAdapter());
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setInputFilter(new SlideFilter());
            $form->setData($data);
            if ($form->isValid()) {
                return new ViewModel([
                    'form' => $form,
                ]);
            }
            $data = $form->getData();
            $url = "public/img/" . $_FILES['image']['name'];
            $name = time() . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "public/img/" . $name);
            $params = array(
                'description' => $data['description'],
                'image' => $name,
                'link' => $url,
            );
            if (!empty($data['id'])) {
                $slideTable->update(array($params, array(
                    'id' => $data['id'])
                ));
            } else {
                $slideTable->insert($params);
            }
            $this->redirect()->toRoute("admin-slide");
        }
        if (!empty($id = $this->params()->fromRoute('id'))) {
            $slide = $slideTable->getSlideById($id);
            $form->setData(array(
                'id' => $slide->id,
                'image' => $slide->image,
                'description' => $slide->description,
            ));
        }
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    private function getAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }
}

?>