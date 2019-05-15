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
    <!--<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/css/bootstrap.min.css\">-->
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/font-awesome/css/font-awesome.min.css\">
    <link rel=\"stylesheet\" href=\"/biblioteka/assets/css/main.css\">
</head>

<body>
    <div class=\"container\">
    <header>
        <div class=\"banners\">
            <a href=\"/Biblioteka/\" class=\"banner\">
            <img id=\"logo\" src=\"/biblioteka/assets/img/banner.png\" alt=\"Banner 1\"></a>
        </div>
        <nav id=\"main-menu\">
            
                <a href=\"/Biblioteka/\">Pocetna</a>
                <a href=\"/Biblioteka/categories/\">Kategorije</a>
                <a href=\"/Biblioteka/profile/\">Profil</a>
                <a href=\"/Biblioteka/contact/\">Kontakt</a>
                <a href=\"/Biblioteka/log-out/\">Odjava</a>
            
        </nav>
    </header>

    <main class=\"main\">
            ";
        // line 31
        $this->displayBlock('main', $context, $blocks);
        // line 34
        echo "    </main>

    <footer>
        &copy; 2018 Biblioteka srednje skole
    </footer>

    <script src=\"";
        // line 40
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
    <script src=\"";
        // line 41
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>
    <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/bookmarks.js\"></script>
</div>
</body>

</html>";
    }

    // line 6
    public function block_naslov($context, array $blocks = [])
    {
        echo "Pocetna";
    }

    // line 31
    public function block_main($context, array $blocks = [])
    {
        // line 32
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
        return array (  114 => 32,  111 => 31,  105 => 6,  96 => 42,  92 => 41,  88 => 40,  80 => 34,  78 => 31,  52 => 8,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\_global\\index.html");
    }
}
