{{ content() }}
<div class="container">
<div class = "row justify-content-around">
  <h2>Editace vašich eventů</h2>

{{ form.messages() }}
</div>


<div class="row justify-content-center">
  <div class = "col-4 form-group">
        {{ form("events/save" ~ id) }}
    <fieldset>
        {{ form.label('nazev', ['class': 'control-label']) }}
        {{ form.render('nazev', ['class': 'form-control']) }}
        {{ form.label('fixni_cena', ['class': 'control-label mt-2']) }}
        {{ form.render('fixni_cena', ['class': 'form-control']) }}
        {{ form.label('variabilni_cena', ['class': 'control-label mt-2']) }}
        {{ form.render('variabilni_cena', ['class': 'form-control']) }}
        {{ form.label('doprava', ['class': 'control-label']) }}
        {{ form.render('doprava', ['class': 'form-control']) }}
        {{ submit_button("Uložit", "class": "btn btn-primary btn-block mt-4") }}
    </fieldset>

    </form>
  </div>
  <div class = 'col-4'>
  <ul class="nav flex-column mr-auto">
  {% for key, value in events %}
      {% if key == id %}
        <li class = "nav-item active">
              {{ link_to('events/index/' ~ key, value, 'class':'nav-link') }}
        </li>
      {% else %}
        <li class="nav-item">
        {{ link_to('events/index/' ~ key, value, 'class':'nav-link') }}
        </li>
      {% endif %}
  {% endfor %}
  </ul>
  </div>
</div>
</div>



