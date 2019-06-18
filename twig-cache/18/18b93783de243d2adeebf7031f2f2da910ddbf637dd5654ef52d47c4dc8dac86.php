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

/* Book/show.html */
class __TwigTemplate_5b13fb4c6a1506e238ef50ba5ca9550cd0a2cc93747a6532aedd96254d0ff547 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "Book/show.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "    <h1>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["book"] ?? null), "title", [], "any", false, false, false, 4));
        echo "</h1>
    <p> ";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["book"] ?? null), "description", [], "any", false, false, false, 5), "html", null, true);
        echo " </p>
    <p> ISBN: ";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["book"] ?? null), "isbn", [], "any", false, false, false, 6), "html", null, true);
        echo " </p>
    <p> Datum objavljivanja: ";
        // line 7
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["book"] ?? null), "publication_date", [], "any", false, false, false, 7), "j. n. Y."), "html", null, true);
        echo " </p>
    
";
    }

    // line 11
    public function block_naslov($context, array $blocks = [])
    {
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 12));
        echo "
";
    }

    public function getTemplateName()
    {
        return "Book/show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 12,  68 => 11,  61 => 7,  57 => 6,  53 => 5,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Book/show.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Book\\show.html");
    }
}
