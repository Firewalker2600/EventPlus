<div class="formular">
  {{ form("nabidka/forward") }}
  <fieldset>
    <div class="form-group">
      {{ form.label('id') }}
      {{ form.render('id', ['class': 'form-control']) }}
    </div>
    <div class="form-group">
      {{ submit_button('Vyhledej nabídku', 'class': 'btn btn-primary btn-large') }}
    </div>
  </fieldset>
  </form>
</div>
{{ content() }}