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
    <!--<link rel=\"stylesheet\" href=\"assets/libs/bootstrap/dist/css/bootstrap.min.css\">-->
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/banner.png\">
     <!--<link rel=\"stylesheet\" href=\"assets/libs/font-awesome/css/font-awesome.min.css\">-->
    <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/main.css\">
</head>

<body>
    <div class=\"container\">
    <header>
        <div class=\"banners\">
            <a href=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "\" class=\"banner\">
            <img id=\"logo\" src=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/banner.png\" alt=\"Banner 1\"></a>
        </div>
        <nav id=\"main-menu\">
            
                <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "\">Pocetna</a>
                <a href=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "categories/\">Kategorije</a>
                <a href=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "profile/\">Profil</a>
                <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "contact/\">Kontakt</a>
                <a href=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "log-out/\">Odjava</a>
            
        </nav>
    </header>

    <main class=\"main\">
            ";
        // line 32
        $this->displayBlock('main', $context, $blocks);
        // line 35
        echo "    </main>

    <footer>
        &copy; 2018 Biblioteka srednje skole
    </footer>

    <script> const BASE = '";
        // line 41
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "';</script>
    <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
    <script src=\"";
        // line 43
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>
    <!--<script src=\"assets/js/bookmarks.js\"></script>-->
</div>
</body>

</html>";
    }

    // line 6
    public function block_naslov($context, array $blocks = [])
    {
        echo "Pocetna";
    }

    // line 32
    public function block_main($context, array $blocks = [])
    {
        // line 33
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
        return array (  137 => 33,  134 => 32,  128 => 6,  118 => 43,  114 => 42,  110 => 41,  102 => 35,  100 => 32,  91 => 26,  87 => 25,  83 => 24,  79 => 23,  75 => 22,  68 => 18,  64 => 17,  54 => 10,  49 => 8,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\_global\\index.html");
    }
}
