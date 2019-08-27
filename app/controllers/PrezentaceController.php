<?php
class PrezentaceController extends ControllerBase
{
  public function indexAction()
  {
    return $this->dispatcher->forward(
      [
        "controller" => "prezentace",
        "action"     => "bubnovani",
      ]
    );
  }

  public function bubnovaniAction()
  {
    $this->assets->addCss('css/bubnovani.css');
  }
}


