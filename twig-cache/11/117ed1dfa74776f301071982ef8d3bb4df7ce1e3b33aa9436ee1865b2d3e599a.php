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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
  <title>Document</title>
  <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/banner.png\">
  <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/css/bootstrap.min.css\">
  <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/@fortawesome/fontawesome-free/css/all.min.css\">
  <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/main.css?ts=<?=time()?>\">
  <link rel=\"stylesheet\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/style.css?ts=<?=time()?>\">
  <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/css/login.css?ts=<?=time()?>\">
</head>

<body>
  <div class=\"row mt-5 pt-3\">
    <div class=\"col-12  p-0\">
      <img src=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/img/logo8.png\"  class=\"rounded mx-auto d-block\" alt=\"...\">
    </div>
  </div>

  <div class=\"row\">
    <div class=\"col-10 offset-1 col-md-6 offset-md-3 py-5\">
      <div class=\"card\">
        <div class=\"card-header text-center\">
            <i class=\"fas fa-sign-in-alt\"></i>
          Prijava
        </div>

        <div class=\"card-body\">
          <form method=\"post\"  action=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "user/login\">

            <div class=\"form-row\">
              <div class=\"form-group col-md-6 offset-md-3\">
                <div class=\"input-group\">
                  <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\">
                        <i class=\"fas fa-user\"></i>
                    </span>
                  </div>

                  <input type=\"text\" id=\"title\" name=\"login_username\" class=\"form-control\" 
                      required placeholder=\"Korisnicko ime\">
                </div>
              </div>
            </div>

            <div class=\"form-row\">
              <div class=\"form-group col-md-6 offset-md-3\">
                <div class=\"input-group\">
                  <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\">
                        <i class=\"fas fa-key\"></i>
                    </span>
                  </div>

                  <input type=\"password\" id=\"title\" name=\"login_password\" class=\"form-control\" 
                  required placeholder=\"Lozinka\">
                </div>
              </div>
            </div>


            <div class=\"form-row mt-2\">
                <button type=\"submit\" class=\"btn btn-primary col-4 offset-4 col-md-4 offset-md-4\">
                  Prijavi se
                </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <script> const BASE = '";
        // line 79
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "';</script>
  <script src=\"";
        // line 80
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/jquery/dist/jquery.min.js\"></script>
  <script src=\"";
        // line 81
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/libs/bootstrap/dist/js/bootstrap.min.js\"></script>
  <script src=\"";
        // line 82
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/books.js\"></script>
</body>

</html>";
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
        return array (  151 => 82,  147 => 81,  143 => 80,  139 => 79,  90 => 33,  74 => 20,  65 => 14,  61 => 13,  57 => 12,  53 => 11,  49 => 10,  45 => 9,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Main/getLogin.html", "E:\\Programi\\Xampp\\htdocs\\Biblioteka\\views\\Main\\getLogin.html");
    }
}
