<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;

class EventForm extends MyForm
{
  public function initialize()
  {
    {
      // Id poptavky
      $nazev = new Text('nazev',
        [
          'placeholder' => 'Váš event'
        ]
      );
      $nazev->setLabel('Název eventového programu');
      $nazev->setFilters(['striptags', 'string']);
      $nazev->setAttributes(
        [
          'required' =>'required',
        ]
      );
      $nazev->addValidators(
        [
          new PresenceOf(
            [
              'message' => 'Zadejte název programu',
            ]
          )
        ]
      );
      $this->add($nazev);

      $fixni_cena = new Numeric('fixni_cena',
        [
          'placeholder' => '10000'
        ]
      );
      $fixni_cena->setLabel('Fixní část ceny programu');
      $fixni_cena->setFilters('absint');
      $fixni_cena->setAttributes(
        [
          'required' =>'required',
        ]
      );
      $fixni_cena->addValidators(
        [
          new PresenceOf(
            [
              'message' => 'Zadejte fixní část ceny programu',
            ]
          )
        ]
      );
      $this->add($fixni_cena);

      $variabilni_cena = new Numeric('variabilni_cena',
        [
          'placeholder' => '100'
        ]
      );
      $variabilni_cena->setLabel('Navýšení ceny za osobu');
      $variabilni_cena->setFilters('absint');
      $variabilni_cena->setAttributes(
        [
          'required' =>'required',
        ]
      );
      $variabilni_cena->addValidators(
        [
          new PresenceOf(
            [
              'message' => 'Zadejte variabilní část ceny programu',
            ]
          )
        ]
      );
      $this->add($variabilni_cena);

      $doprava = new Numeric('doprava',
        [
          'placeholder' => '100'
        ]
      );
      $doprava->setLabel('Cena dopravy za Km');
      $doprava->setFilters('absint');
      $doprava->setAttributes(
        [
          'required' =>'required',
        ]
      );
      $doprava->addValidators(
        [
          new PresenceOf(
            [
              'message' => 'Zadejte cenu dopravy za Km',
            ]
          )
        ]
      );
      $this->add($doprava);

    }
  }
}