<div class = "container" style="margin: 15px" >
  {{ form("nabidka/list") }}

  <fieldset>
  <div class = "row justify-content-end" >

    <div class = "form-group col">
      {{ flashSession.output()}}
    </div>

    <div class="form-group col-2">
      {{ form.render('id', ['class': 'form-control']) }}
    </div>

    <div class="form-group col-3">
      {{ submit_button('Vyhledej nabídku', 'class': 'btn btn-primary') }}
    </div>

  </div>

  </fieldset>

  </form>

</div>
{{ content () }}

