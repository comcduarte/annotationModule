<?php 
namespace Annotation\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Annotations extends AbstractHelper
{
    public $annotations;
    
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;
        return $this;
    }
    
    public function render()
    {
        $result  = '<h3>Annotations</h3>';
        $result .= '<table class="table table-sm table-striped">';
        $result .= '<thead>';
        $result .= '<tr class="d-flex"><th class="col-2">User</th><th class="col-8">Annotation</th><th class="col-2">Date Created</th></tr>';
        $result .= '</thead>';
        $result .= '<tbody>';
        
        foreach ($this->annotations as $annotation) {
            
            $result .= $this->renderItem($annotation['USER'], $annotation['ANNOTATION'], $annotation['DATE_CREATED']);
        }
        
        
        $result .= '</tbody>';
        $result .= '</table>';
        
        return $result;
    }
    
    public function renderItem($user, $note, $date)
    {
        $result = sprintf('<tr class="d-flex"><td class="col-2">%s</td><td class="col-8">%s</td><td class="col-2">%s</td></tr>',$user, $note, $date);
        
        return $result;
    }
}