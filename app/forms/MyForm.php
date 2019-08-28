<?php
use Phalcon\Forms\Form;

class MyForm extends Form
{
  public function message($name)
  {
    if ($this->hasMessagesFor($name)) {
      foreach ($this->getMessagesFor($name) as $message) {
        $this->flashSession->error($message);
      }
    }
  }

  public function messages()
  {
    foreach ($this->getMessages() as $field => $message) {
      $this->flashSession->error($message);
    }
  }
}