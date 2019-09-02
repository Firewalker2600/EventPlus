          <ul class="nav nav-tabs mr-auto">

            {%- set tabs = [
              'Profil': 'index',
              'Eventy': 'events',
              'Poptávky': 'poptavky'
            ] -%}

            {%- for key, value in tabs %}
              {% if value == dispatcher.getControllerName() %}
              <li class="nav-item active">{{ link_to(value, key, 'class':'nav-link') }}</li>
              {% else %}
              <li class = "nav-item">{{ link_to(value, key, 'class':'nav-link') }}</li>
              {% endif %}
            {%- endfor -%}

          </ul>
<div class="container main-container">
  {{ content() }}
