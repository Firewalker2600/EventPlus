<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
  protected function initialize()
  {
    $this->view->LogForm = new LoginForm();
    $this->view->setTemplateAfter('menu');
    $this->assets->addCss('css/all.css');
    $this->assets->addJs('js/all.js');
    $this->tag->prependTitle('Event + | ');
  }
}
