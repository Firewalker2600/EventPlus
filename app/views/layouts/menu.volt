<nav class="navbar navbar-expand-lg navbar-light bg-light" style = 'padding: 30px'>
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

           {%- if logged_in is defined and not(logged_in is empty) -%}
          <ul class="navbar-nav ml-auto">
            <li class = "nav-item">{{ link_to('users', 'Users Panel') }}</li>
            <li class = "nav-item">{{ link_to('session/logout', 'Logout') }}</li>
          </ul>
            {% else %}
           {{ form("session/login", 'class':'form-inline')}}
             {{LogForm.render('login', ['class': 'form-control', 'style':'margin: 0px 10px'])}}
             {{LogForm.render('heslo', ['class': 'form-control', 'style':'margin: 0px 10px'])}}
             {{submit_button("Login", "class": "btn")}}
           </form>
            {% endif %}
      </div>
</nav>

<div class="container main-container">
  {{ content() }}
