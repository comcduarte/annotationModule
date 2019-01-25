<?php 
namespace Annotation\View\Helper;

use Annotation\Form\AnnotationForm;
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
        $result .= $this->renderAddAnnotationForm();
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
        $result .= '</div>';
        
        return $result;
    }
    
    public function renderItem($user, $note, $date)
    {
        $result = sprintf('<tr class="d-flex"><td class="col-2">%s</td><td class="col-8">%s</td><td class="col-2">%s</td></tr>',$user, $note, $date);
        
        return $result;
    }
    
    public function renderAddAnnotationForm()
    {
        ?>
        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
        	aria-labelledby="myModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        		<?php 
        		$form = new AnnotationForm();
        		$form->prikey = $this->view->annotations_prikey;
        		$form->tablename = $this->view->annotations_tablename;
        		$form->user = $this->view->identity();
        		$form->initialize();
        		
        		$form->setAttribute('action', $this->view->url('annotation/annotation', ['action' => 'create']));
        		$form->prepare();
        		
        		echo $this->view->form()->openTag($form);
        		echo $this->view->formCollection($form);
        		echo $this->view->form()->closeTag($form);
        		?>
        		
        		
        		<!-- 
        			<div class="modal-header text-center">
        				<h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        				<button type="button" class="close" data-dismiss="modal"
        					aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<div class="modal-body mx-3">
        				<div class="md-form mb-5">
        					<i class="fas fa-envelope prefix grey-text"></i> <input
        						type="email" id="defaultForm-email" class="form-control validate">
        					<label data-error="wrong" data-success="right"
        						for="defaultForm-email">Your email</label>
        				</div>
        
        				<div class="md-form mb-4">
        					<i class="fas fa-lock prefix grey-text"></i> <input type="password"
        						id="defaultForm-pass" class="form-control validate"> <label
        						data-error="wrong" data-success="right" for="defaultForm-pass">Your
        						password</label>
        				</div>
        
        			</div>
        			<div class="modal-footer d-flex justify-content-center">
        				<button class="btn btn-default">Login</button>
        			</div>
        			 -->
        		</div>
        	</div>
        </div>
        
    	<a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Add Annotation</a>
		<?php 
    }
}