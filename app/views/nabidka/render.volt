{{ assets.outputCss() }}
{{ content() }}
<div class = "container" style = "margin: 15px">
  <div class = "row">
    <div class = "col-3 penize">
    </div>
    <div class = "col">
      <div class = "container" style = "margin: 150px 0px 0px 0px">
        <div class = "row justify-content-around" >
          <div class = "col">
            <h1 class = "prezentace" >Kalkulace</h1>
          </div>
        </div>
        <div class = "row justify-content-around" >
          <div class = "col" ><p class = "prezentace">{{poptavka.Eventy.nazev}} pro {{poptavka.pocet_osob}}. os.</p></div>
          <div class = "col" ><p class = "prezentace">{{poptavka.cena}} Kč</p></div>
        </div>
        <div class = "row justify-content-around" >
          <div class = "col" ><p class = "prezentace"> doprava</p></div>
          <div class = "col" ><p class = "prezentace">{{poptavka.Eventy.doprava}} Kč/km</p></div>
        </div>
      </div>
    </div>
</div>