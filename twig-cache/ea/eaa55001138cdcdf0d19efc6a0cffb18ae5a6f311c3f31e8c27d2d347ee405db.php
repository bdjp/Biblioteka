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
    <title>Sajt</title>
</head>

<body>
    <header>
        Zaglavlje...
    </header>

    <main>
            ";
        // line 15
        $this->displayBlock('main', $context, $blocks);
        // line 18
        echo "    </main>

    <footer>
        &copy; 2018 Biblioteka srednje skole
    </footer>
</body>

</html>";
    }

    // line 15
    public function block_main($context, array $blocks = [])
    {
        // line 16
        echo "
            ";
    }

    public function getTemplateName()
    {
        return "_global/index.html";
    }

    public function getDebugInfo()
    {
        return array (  68 => 16,  65 => 15,  54 => 18,  52 => 15,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "_global/index.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\_global\\index.html");
    }
}
