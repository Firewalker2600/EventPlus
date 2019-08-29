<?php

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends MyForm
{
  public function initialize()
  {
    // Login
    $login = new Text('login');
    $login->setLabel('Login');
    $login->setFilters(['striptags', 'string']);
    $login->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'login'
      ]
    );

    $login->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Jméno je vyžadováno.',
          ]
        ),
      ]
    );
    $this->add($login);

    // Heslo
    $password = new Password('heslo');
    $password->setLabel('Heslo');
    $password->setAttributes(
      [
      'placeholder' => 'heslo',
      'required' => 'required'
      ]
    );
    $password->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Heslo je vyžadováno',
          ]
        ),
      ]
    );
    $this->add($password);
  }

}