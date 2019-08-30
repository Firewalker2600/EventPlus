<?php

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class LoginForm extends MyForm
{
  public function initialize()
  {
    // Login
    $email = new Text('email');
    $email->setLabel('Email');
    $email->setFilters(['striptags', 'string']);
    $email->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'email'
      ]
    );

    $email->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'email je vyžadován.',
          ]
        ),
        new Email(
          [
            'message' =>'email není platný',
          ]
        )
       ]
    );
    $this->add($email);

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