<nav class="navbar navbar-expand-lg navbar-light bg-light">
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

          <ul class="navbar-nav ml-auto">
            {%- if logged_in is defined and not(logged_in is empty) -%}
            <li class = "nav-item">{{ link_to('users', 'Users Panel') }}</li>
            <li class = "nav-item">{{ link_to('session/logout', 'Logout') }}</li>
            {% else %}
            <li class = "nav-item">{{ link_to('session/login', 'Login') }}</li>
            {% endif %}
          </ul>
      </div>
</nav>

<div class="container main-container">
  {{ content() }}
