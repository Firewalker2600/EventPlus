{{ content() }}

<div class="container">
  <div class = "row justify-content-center">
    <h2>Přehled vašich poptávek</h2>
  </div>

  <div class="row">
    <div class = "col-12">
      <table class = 'table'>
        <th>id</th>
        <th>jméno</th>
        <th>příjmení</th>
        <th>email</th>
        <th>společnost</th>
        <th>datum akce</th>
        <th>počet osob</th>
        <th>event</th>
        <th>místo akce</th>
        <th>cena</th>
        {% for poptavka in poptavky %}
          <tr>
          <td>{{poptavka.id}}</td>
          <td>{{poptavka.jmeno}}</td>
          <td>{{poptavka.prijmeni}}</td>
          <td>{{poptavka.email}}</td>
          <td>{{poptavka.spolecnost}}</td>
          <td>{{poptavka.datum_akce}}</td>
          <td>{{poptavka.pocet_osob}}</td>
          <td>{{poptavka.eventy.nazev}}</td>
          <td>{{poptavka.misto_akce}}</td>
          <td>{{poptavka.cena}}</td>
          </tr>
        {% endfor %}
      </table>
    </div>
    <div class = 'col-4'>
      <ul class="nav flex-column mr-auto">
      {% for event in events %}
          {% if event.id == id %}
            <li class = "nav-item active">
          {% else %}
            <li class="nav-item">
          {% endif %}
            {{ link_to('poptavky/index/' ~ event.id, event.nazev, 'class':'nav-link') }}
            </li>
      {% endfor %}
      </ul>
    </div>
  </div>

  <div class = 'row justify-content-center mt-4'>
      <div class = 'col-10'>
          {{ flashSession.output()}}
      </div>
  </div>
</div>



