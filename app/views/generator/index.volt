{{content()}}
<div class="container">

{{ form("generator/objednavka") }}
<div class = "row justify-content-around">
  <h2>Volt automatický generátor nabídek</h2>

{{ form.messages() }}
</div>

<fieldset>

<div class="row justify-content-around">
  {% for element in form %}
  <div class = "col-5">
    <div class = "form-group" >
                {{ element.label( ['class': 'control-label']) }}

        <div class = "control" >
        {{ element.render( ['class': 'form-control']) }}
        </div>
    </div>
    </div>
  {% endfor %}
</div>
<div class = "row  justify-content-center" >
<div class = "col-11">
<div class = "control-group" >
    {{ submit_button("Odeslat", "class": "btn btn-primary btn-block") }}
    </div>
</div>
</div>
</fieldset>

</form>
