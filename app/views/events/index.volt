{{ content() }}

<!-- Modal -->
<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Potvrzení</h5>
        {{ link_to('#', '&times;', "class" : "close", "data-dismiss":"modal")}}
      </div>
      <div class="modal-body">
        <p class = "text-center">Opravdu chcete vymazat event <u>{{ events[id]}}</u> z databáze?</p>
      </div>
      <div class="modal-footer">
        {{ link_to('#', 'Zpět', "class" : "btn btn-secondary", "data-dismiss":"modal" )}}
        {{ link_to(
           'events/delete/' ~ id
          ,'<i class="far fa-trash-alt"></i> Vymazat'
          ,'class':"btn btn-primary btn-warning"
          )}}
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class = "row justify-content-around">
      <h2>Editace vašich eventů</h2>

    {{ form.messages() }}
    </div>

    <div class="row justify-content-center">
      <div class = "col-4 form-group">
            {{ form("events/save/" ~ id) }}
        <fieldset>
            {{ form.label('nazev', ['class': 'control-label']) }}
            {{ form.render('nazev', ['class': 'form-control']) }}
            {{ form.label('fixni_cena', ['class': 'control-label mt-2']) }}
            {{ form.render('fixni_cena', ['class': 'form-control']) }}
            {{ form.label('variabilni_cena', ['class': 'control-label mt-2']) }}
            {{ form.render('variabilni_cena', ['class': 'form-control']) }}
            {{ form.label('doprava', ['class': 'control-label']) }}
            {{ form.render('doprava', ['class': 'form-control']) }}
        </fieldset>

      </div>
      <div class = 'col-4'>
      <ul class="nav flex-column mr-auto">
      {% for key, value in events %}
          {% if key == id %}
            <li class = "nav-item active">
          {% else %}
            <li class="nav-item">
          {% endif %}
            {{ link_to('events/index/' ~ key, value, 'class':'nav-link') }}
            </li>
      {% endfor %}
      </ul>
      </div>
    </div>
    <div class = 'row justify-content-center'>
        <div class = "col-4">
                {{ submit_button('Uložit', "class": "btn btn-primary btn-block mt-4") }}
            </form>
        </div>
        <div class = "col-3">
                {% if id is defined %}
                {{ link_to("#",'<i class="far fa-trash-alt"></i> Vymazat'
                , "class": "btn btn-block btn-warning mt-4"
                , "data-toggle" : "modal"
                , "data-target":"#deleteConfirm") }}
                {% endif %}
        </div>
        <div class = 'col-1'>
        </div>
    </div>
    <div class = 'row justify-content-center mt-4'>
        <div class = 'col-7'>
            {{ flashSession.output()}}
        </div>
        <div class = 'col-1'>
        </div>
    </div>
</div>



