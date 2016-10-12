<?php

/* master.html.twig */
class __TwigTemplate_0823507f2a31a94ddd655ae23ecaebcffc54e21f8449ba158dd0e8671108aa05 extends Twig_Template
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

        <script>

        </script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
            <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->

        <!-- Styles -->
        <link rel=\"stylesheet\" href=\"/styles/styles.css\" />
        <title>";
        // line 29
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 30
        $this->displayBlock('head', $context, $blocks);
        // line 32
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
                    <ul class=\"nav navbar-nav fontsize submenu\">
                        <li>
                            <a href=\"/\">";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("home"), "html", null, true);
        echo "</a>
                        </li>
                        <li>
                            <a href=\"#\">Services</a>
                        </li>
                        <li>
                            <a href=\"/locations\">";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("locations"), "html", null, true);
        echo "</a>
                        </li>
                        <li>
                            <a href=\"#\">Admin</a>
                            <ul>
                                <li><a href=\"#\">Add/Edit product</a></li>
                                <li><a href=\"#\">Add/Edit category</a></li>
                                <li><a href=\"#\">View orders</a></li>
                            </ul>
                        </li>
                    </ul>
                    <a href=\"?lang=en\"><img src=\"/images/eng.png\" class=\"flag flag-fr\" id=\"lang-fr\"></a> 
                    <a href=\"?lang=fr\"><img src=\"/images/french.png\" class=\"flag flag-en\" id=\"lang-en\"></a> 
                    <span style=\"color:#9d9d9d; font-size: 20px;\">   
                        <!--<a href=\"?lang=en\">English</a>
                        <a href=\"?lang=fr\">Français</a>-->
                    </span>
                    <ul class=\"nav navbar-nav log-register fontsize\">
                        ";
        // line 75
        if ((isset($context["fbUser"]) ? $context["fbUser"] : null)) {
            // line 76
            echo "                            <li>
                                <img src=\"//graph.facebook.com/";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["fbUser"]) ? $context["fbUser"] : null), "ID", array()), "html", null, true);
            echo "/picture\" ><span style=\"color:#9d9d9d;\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["fbUser"]) ? $context["fbUser"] : null), "firstName", array()), "html", null, true);
            echo "</span>
                            </li>
                            <li>
                                <a href=\"/cart\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                            </li>

                            <li><a href=\"/logout\">";
            // line 83
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
            echo "</a></li>
                            ";
        } else {
            // line 85
            echo "                                ";
            if ((isset($context["user"]) ? $context["user"] : null)) {
                // line 86
                echo "                                <li>
                                    <span style=\"color:#9d9d9d;\">";
                // line 87
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "firstName", array()), "html", null, true);
                echo "</span>
                                </li>
                                <li>
                                    <a href=\"/cart\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                                </li>

                                <li><a href=\"/logout\">";
                // line 93
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
                echo "</a></li>
                                ";
            } else {
                // line 95
                echo "                                <li>
                                    <a href=\"/login\">";
                // line 96
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Sign In"), "html", null, true);
                echo "</a>
                                </li>
                                <li>
                                    <a href=\"/register\">";
                // line 99
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Sign Up"), "html", null, true);
                echo "</a>
                                </li>
                            ";
            }
            // line 102
            echo "                        ";
        }
        // line 103
        echo "                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <div id=\"containercenterContent \">
            <div id=\"container\">";
        // line 110
        $this->displayBlock('content', $context, $blocks);
        echo "</div>

            <div class=\"container\">

                <hr>

                <!-- Footer -->
                <footer>
                    <div class=\"row\">
                        <div class=\"col-lg-12\">
                            <p>Copyright &copy; IPD8 2016</p>
                            <p>This website it's intended as a class project for the PHP course and has no commercial purpose.</p>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src=\"/bootstrap/js/jquery.js\"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src=\"/bootstrap/js/bootstrap.min.js\"></script>
    </body>
</html>
";
    }

    // line 29
    public function block_title($context, array $blocks = array())
    {
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "        ";
    }

    // line 110
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 110,  216 => 31,  213 => 30,  208 => 29,  177 => 110,  168 => 103,  165 => 102,  159 => 99,  153 => 96,  150 => 95,  145 => 93,  136 => 87,  133 => 86,  130 => 85,  125 => 83,  114 => 77,  111 => 76,  109 => 75,  88 => 57,  79 => 51,  58 => 32,  56 => 30,  52 => 29,  22 => 1,);
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

        <script>

        </script>


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
                    <ul class=\"nav navbar-nav fontsize submenu\">
                        <li>
                            <a href=\"/\">{{\"home\"|trans}}</a>
                        </li>
                        <li>
                            <a href=\"#\">Services</a>
                        </li>
                        <li>
                            <a href=\"/locations\">{{\"locations\"|trans}}</a>
                        </li>
                        <li>
                            <a href=\"#\">Admin</a>
                            <ul>
                                <li><a href=\"#\">Add/Edit product</a></li>
                                <li><a href=\"#\">Add/Edit category</a></li>
                                <li><a href=\"#\">View orders</a></li>
                            </ul>
                        </li>
                    </ul>
                    <a href=\"?lang=en\"><img src=\"/images/eng.png\" class=\"flag flag-fr\" id=\"lang-fr\"></a> 
                    <a href=\"?lang=fr\"><img src=\"/images/french.png\" class=\"flag flag-en\" id=\"lang-en\"></a> 
                    <span style=\"color:#9d9d9d; font-size: 20px;\">   
                        <!--<a href=\"?lang=en\">English</a>
                        <a href=\"?lang=fr\">Français</a>-->
                    </span>
                    <ul class=\"nav navbar-nav log-register fontsize\">
                        {% if fbUser %}
                            <li>
                                <img src=\"//graph.facebook.com/{{fbUser.ID}}/picture\" ><span style=\"color:#9d9d9d;\">{{fbUser.firstName}}</span>
                            </li>
                            <li>
                                <a href=\"/cart\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                            </li>

                            <li><a href=\"/logout\">{{\"Logout\"|trans}}</a></li>
                            {% else %}
                                {% if user %}
                                <li>
                                    <span style=\"color:#9d9d9d;\">{{user.firstName}}</span>
                                </li>
                                <li>
                                    <a href=\"/cart\"><img src=\"/images/cart.png\" class=\"cart\"></a>
                                </li>

                                <li><a href=\"/logout\">{{\"Logout\"|trans}}</a></li>
                                {% else %}
                                <li>
                                    <a href=\"/login\">{{\"Sign In\"|trans}}</a>
                                </li>
                                <li>
                                    <a href=\"/register\">{{\"Sign Up\"|trans}}</a>
                                </li>
                            {% endif %}
                        {% endif %}
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
                            <p>This website it's intended as a class project for the PHP course and has no commercial purpose.</p>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src=\"/bootstrap/js/jquery.js\"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src=\"/bootstrap/js/bootstrap.min.js\"></script>
    </body>
</html>
";
    }
}
