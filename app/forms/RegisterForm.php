<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;

class RegisterForm extends MyForm
{
  public function initialize()
  {
    // Email
    $email = new Text('email');
    $email->setLabel('E-Mail');
    $email->setFilters('email');
    $email->setAttributes(
      [
        'required' => 'required',
        'type' => 'email',
        'placeholder' => 'jan.novak@vasemail.cz'
      ]
    );
    $email->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'E-mail je vyžadován',
          ]
        ),
        new Email(
          [
            'message' => 'E-mail není platný',
          ]
        ),
      ]
    );
    $this->add($email);

    // Jméno
    $jmeno = new Text('jmeno');
    $jmeno->setLabel('Vaše jméno');
    $jmeno->setFilters(['striptags', 'string']);
    $jmeno->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'Jan'
      ]
    );
    $jmeno->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Jméno je vyžadováno.',
          ]
        ),
      ]
    );
    $this->add($jmeno);

    $pass = new Password('heslo');
    $pass->setLabel('Heslo');
    $pass->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'alespoň 8 znaků'
      ]
    );
    $pass->addValidators(
      [
      new PresenceOf(
        [
          'message' => 'Heslo je povinné'
        ]
      ),
         new StringLength([
           'min' => 8,
           'messageMinimum' => 'Heslo je příliš krátké. Minimum je 8 znaků'
         ]),
            new Confirmation([
              'message' => 'Hesla se neshodují',
              'with' => 'passCheck'
            ])
      ]
    );
    $this->add($pass);

    // Příjmení
    $prijmeni = new Text('prijmeni');
    $prijmeni->setLabel('Vaše příjmení');
    $prijmeni->setFilters(['striptags', 'string']);
    $prijmeni->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'Novák'
      ]
    );
    $prijmeni->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Příjmení je vyžadováno.',
          ]
        ),
      ]
    );
    $this->add($prijmeni);

    $passCheck = new Password('passCheck');
    $passCheck->setLabel('Ověření hesla');
    $passCheck->setAttributes(
      [
        'required' => 'required',
        'placeholder' => 'alespoň 8 znaků'
      ]
    );
    $passCheck->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Ověřte prosím své heslo'
          ]
        )
      ]
    );
    $this->add($passCheck);

    $spolecnost = new Text('spolecnost');
    $spolecnost->setLabel('Společnost');
    $spolecnost->setFilters(['striptags', 'string']);
    $spolecnost->setAttributes(
      [
        'required' => 'required',
        'placeholder'=> 'Vaše Firma s.r.o.'
      ]
    );
    $spolecnost->addValidator(
      new PresenceOf(
        [
          'message'=>'Název společnosti je vyžadován'
        ]
      )
    );
    $this->add($spolecnost);
  }
}