<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Callback;
class RegisterForm extends MyForm
{
  public function initialize()
  {
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