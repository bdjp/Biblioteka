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
        echo "assets/css/main.css?ts=<?=time()?>\" >
    <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/style.css?ts=<?=time()?>\">
</head>

<body>
    <div class=\"container-fluid mali\">
        <nav class=\"navbar navbar-expand-lg\" id=\"glavni-nav\">



            <a class=\"navbar-brand\">
                <img id=\"logo\" src=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/logo4.png\" alt=\"Banner 1\"></a>

            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarText\"
                aria-controls=\"navbarText\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarText\">
                <ul class=\"navbar-nav mr-auto\">
                    <li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"#\">Naslovna <span class=\"sr-only\">(current)</span></a></li>
                    <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Kategorije</a></li>
                    <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Knjige</a></li>
                </ul>

                <ul class=\"navbar-nav ml-auto\">
                    <li class=\"nav-item \">
                        <a class=\"nav-link\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "user/login\">Uloguje se</a>
                    </li>
                    <li class=\"nav-item \">
                        <a class=\"nav-link\" href=\"#\">Odjava</a>
                    </li>
                </ul>
            </div>
        </nav>

        <nav class=\"navbar navbar-expand-lg\" id=\"drugi-nav\">
                <div class=\"collapse navbar-collapse\" id=\"navbarText\">
                        <ul class=\"navbar-nav mr-auto\">
                            <li class=\"nav-item active\">
                            ";
        // line 51
        $this->displayBlock('dash', $context, $blocks);
        // line 52
        echo "                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"#\"></a></li>
                        </ul>
        
                        <ul class=\"navbar-nav ml-auto\">
                            <li class=\"nav-item \">
                                <a><i class=\"fab fa-facebook-square fa-2x px-1\"></i></a>
                            </li>
                            <li class=\"nav-item \">
                                <a><i class=\"fab fa-instagram fa-2x px-1\"></i></a>
                            </li>
                            <li class=\"nav-item \">
                                    <a><i class=\"fab fa-youtube fa-2x px-1\"></i></a>
                                </li>
                        </ul>
                    </div>
                </nav>

        </div>
        ";
        // line 70
        $this->displayBlock('main', $context, $blocks);
        // line 73
        echo "        

            <footer id=\"footer\">
                <p>Copyright Bikovi, &copy; 2019</p>
            </footer>

        </div> <!-- Container -->
     

            <script> const BASE = '";
        // line 82
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "';</script>
            <script src=\"";
        // line 83
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
            <script src=\"";
        // line 84
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>
            <script src=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/books.js\"></script>
        </div>
</body>

</html>";
    }

    // line 6
    public function block_naslov($context, array $blocks = [])
    {
        echo "Pocetna";
    }

    // line 51
    public function block_dash($context, array $blocks = [])
    {
        echo "         ";
    }

    // line 70
    public function block_main($context, array $blocks = [])
    {
        // line 71
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
        return array (  185 => 71,  182 => 70,  176 => 51,  170 => 6,  161 => 85,  157 => 84,  153 => 83,  149 => 82,  138 => 73,  136 => 70,  116 => 52,  114 => 51,  98 => 38,  78 => 21,  65 => 11,  61 => 10,  57 => 9,  53 => 8,  49 => 7,  45 => 6,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\_global\\index.html");
    }
}
