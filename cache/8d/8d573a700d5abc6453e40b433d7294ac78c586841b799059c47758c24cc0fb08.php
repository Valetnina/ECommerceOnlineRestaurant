<?php

/* master.html.twig */
class __TwigTemplate_fb55e59124274951fbabbb6076b1e9e4ad7e454367c51bfdc4d6f905a0f3e94b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"ECommerce Online Sop For Fast-Food Restaurant\">
        <meta name=\"author\" content=\"Olga_Racu & Tina_Migalatii\">

        <!-- Bootstrap Core CSS -->
        <link href=\"/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        <script src=\"/bootstrap/js/bootstrap.min.js\"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
            <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->

        <!-- Styles -->
        <link rel=\"stylesheet\" href=\"/styles/styles.css\" />
        <title>";
        // line 25
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 26
        $this->displayBlock('head', $context, $blocks);
        // line 28
        echo "    </head>
    <body>
        <!-- Navigation -->
        <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\" background-color=\"#025274\">
            <div class=\"container\">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\"><img src=\"/images/Logo_Big.png\" id=\"logo\"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                    <ul class=\"nav navbar-nav fontsize\">
                        <li>
                            <a href=\"#\">About</a>
                        </li>
                        <li>
                            <a href=\"#\">Services</a>
                        </li>
                        <li>
                            <a href=\"#\">Contact</a>
                        </li>
                    </ul>
                    <a href=\"?lang=en\"><img src=\"/images/eng.png\" width=\"70\" class=\"flag flag-fr\" id=\"lang-fr\"></a>
                    <a href=\"?lang=fr\"><img src=\"/images/french.png\" width=\"70\" class=\"flag flag-en\" id=\"lang-en\"></a> 
                    <ul class=\"nav navbar-nav log-register fontsize\">
                        <li>
                            <a href=\"#\">Login</a>
                        </li>
                        <li>
                            <a href=\"#\">Register</a>
                        </li>
                        <li>
                            <a href=\"#\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div id=\"containercenterContent \">
            <div id=\"container\">";
        // line 75
        $this->displayBlock('content', $context, $blocks);
        echo "</div>

            <div class=\"container\">

                <hr>

                <!-- Footer -->
                <footer>
                    <div class=\"row\">
                        <div class=\"col-lg-12\">
                            <p>Copyright &copy; IPD8 2016</p>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src=\"/bootstrap/js/jquery.js\"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src=\"/bootstrap/js/bootstrap.min.js\">
            < /body>
                    < /html>
    ";
    }

    // line 25
    public function block_title($context, array $blocks = array())
    {
    }

    // line 26
    public function block_head($context, array $blocks = array())
    {
        // line 27
        echo "        ";
    }

    // line 75
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  145 => 75,  141 => 27,  138 => 26,  133 => 25,  103 => 75,  54 => 28,  52 => 26,  48 => 25,  22 => 1,);
    }

    public function getSource()
    {
        return "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"ECommerce Online Sop For Fast-Food Restaurant\">
        <meta name=\"author\" content=\"Olga_Racu & Tina_Migalatii\">

        <!-- Bootstrap Core CSS -->
        <link href=\"/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        <script src=\"/bootstrap/js/bootstrap.min.js\"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
            <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->

        <!-- Styles -->
        <link rel=\"stylesheet\" href=\"/styles/styles.css\" />
        <title>{% block title %}{% endblock %}</title>
        {% block head %}
        {% endblock %}
    </head>
    <body>
        <!-- Navigation -->
        <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\" background-color=\"#025274\">
            <div class=\"container\">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\"><img src=\"/images/Logo_Big.png\" id=\"logo\"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                    <ul class=\"nav navbar-nav fontsize\">
                        <li>
                            <a href=\"#\">About</a>
                        </li>
                        <li>
                            <a href=\"#\">Services</a>
                        </li>
                        <li>
                            <a href=\"#\">Contact</a>
                        </li>
                    </ul>
                    <a href=\"?lang=en\"><img src=\"/images/eng.png\" width=\"70\" class=\"flag flag-fr\" id=\"lang-fr\"></a>
                    <a href=\"?lang=fr\"><img src=\"/images/french.png\" width=\"70\" class=\"flag flag-en\" id=\"lang-en\"></a> 
                    <ul class=\"nav navbar-nav log-register fontsize\">
                        <li>
                            <a href=\"#\">Login</a>
                        </li>
                        <li>
                            <a href=\"#\">Register</a>
                        </li>
                        <li>
                            <a href=\"#\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div id=\"containercenterContent \">
            <div id=\"container\">{% block content %}{% endblock %}</div>

            <div class=\"container\">

                <hr>

                <!-- Footer -->
                <footer>
                    <div class=\"row\">
                        <div class=\"col-lg-12\">
                            <p>Copyright &copy; IPD8 2016</p>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src=\"/bootstrap/js/jquery.js\"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src=\"/bootstrap/js/bootstrap.min.js\">
            < /body>
                    < /html>
    ";
    }
}
