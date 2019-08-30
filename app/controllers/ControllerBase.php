<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
  protected function initialize()
  {
    $this->view->LogForm = new LoginForm();
    $this->view->setTemplateAfter('menu');

    $this->tag->prependTitle('Objednavka | ');
  }
}
