{{ content() }}
<div class="container">

{{ form("users/register") }}
<div class = "row justify-content-around">
  <h2>Registrace nového uživatele</h2>

{{ form.messages() }}
</div>

<fieldset>

<div class="row justify-content-around">
  <div class = "col-5 form-group">
        {{ form.label('jmeno', ['class': 'control-label']) }}
        {{ form.render('jmeno', ['class': 'form-control']) }}
        {{ form.label('prijmeni', ['class': 'control-label mt-2']) }}
        {{ form.render('prijmeni', ['class': 'form-control']) }}
        {{ form.label('spolecnost', ['class': 'control-label mt-2']) }}
        {{ form.render('spolecnost', ['class': 'form-control']) }}
  </div>
  <div class = "col-5 form-group">
        {{ form.label('email', ['class': 'control-label']) }}
        {{ form.render('email', ['class': 'form-control']) }}
        {{ form.label('heslo', ['class': 'control-label mt-2']) }}
        {{ form.render('heslo', ['class': 'form-control']) }}
        {{ form.label('passCheck', ['class': 'control-label mt-2']) }}
        {{ form.render('passCheck', ['class': 'form-control']) }}
  </div>
</div>

<div class = "row  justify-content-center" >
  <div class = "col-11 control-group">
    {{ submit_button("Zaregistrovat se", "class": "btn btn-primary btn-block mt-2") }}
  </div>
</div>
</fieldset>

</form>
</div>
