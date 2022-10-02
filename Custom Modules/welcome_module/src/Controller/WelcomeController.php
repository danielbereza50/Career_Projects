<?php

namespace Drupal\welcome_module\Controller;
use Drupal\Core\Render\Markup;

class WelcomeController {
  public function welcome() {
   
    $header = [
      'col1' => t('COL1'),
      'col2' => t('COL2'),
    ];
  
    $rows = [
  	  [['data' => 'Welcome', 'class' => 'test-col-1'],'User'],
  	  [['data' => 'Welcome', 'class' => 'test-col-2'],'User'],
  	  [['data' => 'Welcome', 'class' => 'test-col-3'],'User'],
	  ];

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

  }
}