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
    <link href=\"../bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
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
                        <div class=\"item active\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
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

            <div class=\"col-md-3 myClass\" style=\"height:800px\">
                <p class=\"lead\">Categories</p>
                <div class=\"list-group\">
                    ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categoryList"]) ? $context["categoryList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 53
            echo "                        <button class=\"list-group-item\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
            echo "</button>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "                </div>
            </div>

            <div class=\"row\">
                ";
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prodList"]) ? $context["prodList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 60
            echo "                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"data:image/png;base64,";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"100px\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
            echo "</h4>
                                <h4><a href=\"#\">";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name_EN", array()), "html", null, true);
            echo "</a>
                                </h4>
                                <p>";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description_EN", array()), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "average", array()), "html", null, true);
            echo " reviews</p>
                                <p>
                                    ";
            // line 72
            $context["k"] = $this->getAttribute($context["product"], "average", array());
            // line 73
            echo "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 74
                echo "                                    <span class=\"glyphicon glyphicon-star\" id=\"star-full\"></span>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 76
            echo "                                    ";
            $context["t"] = (5 - $this->getAttribute($context["product"], "average", array()));
            // line 77
            echo "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                // line 78
                echo "                                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            echo "                                </p>
                            </div>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "                </div>




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
        return array (  182 => 84,  173 => 80,  166 => 78,  161 => 77,  158 => 76,  151 => 74,  146 => 73,  144 => 72,  139 => 70,  133 => 67,  128 => 65,  124 => 64,  119 => 62,  115 => 60,  111 => 59,  105 => 55,  96 => 53,  92 => 52,  48 => 10,  45 => 9,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} E-Shop{% endblock %}
{% block head %}   
    <!-- Custom CSS -->
    <link href=\"../bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
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
                        <div class=\"item active\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                        </div>
                        <div class=\"item\">
                            <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
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

            <div class=\"col-md-3 myClass\" style=\"height:800px\">
                <p class=\"lead\">Categories</p>
                <div class=\"list-group\">
                    {% for category in categoryList %}
                        <button class=\"list-group-item\">{{ category.name }}</button>
                    {% endfor %}
                </div>
            </div>

            <div class=\"row\">
                {% for product in prodList %}
                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"data:image/png;base64,{{product.picture}}\" alt=\"product image\" width=\"100px\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">{{ product.price }}</h4>
                                <h4><a href=\"#\">{{ product.name_EN }}</a>
                                </h4>
                                <p>{{ product.description_EN }}</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">{{ product.average }} reviews</p>
                                <p>
                                    {% set k = product.average %}
                                    {% for i in range(1, k) %}
                                    <span class=\"glyphicon glyphicon-star\" id=\"star-full\"></span>
                                    {% endfor %}
                                    {% set t = (5 - product.average) %}
                                    {% for s in range(1, t) %}
                                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    {% endfor %}
                                </p>
                            </div>
                        </div>
                    {% endfor %}
                </div>




            </div>

        </div>

    </div>

</div>

{% endblock %}";
    }
}
