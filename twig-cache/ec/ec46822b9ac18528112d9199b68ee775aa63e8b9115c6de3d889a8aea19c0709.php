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
        echo "    <h1>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 4));
        echo "</h1>
    <p> Spisak knjiga u ovoj kategoriji: </p>
    <ul>
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["booksInCategory"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            // line 8
            echo "        <li> <a href=\"";
            echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
            echo "book/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "book_id", [], "any", false, false, false, 8), "html", null, true);
            echo "\">
            ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 9));
            echo "</a><br>
            ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "description", [], "any", false, false, false, 10));
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    </ul>

";
    }

    // line 16
    public function block_naslov($context, array $blocks = [])
    {
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 17));
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
        return array (  87 => 17,  84 => 16,  78 => 12,  70 => 10,  66 => 9,  59 => 8,  55 => 7,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Category/show.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Category\\show.html");
    }
}
