<?php 
namespace Annotation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Annotation\Model\AnnotationModel;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\Sql\Where;

class AnnotationController extends AbstractActionController
{
    use AdapterAwareTrait;
    
    public function readAction()
    {
        $annotation = new AnnotationModel($this->adapter);
        $annotations = $annotation->fetchAll(new Where(), ['TABLENAME']);
        
        return ([
            'annotations' => $annotations,
        ]);
    }
}