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

/* _global/index.html */
class __TwigTemplate_acb99431303b1e3138865303d6a0aacf02eb4eb20ae255f28f264fe0f1c9c910 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'naslov' => [$this, 'block_naslov'],
            'dash' => [$this, 'block_dash'],
            'welcome' => [$this, 'block_welcome'],
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>
    <meta charset=\"UTF-8\">
    <title>Biblioteka - ";
        // line 6
        $this->displayBlock('naslov', $context, $blocks);
        echo "</title>
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/banner.png\">
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/@fortawesome/fontawesome-free/css/all.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/main.css?ts=<?=time()?>\">
    <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/style.css?ts=<?=time()?>\">
</head>

<body>
    <div class=\"container-fluid\">


            <nav class=\"navbar navbar-expand-lg\" id=\"glavni-nav\">

                <a class=\"navbar-brand\">
                    <img id=\"logo\" src=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/logo4.png\" alt=\"Banner 1\"></a>

                <button class=\"navbar-toggler custom-toggler\" type=\"button\" data-toggle=\"collapse\"
                    data-target=\"#navbarText\" aria-controls=\"navbarText\" aria-expanded=\"false\"
                    aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>

                <div class=\"collapse navbar-collapse\" id=\"navbarText\">
                    <ul class=\"navbar-nav mr-auto\">
                        <li class=\"nav-item active\">
                            <a class=\"nav-link\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/dashboard/\">Naslovna <span class=\"sr-only\">(current)</span></a></li>
                        <li class=\"nav-item\"><a class=\"nav-link\" href=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/books/\">Knjige</a></li>
                        <li class=\"nav-item \">
                                <a class=\"nav-link\" href=\"";
        // line 35
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "librarian/stud/reservations/\">Rezervacije</a>
                            </li>

                    </ul>

                    <ul class=\"navbar-nav ml-auto\">
                            
                        <li class=\"nav-item \">
                            <a class=\"nav-link\" href=\"";
        // line 43
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "user/logout\">Odjava</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class=\"navbar navbar-expand-lg\" id=\"drugi-nav\">
                    <div class=\"collapse navbar-collapse\" id=\"navbarText\">
                        <ul class=\"navbar-nav mr-auto\">
                            <li class=\"nav-item active\">
                                ";
        // line 52
        $this->displayBlock('dash', $context, $blocks);
        // line 53
        echo "                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\"></a></li>
                        </ul>

                        <ul class=\"navbar-nav mx-auto pl-5\">
                                <li class=\"nav-item active\">
                                    ";
        // line 58
        $this->displayBlock('welcome', $context, $blocks);
        // line 59
        echo "                                <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\"></a></li>
                            </ul>
    
                        <ul class=\"navbar-nav ml-auto\">
                            <li class=\"nav-item \">
                                <a><i class=\"fab fa-facebook-square fa-2x px-1 beli-tekst\"></i></a>
                            </li>
                            <li class=\"nav-item \">
                                <a><i class=\"fab fa-instagram fa-2x px-1 beli-tekst\"></i></a>
                            </li>
                            <li class=\"nav-item \">
                                <a><i class=\"fab fa-youtube fa-2x px-1 beli-tekst\"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>


    <main>
           

        ";
        // line 80
        $this->displayBlock('main', $context, $blocks);
        // line 83
        echo "    </main>


    <footer id=\"footer\">
            <p>Univerzitet Singidunum - Praktikum internet i veb tehnologije &copy; 2019</p>
    </footer>

    </div>


    <script> const BASE = '";
        // line 93
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "';</script>
    <script src=\"";
        // line 94
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
    <script src=\"";
        // line 95
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>
    <script src=\"";
        // line 96
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/books.js\"></script>
    <script src=\"";
        // line 97
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/modal.js\"></script>
    <script src=\"";
        // line 98
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/validacija.js\"></script>

</body>

</html>";
    }

    // line 6
    public function block_naslov($context, array $blocks = [])
    {
        echo "Pocetna";
    }

    // line 52
    public function block_dash($context, array $blocks = [])
    {
        echo " ";
    }

    // line 58
    public function block_welcome($context, array $blocks = [])
    {
        echo " ";
    }

    // line 80
    public function block_main($context, array $blocks = [])
    {
        // line 81
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "_global/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  223 => 81,  220 => 80,  214 => 58,  208 => 52,  202 => 6,  193 => 98,  189 => 97,  185 => 96,  181 => 95,  177 => 94,  173 => 93,  161 => 83,  159 => 80,  136 => 59,  134 => 58,  127 => 53,  125 => 52,  113 => 43,  102 => 35,  97 => 33,  93 => 32,  79 => 21,  66 => 11,  62 => 10,  58 => 9,  54 => 8,  50 => 7,  46 => 6,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\_global\\index.html");
    }
}
