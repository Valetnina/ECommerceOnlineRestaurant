<?php

/* product_view.html.twig */
class __TwigTemplate_8dff9deb620169f340758fbc4091dd840d779d78fae91ceb5571a81232c1e704 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "product_view.html.twig", 1);
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
        echo " ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("home"), "html", null, true);
        echo " ";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo "   
    <!-- Bootstrap Core CSS -->
    <link href=\"/bootstrap/css/shop-item.css\" rel=\"stylesheet\">


    <!-- jQuery -->
    <script src=\"/js/product_script.js\"></script>

";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "    ";
        if ((isset($context["product"]) ? $context["product"] : null)) {
            // line 17
            echo "
        <div class=\"container\">
            <div class=\"row\">

                <span id=\"productID\" hidden>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "</span>
                <div class=\"col-md-9\">

                    <div class=\"thumbnail\"> 

                        <img class=\"img-responsive productPageImage\" src=\"data:image/png;base64,";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"200px\">
                        <div class=\"caption-full\">
                            <h4 id=\"productPrice\" class=\"pull-right\">\$";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "price", array()), "html", null, true);
            echo "</h4>
                            <h4>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name", array()), "html", null, true);
            echo "</h4>
                            <p>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "description", array()), "html", null, true);
            echo "</p>
                        </div>
                        <div class=\"ratings\">
                            <p class=\"pull-right\" ><span id=\"reviewCount\">";
            // line 33
            echo twig_escape_filter($this->env, (isset($context["reviewCount"]) ? $context["reviewCount"] : null), "html", null, true);
            echo "</span> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("reviews"), "html", null, true);
            echo "</p>
                            <p>";
            // line 34
            $context["k"] = (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null);
            // line 35
            echo "                                ";
            if (((isset($context["k"]) ? $context["k"] : null) == 0)) {
                // line 36
                echo "                                ";
            } else {
                // line 37
                echo "                                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 38
                    echo "                                        <span class=\"glyphicon glyphicon-star\"></span>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 40
                echo "                                ";
            }
            // line 41
            echo "                                ";
            $context["t"] = (5 - (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null));
            // line 42
            echo "                                ";
            if (((isset($context["t"]) ? $context["t"] : null) == 5)) {
                // line 43
                echo "                                ";
            } else {
                // line 44
                echo "                                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                    // line 45
                    echo "                                        <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "                                ";
            }
            // line 48
            echo "
                                <span id=\"averageStars\">";
            // line 49
            echo twig_escape_filter($this->env, (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null), "html", null, true);
            echo "</span> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("stars"), "html", null, true);
            echo "</p>
                        </div>
                    </div>

                    <div class=\"well\">

                        <div class=\"text-right\">
                            <button class=\"btn btn-success\" id=\"leaveReview\">";
            // line 56
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                        </div>
                        <div id =\"reviewForm\">
                            <label>";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Review"), "html", null, true);
            echo ": </label><br><textarea rows=\"4\" cols=\"80\" name=\"reviewText\"></textarea><span class=\"error\"></span><br><br>
                            <label>";
            // line 60
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Rate"), "html", null, true);
            echo ": </label>
                            <div id=\"selectedRating\">
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star1\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star2\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star3\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star4\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star5\"></span>
                            </div>        
                            <br><br> <button class=\"btn btn-success\" id=\"postReview\">";
            // line 68
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                        </div>

                        <hr>
                        <div id=\"reviewList\">

                        </div>
                    </div>
                    <ul class=\"pagination\">
                        <li><button id=\"previous\">«</button></li>
                        ";
            // line 78
            $context["t"] = (isset($context["totalPages"]) ? $context["totalPages"] : null);
            // line 79
            echo "                         ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 3));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 80
                echo "                                        <li><button class=\"active\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</button></li>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 83
                echo "                                        <li><button class=\"active\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</button></li>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "                        <li><button id=\"next\">»</button></li>
                    </ul>

                </div>

            </div>

        </div>

    ";
        } else {
            // line 95
            echo "        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            ";
        }
        // line 97
        echo "        ";
    }

    public function getTemplateName()
    {
        return "product_view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  239 => 97,  235 => 95,  223 => 85,  214 => 83,  209 => 82,  200 => 80,  195 => 79,  193 => 78,  180 => 68,  169 => 60,  165 => 59,  159 => 56,  147 => 49,  144 => 48,  141 => 47,  134 => 45,  129 => 44,  126 => 43,  123 => 42,  120 => 41,  117 => 40,  110 => 38,  105 => 37,  102 => 36,  99 => 35,  97 => 34,  91 => 33,  85 => 30,  81 => 29,  77 => 28,  72 => 26,  64 => 21,  58 => 17,  55 => 16,  52 => 15,  38 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} {{ \"home\"|trans }} {% endblock %}
{% block head %}   
    <!-- Bootstrap Core CSS -->
    <link href=\"/bootstrap/css/shop-item.css\" rel=\"stylesheet\">


    <!-- jQuery -->
    <script src=\"/js/product_script.js\"></script>

{% endblock %}


{% block content %}
    {% if product %}

        <div class=\"container\">
            <div class=\"row\">

                <span id=\"productID\" hidden>{{product.ID}}</span>
                <div class=\"col-md-9\">

                    <div class=\"thumbnail\"> 

                        <img class=\"img-responsive productPageImage\" src=\"data:image/png;base64,{{product.picture}}\" alt=\"product image\" width=\"200px\">
                        <div class=\"caption-full\">
                            <h4 id=\"productPrice\" class=\"pull-right\">\${{product.price}}</h4>
                            <h4>{{product.name}}</h4>
                            <p>{{product.description}}</p>
                        </div>
                        <div class=\"ratings\">
                            <p class=\"pull-right\" ><span id=\"reviewCount\">{{reviewCount}}</span> {{ \"reviews\"|trans }}</p>
                            <p>{% set k = ratingAverage  %}
                                {% if k == 0 %}
                                {% else %}
                                    {% for i in range(1,k) %}
                                        <span class=\"glyphicon glyphicon-star\"></span>
                                    {% endfor %}
                                {% endif %}
                                {% set t = (5 - ratingAverage) %}
                                {% if t == 5 %}
                                {% else %}
                                    {% for s in range(1,t) %}
                                        <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    {% endfor %}
                                {% endif %}

                                <span id=\"averageStars\">{{ratingAverage}}</span> {{ \"stars\"|trans }}</p>
                        </div>
                    </div>

                    <div class=\"well\">

                        <div class=\"text-right\">
                            <button class=\"btn btn-success\" id=\"leaveReview\">{{\"Leave a Review\"|trans}}</button>
                        </div>
                        <div id =\"reviewForm\">
                            <label>{{ \"Review\"|trans }}: </label><br><textarea rows=\"4\" cols=\"80\" name=\"reviewText\"></textarea><span class=\"error\"></span><br><br>
                            <label>{{ \"Rate\"|trans }}: </label>
                            <div id=\"selectedRating\">
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star1\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star2\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star3\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star4\"></span>
                                <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star5\"></span>
                            </div>        
                            <br><br> <button class=\"btn btn-success\" id=\"postReview\">{{\"Leave a Review\"|trans}}</button>
                        </div>

                        <hr>
                        <div id=\"reviewList\">

                        </div>
                    </div>
                    <ul class=\"pagination\">
                        <li><button id=\"previous\">«</button></li>
                        {% set t = totalPages %}
                         {% for i in 1..3 %}
                                        <li><button class=\"active\">{{i}}</button></li>
                                    {% endfor %}
                                    {% for i in range(1,t) %}
                                        <li><button class=\"active\">{{i}}</button></li>
                                    {% endfor %}
                        <li><button id=\"next\">»</button></li>
                    </ul>

                </div>

            </div>

        </div>

    {% else %}
        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            {% endif %}
        {% endblock %}  ";
    }
}
