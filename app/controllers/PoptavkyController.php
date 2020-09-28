<?php

class PoptavkyController extends ControllerBase
{
  public function initialize() {
    parent::initialize();
    $this->view->setTemplateBefore('tab');
  }

  public function indexAction($idEventu = null) {
    $this->view->id = $idEventu;
    $this->view->events = Eventy::find(['order' => 'id']);
    if(!isset($idEventu)) {
      $this->view->poptavky = Poptavka::find();
    } else {
      $this->view->poptavky = Poptavka::find("program_akce = $idEventu");
    }
  }
}