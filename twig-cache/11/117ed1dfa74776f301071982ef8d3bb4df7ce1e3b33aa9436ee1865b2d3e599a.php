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
        echo "    <div class=\"container-fluid\">
          <div class=\"row \">
            <div class=\"col offset-md-5\">
              <h1 >Prijavite se</h1>
            </div>
          </div>

  
      <section id=\"main\">
        <div class=\"container\">
          <div class=\"row\">
            <div class=\"col-md-4 offset-md-4\">
              <form id=\"login\" class=\"well\" action=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "user/login\" method=\"POST\">
                    <div class=\"form-group\">
                      <label>Korisnicko ime</label>
                      <input type=\"text\" class=\"form-control\" name=\"login_username\" required placeholder=\"Unesite korisnicko ime...\">
                    </div>
                    <div class=\"form-group\">
                      <label>Lozinka</label>
                      <input type=\"password\" class=\"form-control\" name=\"login_password\" required placeholder=\"Unesite lozinku\">
                    </div>
                    <button type=\"submit\" class=\"btn btn-primary btn-block\">Prijavite se</button>
                      <br>
                    <div class=\"col-12 narrow text-center\">
                        <a href=\"registracija.html\">Nemam nalog / Registruj se <i class=\"fas fa-long-arrow-alt-right\"></i></a>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </section>
    </div>

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
        return array (  61 => 16,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Main/getLogin.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Main\\getLogin.html");
    }
}
