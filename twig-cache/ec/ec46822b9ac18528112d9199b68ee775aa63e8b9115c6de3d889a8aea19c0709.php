<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* Category/show.html */
class __TwigTemplate_c3b8b5141a83709c7fda3e07cdd69688bda6671f0cbaf86029e73a43fb5b4192 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
            'naslov' => [$this, 'block_naslov'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "Category/show.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "
<div class=\"row justify-content-around kolona py-5\">
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["booksInCategory"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            echo " 
  <div class=\"col-md-3 px-5 mb-5\">
      <div class=\"card text-center text-white bg-warning\">
          <div class=\"card-header\"><h3>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 9));
            echo "</h3> </div>
          <img id=\"slika-oglas\" src=\"";
            // line 10
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "assets/uploads/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["oglas"] ?? null), "ad_id", [], "any", false, false, false, 10), "html", null, true);
            echo ".jpg\" class=\"card-img-top\" alt=\"...\">
          <div class=\"card-body\">
            <h5 class=\"card-title\"><b class=\"float-left\">ISBN:</b> <b class=\"float-right\"> ";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "isbn", [], "any", false, false, false, 12), "html", null, true);
            echo "</b></h5><br>
            <h5 class=\"card-title\"><b class=\"float-left\">Datum objave:</b> <b class=\"float-right\">";
            // line 13
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "publication_date", [], "any", false, false, false, 13), "j. n. Y."), "html", null, true);
            echo "</b></h5>
         
          </div>
          <div class=\"card-footer\">
              <a href=\"";
            // line 17
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "book/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "book_id", [], "any", false, false, false, 17), "html", null, true);
            echo "\"> <button type=\"button\" class=\"btn btn-success btn-block dugme-oglas\">Vidi knjigu </button></a>
          </div>
        </div>
  </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "</div>

";
    }

    // line 26
    public function block_naslov($context, array $blocks = [])
    {
        // line 27
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 27));
        echo "
";
    }

    public function getTemplateName()
    {
        return "Category/show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 27,  101 => 26,  95 => 22,  82 => 17,  75 => 13,  71 => 12,  64 => 10,  60 => 9,  52 => 6,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Category/show.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Category\\show.html");
    }
}
