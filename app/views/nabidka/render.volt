{{ content() }}
<div class = "container" >
  <div class = "row justify-content-around" >
    <div class = "col">
      <h1>Nabídka pro společnost {{poptavka.spolecnost}}</h1>
    </div>
  </div>
  <div class = "row justify-content-around" >
    <div class = "col" >Program</div>
    <div class = "col" > {{poptavka.Eventy.nazev}}</div>
  </div>
  <div class = "row justify-content-around" >
    <div class = "col" >počet osob</div>
    <div class = "col" > {{poptavka.pocet_osob}}</div>
  </div>
  <div class = "row justify-content-around" >
    <div class = "col" >cena</div>
    <div class = "col" >{{poptavka.cena}} Kč</div>
   </div>
  <div class = "row justify-content-around" >
    <div class = "col" > doprava</div>
    <div class = "col" >{{poptavka.Eventy.doprava}} Kč/km</div>
  </div>
</div>