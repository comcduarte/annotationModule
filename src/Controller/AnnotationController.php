<?php 
namespace Annotation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Annotation\Model\AnnotationModel;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\Sql\Where;
use Annotation\Form\AnnotationForm;
use Midnet\Model\Uuid;
use User\Model\UserModel;

class AnnotationController extends AbstractActionController
{
    use AdapterAwareTrait;
    
    public function indexAction()
    {
        return $this->redirect()->toRoute('home');
    }
    
    public function createAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $annotation = new AnnotationModel($this->adapter);
            $form = new AnnotationForm();
            $form->setData($request->getPost());
            $form->setInputFilter($annotation->getInputFilter());
            
            if ($form->isValid()) {
                $annotation->exchangeArray($form->getData());
                
                $uuid = new Uuid();
                $annotation->UUID = $uuid->value;
                
                $user = new UserModel($this->adapter);
                $user->read(['USERNAME' => $annotation->USER]);
                $annotation->USER = $user->UUID;
                
                $date = new \DateTime('now',new \DateTimeZone('EDT'));
                $today = $date->format('Y-m-d H:i:s');
                $annotation->DATE_CREATED = $today;
                
                $annotation->STATUS = $annotation::ACTIVE_STATUS;
                
                $annotation->create();
            }
            
        }
        $url = $this->getRequest()->getHeader('Referer')->getUri();
        return $this->redirect()->toUrl($url);
    }
    
    public function readAction()
    {
        $annotation = new AnnotationModel($this->adapter);
        $annotations = $annotation->fetchAll(new Where(), ['TABLENAME']);
        
        return ([
            'annotations' => $annotations,
        ]);
    }
}