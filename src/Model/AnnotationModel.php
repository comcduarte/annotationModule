<?php 
namespace Annotation\Model;

use Midnet\Model\DatabaseObject;

class AnnotationModel extends DatabaseObject
{
    public $UUID;
    public $TABLENAME;
    public $PRIKEY;
    public $USER;
    public $STATUS;
    public $DATE_CREATED;
    public $DATE_MODIFIED;
    public $ANNOTATION;
    
    public function __construct($dbAdapter = null)
    {
        parent::__construct($dbAdapter);
        
        $this->primary_key = 'UUID';
        $this->table = 'annotations';
    }
}