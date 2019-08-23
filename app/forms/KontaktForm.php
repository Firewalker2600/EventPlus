<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class KontaktForm extends Form
{
  public function initialize()
  {
    // Jméno
    $jmeno = new Text('jmeno');
    $jmeno->setLabel('Vaše jméno');
    $jmeno->setFilters(['striptags', 'string']);
    $jmeno->setAttributes(['placeholder' => 'Jan']);
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
    $prijmeni->setAttributes(['placeholder' => 'Novák']);
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
    $email->setAttributes(['placeholder' => 'jan.novak@vasemail.cz']);
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
  }
}