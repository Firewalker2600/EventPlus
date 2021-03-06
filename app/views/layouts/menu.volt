<nav
  class="navbar navbar-expand-lg navbar-light bg-light"
  style = 'padding: 5px 15px 10px; border-radius: 15px'
>
  {{ link_to(null, 'class': 'brand', 'Objednávka')}}
  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      {%- set menus = [
        'Domů': 'index',
        'Generátor': 'generator',
        'O Projektu': 'projekt'
      ] -%}

      {%- for key, value in menus %}
        {% if value == dispatcher.getControllerName() %}
          <li class="nav-item active">{{ link_to(value, key, 'class':'nav-link') }}</li>
        {% else %}
          <li class = "nav-item">{{ link_to(value, key, 'class':'nav-link') }}</li>
        {% endif %}
      {%- endfor -%}
    </ul>

    {%- if session.has('auth') -%}
      <ul class="navbar-nav ml-auto">
        <li class = "nav-item">{{ link_to('users', 'Administrace', 'class':'nav-link') }}</li>
        <li class = "nav-item">{{ link_to('session/logout', 'Logout', 'class':'nav-link') }}</li>
      </ul>
    {% else %}
      {{ form('session/login', 'class':'form-inline')}}
        <table style = 'margin: 15px 0px 0px 0px'>
          <tr>
            <td>
              {{LogForm.render('email', ['class': 'form-control'])}}
            </td>
            <td>
              {{LogForm.render('heslo', ['class': 'form-control'])}}
            </td>
            <td>
             {{submit_button("Login", "class": "btn")}}
            </td>
          </tr>
          <tr>
            <td>
              &nbsp{{link_to('users/form', 'Registrace')}}
            </td>
            <td>
              &nbsp{{link_to('users/renew', 'Zapoměli jste heslo?')}}
            </td>
            <td>
            </td>
          </tr>
        </table>
      </form>
    {% endif %}
  </div>
</nav>

<div class="container main-container">
  {{ content() }}
