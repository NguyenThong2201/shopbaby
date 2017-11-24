<?php

namespace Company\Form\Dashboard;

use Zend\Form\Element\Csrf;
use Zend\Form\Form;

class PostForm extends Form {

	public function __construct($type = "Post") {
		parent::__construct('Post');
		
		if ($type == "Post") {
			$this->add(array (
					'name' => 'post_text',
					'type' => 'Textarea',
					'attributes' => array (
							'required' => 'required',
							'class' => "form-control input-unstyled input-lg autogrow ta-post-text",
							'maxlenght' => 500,
							'placeholder' => "What's on your mind?" 
					) 
			));
			$this->add(array (
					'name' => 'post_to',
					'type' => 'hidden',
					'attributes' => array (
							'class' => 'class-ipt-post-to'
					) 
			));
			
			$this->add(array (
					'name' => 'post_to_user_id',
					'type' => 'hidden',
					'attributes' => array (
							'class' => 'class-ipt-post-to-user-id' 
					) 
			));
		} elseif ($type = 'Comment') {
			$this->add(array (
					'name' => 'post_text',
					'type' => 'Textarea',
					'attributes' => array (
							'ng-model' => 'comment.text',
							'class' => "form-control input-unstyled autogrow",
							'style' => 'height: 76px;',
							'maxlenght' => 500,
							'placeholder' => "Reply" 
					)
					 
			));
		}
		
		$this->add(array (
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'csrf',
				'options' => array (
						'csrf_options' => array (
								'timeout' => 3600 
						) 
				) 
		));
	}
}