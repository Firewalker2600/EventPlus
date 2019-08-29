<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
  protected function initialize()
  {
    $this->tag->prependTitle('Objednavka | ');

    $this->view->setTemplateAfter('menu');
  }
}
