{% extends "_global/index.html" %}

{% block main %}
<a href="{{ BASE }}user/categories">
    List all categories
</a>

<p>{{ message|escape }}</p>

{% endblock %}

{% block naslov %}
Izmena kategorije
{% endblock %}
{% block dash %} <a class="pl-4 beli-tekst" href="{{ BASE }}librarian/dashboard"> Dashboard </a>  {% endblock %}
