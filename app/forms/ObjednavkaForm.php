<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Numericality;


class ObjednavkaForm extends Form
{
  public function initialize()
  {
   // Program
    $program = new Select('program_akce', ['Týmové bubnování','Firewalking', 'Haka']);
    $program->setLabel('Program');
    $program->setAttributes(
      [
      //'using' => ['Týmové bubnování','Firewalking', 'Haka'],
      'useEmpty'   => true,
      'emptyText'  => 'Zvolte program',
      'emptyValue' => '',
        ]
    );
    $program->addValidators(
      [
        new PresenceOf(
          [
            'message' => 'Zvolte program, o který máte zájem.',
          ]
        ),
      ]
    );
    $this->add($program);

    //Datum akce
    $datum = new Date('datum_akce');
    $datum->setLabel('Datum akce');
    $datum->setAttributes(
      [
        'value' => date('Y-m-d')
      ]
    );
    $datum->addValidators(
      [
        /*new DateValidation(
          [
            'message' => 'Zadejte datum akce.',
          ]
        ),*/
        new Validation\Validator\Date(
          [
            'message' => 'Datum není ve správném formátu.',
          ]
        )
      ]
    );
    $this->add($datum);

    // Pocet osob
    $pocetOsob = new Numeric('pocet_osob');
    $pocetOsob->setLabel('Počet osob');
    $pocetOsob->setAttributes(
      [
        'placeholder' => '10',
      ]
    );
    $pocetOsob->addValidators(
      [
        new Numericality(
          [
            'message' => 'Počet osob není platné číslo',
          ]
        )
      ]
    );
    $this->add($pocetOsob);

    // Místo akce
    $mistoAkce = new Text('misto_akce');
    $mistoAkce->setLabel('Místo akce');
    $mistoAkce->setAttributes(
      [
        'placeholder' => 'Praha',
      ]
    );
    $this->add($mistoAkce);

  }
}