<?php
class GeneratorController extends ControllerBase
{

  public function indexAction()
  {
   $this->view->generatorForm = new GeneratorForm();
   }

  public function objednavkaAction()
  {
//    $objednavka = new Objednavka();

    // Test jestli jsou data zaslaná skrze POST
    if ($this->request->isPost() != true) {
      return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action"     => "index",
        ]
      );
    }
    // Validace formuláře
    $form = new GeneratorForm();
    $poptavka = new Poptavka();
    $data = $this->request->getPost();
    if(!$form->isValid($data, $poptavka)) {
      foreach($form->getMessages() as $message){
        $this->flash->error($message);
      }

     return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action" => "index",
        ]
      );
    }

    //kontrola duplicit v Databázi
    $vypis = Poptavka::findFirst(
      [
        'conditions' =>
              'jmeno        = :Jmeno:
           AND prijmeni     = :Prijmeni:
           AND email        = :Email:
           AND spolecnost   = :Spolecnost:
           AND datum_akce   = :DatumAkce:
           AND pocet_osob   = :PocetOsob:
           AND program_akce = :ProgramAkce:
           AND misto_akce   = :MistoAkce:',
        'bind' =>
          [
            'Jmeno'        => $data['jmeno'],
            'Prijmeni'     => $data['prijmeni'],
            'Email'        => $data['email'],
            'Spolecnost'   => $data['spolecnost'],
            'DatumAkce'   => $data['datum_akce'],
            'ProgramAkce' => $data['program_akce'],
            'PocetOsob'   => $data['pocet_osob'],
            'MistoAkce'   => $data['misto_akce'],
          ]
        ]
    );
    if (!empty($vypis)){
      $message = 'Zadaná poptávka je již v systému uložena';
      $this->flash->error($message);

      return $this->dispatcher->forward(
        [
          "controller" => "index",
          "action" => "index",
        ]
      );
    }



    //uložení do databáze - kontrola
    if ($poptavka->save() == false) {
      foreach ($poptavka->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action"     => "index",
        ]
      );
    }
    //Uložení se podařilo
    $this->flash->success(
      'Děkujeme za vaší poptávku. Do 24 hodin vám přijde na email naše nabídka.'
    );

    return $this->dispatcher->forward(
      [
        "controller" => "index",
        "action"     => "index",
      ]
    );

/*
    $jmeno = $this->request->getPost('jmeno');
    $prijmeni = $this->request->getPost('prijmeni');
    $email = $this->request->getPost('email');
    $nazevSpolecnosti = $this->request->getPost('nazev_spolecnosti');
    $programAkce = $this->request->getPost('program_akce');
    $mistoAkce = $this->request->getPost('misto_akce');
    $pocetOsob = $this->request->getPost('pocet_osob');
    $datumAkce = $this->request->getPost('datum_akce');

    $spolecnost = new Spolecnost();
    $spolecnost->nazev_spolecnosti = $nazevSpolecnosti;

    //je název společnosti prázdný řetězec?
    if (empty($spolecnost->nazev_spolecnosti)) {
      $spolecnost->id = null;}
    else {

      //je již společnost v databázi?
      $vypis = Spolecnost::findFirst(
      [
        'conditions' => 'nazev_spolecnosti = :nazev:',
        'bind' => ['nazev' => $spolecnost->nazev_spolecnosti]
      ]
      );
      if (!empty($vypis)) {
        $spolecnost->id = $vypis->id;
       $message = 'Společnost '. $spolecnost->nazev_spolecnosti . ' již existuje.
       <br> ID Spolecnosti je ' . $spolecnost->id;
        $this->flash->warning($message);
      }
      else {
      //Zápis do databáze
        if($spolecnost->save()) {
          $message = 'Společnost ' . $spolecnost->nazev_spolecnosti .
            'byla vložena do databáze.</br>ID Spolecnosti je '. $spolecnost->id;
          $this->flash->success($message);
        }
        else {
          $message = 'Společnost' . $spolecnost->nazev_spolecnosti .
             'se nepodařilo uložit s následující chybou:';
          $this->flash->error($message);
          $messages = $spolecnost->getMessages();
          foreach($messages as $message){
              $this->flash->error($message);
          }
          return $this->dispatcher->forward(
            [
              "controller" => "generator",
              "action" => "index",
            ]
          );
          }
        }
      }

    // Kontakt
    $kontakt = new Kontakt;
    $kontakt->assign(
      [
        'jmeno'    => $jmeno,
        'prijmeni' => $prijmeni,
        'email'    => $email,
        'id_spolecnosti' => $spolecnost->id,
      ]
    );

    //je již uživatel v databázi?
    $vypis = Kontakt::findFirst(
      [
        'conditions' =>
          'jmeno = :Jmeno:
           AND prijmeni = :Prijmeni:
           AND email = :Email:',
        'bind' =>
          [
          'Jmeno'    => $kontakt->jmeno,
          'Prijmeni' => $kontakt->prijmeni,
          'Email'    => $kontakt->email,
        ]
      ]
    );
    if(!empty($vypis)){
      // je vyplněno ID Společnosti ve
      $kontakt->id = $vypis->id;

      echo '</br>Uživatel č. ' . $kontakt->id .' '. $kontakt->jmeno .' '. $kontakt->prijmeni . ' s emailem '
        . $kontakt->email . ' ze spolecnosti č. ' . $kontakt->id_spolecnosti
        . ' již je v databázi uložen.';
    }
    else {
      if($kontakt->save()) {
              echo "</br>Nový uživatel je vytvořen v databázi. </br> ID Uživatele je ";
 //             . $kontakt->id;
      }
      else {
        echo "</br>Záznam Kontakt se nepodařilo uložit s následující chybou:</br>";
        $messages = $kontakt->getMessages();
        foreach ($messages as $message) {
          echo $message->getMessage(), "</br>";
        }
      }
    }

    // Objednavka
    //je datum akce starší než dnešní den?
    $objednavka = new Objednavka;
    $objednavka->assign(
      [
        'program_akce' => $programAkce,
        'misto_akce' => $mistoAkce,
        'pocet_osob' => $pocetOsob,
        'datum_akce' => $datumAkce,
      ]
    );
      $objednavka->id_spolecnost = $spolecnost->id;
      $objednavka->id_kontakt = $kontakt->id;

      if ($objednavka->save()) {
        echo '</br>Nová objednávka č.'
          . $objednavka->id
          . 'je vytvořena v databázi. </br>';
      }
      else {
        echo '</br>Novou objednávku se nepodařilo uložit s následující chybou:</br>';
        $messages = $objednavka->getMessages();
        foreach ($messages as $message) {
          echo $message->getMessage(), '</br>';
        }
      }*/


  }
}


