{{ content() }}
<div class="container">

{{ form("users/index") }}
<div class = "row justify-content-around">
  <h2>Editace profilu</h2>

{{ form.messages() }}
</div>

<fieldset>

<div class="row justify-content-around">
  <div class = "col-5 form-group">
        {{ form.label('jmeno', ['class': 'control-label']) }}
        {{ form.render('jmeno', ['class': 'form-control']) }}
        {{ form.label('prijmeni', ['class': 'control-label mt-2']) }}
        {{ form.render('prijmeni', ['class': 'form-control']) }}
  </div>
  <div class = "col-5 form-group">
        {{ form.label('email', ['class': 'control-label']) }}
        {{ form.render('email', ['class': 'form-control']) }}
        {{ form.label('spolecnost', ['class': 'control-label mt-2']) }}
        {{ form.render('spolecnost', ['class': 'form-control']) }}
  </div>
</div>

<div class = "row  justify-content-center" >
  <div class = "col-11 control-group">
    {{ submit_button("Uložit", "class": "btn btn-primary btn-block my-2 ") }}
    {{ flashSession.output()}}
  </div>
</div>
</fieldset>

</form>
</div>
