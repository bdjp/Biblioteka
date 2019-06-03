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

/* Main/getLogin.html */
class __TwigTemplate_e916e7ed515ff4a1a5bf6708d85d15834ab2ce645961278dc133ee6bdc28dd8f extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "Main/getLogin.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<form action=\"/Biblioteka/user/login\" method=\"POST\">
    <div>
        <label for=\"input_username\">Username:</label>
        <input type=\"text\" id=\"input_username\" name=\"login_username\" required 
                placeholder=\"Unesite korisnicko ime.\">
    </div>

    <div>
        <label for=\"input_password\">Username:</label>
        <input type=\"password\" id=\"input_password\" name=\"login_password\" required 
                placeholder=\"Unesite lozinku.\">
    </div>

    <div>
        <button type=\"submit\">Login</button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "Main/getLogin.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Main/getLogin.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Main\\getLogin.html");
    }
}
