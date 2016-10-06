<?php

/* index.html.twig */
class __TwigTemplate_db6ee13b7975ae4eb6b3fa133965f4d554a564262b0df1494a487c36589de8ec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo " E-Shop";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo "   
    <!-- Custom CSS -->
    <link href=\"/bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
     <!-- jQuery -->
    <script src=\"/js/index_script.js\"></script>
    
";
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        // line 13
        echo "
    <!-- Page Content -->
    <div class=\"container\">


        <div class=\"col-md-9\" style=\"width:100%; margin-bottom:50px;\">



            <div class=\"col-md-12\">
                <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
                    <ol class=\"carousel-indicators\">
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>
                    </ol>
                    <div class=\"carousel-inner\">
                        <div class=\"item active car\">
                            <img class=\"slide-image\" src=\"/images/car-1.jpg\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"/images/car-2.jpg\" alt=\"\">
                        </div> 
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"/images/car-3.jpg\" alt=\"\">
                        </div> 
                    </div>
                    <a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">
                        <span class=\"glyphicon glyphicon-chevron-left\"></span>
                    </a>
                    <a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">
                        <span class=\"glyphicon glyphicon-chevron-right\"></span>
                    </a>
                </div>
            </div>

        </div>
        <div class=\"row\">

            <div class=\"col-md-3 category\">
                <p class=\"lead\">Categories</p>
                <div class=\"list-group\" id=\"navCategory\">
                    ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categoryList"]) ? $context["categoryList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 56
            echo "                        <button class=\"list-group-item\" id=\"category_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "ID", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
            echo "</button>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "                </div>
            </div>

            <div class=\"row\" id=\"index-products\">
                
                </div>

            </div>

        </div>

    </div>

</div>

";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 58,  99 => 56,  95 => 55,  51 => 13,  48 => 12,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} E-Shop{% endblock %}
{% block head %}   
    <!-- Custom CSS -->
    <link href=\"/bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
     <!-- jQuery -->
    <script src=\"/js/index_script.js\"></script>
    
{% endblock %}

{% block content %}

    <!-- Page Content -->
    <div class=\"container\">


        <div class=\"col-md-9\" style=\"width:100%; margin-bottom:50px;\">



            <div class=\"col-md-12\">
                <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
                    <ol class=\"carousel-indicators\">
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>
                        <li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>
                    </ol>
                    <div class=\"carousel-inner\">
                        <div class=\"item active car\">
                            <img class=\"slide-image\" src=\"/images/car-1.jpg\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"/images/car-2.jpg\" alt=\"\">
                        </div> 
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"/images/car-3.jpg\" alt=\"\">
                        </div> 
                    </div>
                    <a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">
                        <span class=\"glyphicon glyphicon-chevron-left\"></span>
                    </a>
                    <a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">
                        <span class=\"glyphicon glyphicon-chevron-right\"></span>
                    </a>
                </div>
            </div>

        </div>
        <div class=\"row\">

            <div class=\"col-md-3 category\">
                <p class=\"lead\">Categories</p>
                <div class=\"list-group\" id=\"navCategory\">
                    {% for category in categoryList %}
                        <button class=\"list-group-item\" id=\"category_{{category.ID}}\">{{ category.name }}</button>
                    {% endfor %}
                </div>
            </div>

            <div class=\"row\" id=\"index-products\">
                
                </div>

            </div>

        </div>

    </div>

</div>

{% endblock %}";
    }
}
