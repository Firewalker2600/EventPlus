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

class GeneratorForm extends Form
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

    // Program
    $program = new Select(
      'program_akce',
      [
        'TymoveBubnovani' => 'Týmové bubnování',
        'Firewalking' => 'Firewalking',
        'Haka' => 'Haka'
      ]
    );
    $program->setLabel('Program');
    $program->setAttributes(
      [
        'required' => 'required',
        'useEmpty'   => true,
        'emptyText'  => 'Zvolte program',
        'emptyValue' => '',
      ]
    );
    $program->setFilters(['striptags', 'string']);
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
/*  $validator = new Validation();
    $validation->add(
      'budouciDatum',
      new Callback(
        [
          'callback' => function ($data) {
          return $data['budouciDatum'] > date('Y-m-d');
          },
          'message' => 'Zadejte budoucí datum akce'
        ]
      )
    );*/
    $dnesniDatum = date('Y-m-d');
    $datum = new Date('datum_akce');
    $datum->setLabel('Datum akce');
    $datum->setAttributes(
      [
        'value' => $dnesniDatum
      ]
    );
    $datum->addValidators(
      [
        new Validation\Validator\Date(
          [
            'message' => 'Datum není ve správném formátu.',
          ]
        ),
        new Callback(
        [
          'callback' => function ($data) {
            return $data > date('Y-m-d');
            },
          'message' => 'Zadejte budoucí datum akce'
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
        'required' => 'required',
        'placeholder' => '10',
      ]
    );
    $pocetOsob->setFilters('absint');
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
        'required' => 'required',
        'placeholder' => 'Praha',
      ]
    );
    $mistoAkce->setFilters(['striptags','string']);
    $mistoAkce->addValidators(
      [
        new PresenceOf(
          [
            'message' =>'Místo akce je vyžadováno'
          ]
        )
      ]
    );
    $this->add($mistoAkce);
  }
}