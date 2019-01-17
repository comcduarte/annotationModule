<?php 
namespace Annotation\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Hidden;

class AnnotationForm extends Form
{
    public $user;
    public $tablename;
    public $prikey;
    
    public function initialize()
    {
        $this->add([
            'name' => 'TABLENAME',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'TABLENAME',
                'value' => $this->tablename,
            ],
        ]);
        
        $this->add([
            'name' => 'PRIKEY',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'PRIKEY',
                'value' => $this->prikey,
            ],
        ]);
        
        $this->add([
            'name' => 'USER',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'USER',
                'value' => $this->user,
            ],
        ]);
        
        $this->add([
            'name' => 'ANNOTATION',
            'type' => Textarea::class,
            'attributes' => [
                'id' => 'ANNOTATION',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Annotation',
            ],
        ]);
        
        $this->add(new Csrf('SECURITY'));
        
        $this->add([
            'name' => 'SUBMIT',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
                'id' => 'SUBMIT',
            ],
        ]);
    }
}