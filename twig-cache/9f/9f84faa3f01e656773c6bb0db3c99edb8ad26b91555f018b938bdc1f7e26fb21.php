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

/* LibrarianDashboard/index.html */
class __TwigTemplate_3eabcff030e7a2ff1484bf7424b1df13c5ac7e29e5f02925a2cdbbc9bf050bba extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
            'welcome' => [$this, 'block_welcome'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "LibrarianDashboard/index.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "    <div class=\"glavniji-div\">
            <div class=\"container\">
                    <div class=\"row text-center\">
                        <div class=\"col-md-12 my-4 naslov\">
                              <h1>Opcije dostupne bibliotekarima</h1>
                        </div>
                    </div>  
                        <div class=\"row dashboard text-center mb-5\">
                            <div class=\"col mx-1 box dugme border border-success\">
                                <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/categories/\" 
                                class=\"btn btn-primary text-center\">
                                <i class=\"fas fa-user fa-lg\"></i><br>   
                                Kategorije
                                </a>
                            </div>
                            <div class=\"col mx-1 dugme border border-success\">
                                    <a href=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/books/\"
                                     class=\"btn btn-primary\">
                                     <i class=\"fas fa-plus fa-lg\"></i><br>    
                                     Knjige
                                    </a>
                            </div>
                            <div class=\"col mx-1 box dugme border border-success\">
                                <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/reservations/\" 
                                class=\"btn btn-primary text-center\">
                                <i class=\"fas fa-paw fa-lg\"></i><br> 
                                Zaduzenja
                                </a>
                            </div>
                            
                        </div>
    </div>

";
    }

    // line 38
    public function block_welcome($context, array $blocks = [])
    {
        echo " <b class=\"pl-4 beli-tekst\"> Zdravo ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["bib"] ?? null), "forename", [], "any", false, false, false, 38), "html", null, true);
        echo "! </b>  ";
    }

    public function getTemplateName()
    {
        return "LibrarianDashboard/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 38,  79 => 27,  69 => 20,  59 => 13,  48 => 4,  45 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "LibrarianDashboard/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\LibrarianDashboard\\index.html");
    }
}
