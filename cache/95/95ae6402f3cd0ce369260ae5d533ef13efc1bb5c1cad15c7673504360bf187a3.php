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
    <link href=\"../../../bootstrap/css/shop-item.css\" rel=\"stylesheet\">


    <!-- jQuery -->
    <script src=\"../../../js/product_script.js\"></script>

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
        <ul>
            <li><a href=\"?lang=en\">English</a></li>
            <li><a href=\"?lang=fr   \">Francais</a></li> 

        </ul>
        <div class=\"container\">
            <div class=\"row\">

                <span id=\"productID\" hidden>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "</span>
                <div class=\"col-md-9\">

                    <div class=\"thumbnail\">

                        <img class=\"img-responsive productPageImage\" src=\"data:image/png;base64,";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"200px\">
                        <div class=\"caption-full\">
                            <h4 id=\"productPrice\" class=\"pull-right\">\$";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "price", array()), "html", null, true);
            echo "</h4>
                            <h4>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name", array()), "html", null, true);
            echo "</h4>
                            <p>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "description", array()), "html", null, true);
            echo "</p>
                        </div>
                        <div class=\"ratings\">
                            <p class=\"pull-right\" ><span id=\"reviewCount\">";
            // line 38
            echo twig_escape_filter($this->env, (isset($context["reviewCount"]) ? $context["reviewCount"] : null), "html", null, true);
            echo "</span> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("reviews"), "html", null, true);
            echo "</p>
                            <p><span id=\"averageStars\">";
            // line 39
            echo twig_escape_filter($this->env, (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null), "html", null, true);
            echo "</span> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("stars"), "html", null, true);
            echo "</p>
                        </div>
                    </div>

                    <div class=\"well\">

                        <div class=\"text-right\">
                        <button class=\"btn btn-success\" id=\"leaveReview\">";
            // line 46
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                    </div>
                        <div id =\"reviewForm\">
                            <label>";
            // line 49
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Review"), "html", null, true);
            echo ": </label><br><textarea rows=\"4\" cols=\"80\" name=\"reviewText\"></textarea><span class=\"error\"></span><br><br>
                            <label>";
            // line 50
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Rate"), "html", null, true);
            echo ": </label>
 
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star1\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star2\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star3\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star4\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star5\"></span>
                                    
                               <br><br> <button class=\"btn btn-success\" id=\"postReview\">";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                        </div>
                            
                       <hr>
                       <div id=\"reviewList\">
                       ";
            // line 63
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["reviewList"]) ? $context["reviewList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["rating"]) {
                // line 64
                echo "                        <div class=\"row\" style=\"margin: 25px 0 0 0\">
                            <div class=\"col-md-12\">
                                ";
                // line 66
                $context["k"] = $this->getAttribute($context["rating"], "rating", array());
                // line 67
                echo "                                ";
                if (((isset($context["k"]) ? $context["k"] : null) == 0)) {
                    // line 68
                    echo "                                    ";
                } else {
                    // line 69
                    echo "                                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 70
                        echo "                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 72
                    echo "                                    ";
                }
                // line 73
                echo "                                    ";
                $context["t"] = (5 - $this->getAttribute($context["rating"], "rating", array()));
                // line 74
                echo "                                    ";
                if (((isset($context["t"]) ? $context["t"] : null) == 5)) {
                    // line 75
                    echo "                                        ";
                } else {
                    // line 76
                    echo "                                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
                    foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                        // line 77
                        echo "                                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 79
                    echo "                                                                        ";
                }
                // line 80
                echo "
                                ";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "firstName", array()), "html", null, true);
                echo "
                                <span class=\"pull-right\">";
                // line 82
                echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "daysCount", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("days ago"), "html", null, true);
                echo "</span><br>
                                <p>";
                // line 83
                echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "review", array()), "html", null, true);
                echo "</p>
                            </div>
                        </div>
                           ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rating'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "                       </div>
                    </div>
<ul class=\"pagination\">
  <li><button id=\"page\">1</button></li>
  <li><button id=\"page\">1</button></li>

  <li><a href=\"#\">3</a></li>
  <li><a href=\"#\">4</a></li>
  <li><a href=\"#\">5</a></li>
</ul>
                </div>

            </div>

        </div>

    ";
        } else {
            // line 104
            echo "        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            ";
        }
        // line 106
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
        return array (  244 => 106,  240 => 104,  221 => 87,  211 => 83,  205 => 82,  201 => 81,  198 => 80,  195 => 79,  188 => 77,  183 => 76,  180 => 75,  177 => 74,  174 => 73,  171 => 72,  164 => 70,  159 => 69,  156 => 68,  153 => 67,  151 => 66,  147 => 64,  143 => 63,  135 => 58,  124 => 50,  120 => 49,  114 => 46,  102 => 39,  96 => 38,  90 => 35,  86 => 34,  82 => 33,  77 => 31,  69 => 26,  58 => 17,  55 => 16,  52 => 15,  38 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} {{ \"home\"|trans }} {% endblock %}
{% block head %}   
    <!-- Bootstrap Core CSS -->
    <link href=\"../../../bootstrap/css/shop-item.css\" rel=\"stylesheet\">


    <!-- jQuery -->
    <script src=\"../../../js/product_script.js\"></script>

{% endblock %}


{% block content %}
    {% if product %}

        <ul>
            <li><a href=\"?lang=en\">English</a></li>
            <li><a href=\"?lang=fr   \">Francais</a></li> 

        </ul>
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
                            <p><span id=\"averageStars\">{{ratingAverage}}</span> {{ \"stars\"|trans }}</p>
                        </div>
                    </div>

                    <div class=\"well\">

                        <div class=\"text-right\">
                        <button class=\"btn btn-success\" id=\"leaveReview\">{{\"Leave a Review\"|trans}}</button>
                    </div>
                        <div id =\"reviewForm\">
                            <label>{{ \"Review\"|trans }}: </label><br><textarea rows=\"4\" cols=\"80\" name=\"reviewText\"></textarea><span class=\"error\"></span><br><br>
                            <label>{{ \"Rate\"|trans }}: </label>
 
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star1\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star2\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star3\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star4\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty reviewEmptyStar\" id=\"star5\"></span>
                                    
                               <br><br> <button class=\"btn btn-success\" id=\"postReview\">{{\"Leave a Review\"|trans}}</button>
                        </div>
                            
                       <hr>
                       <div id=\"reviewList\">
                       {% for rating in reviewList %}
                        <div class=\"row\" style=\"margin: 25px 0 0 0\">
                            <div class=\"col-md-12\">
                                {% set k = rating.rating  %}
                                {% if k == 0 %}
                                    {% else %}
                                    {% for i in range(1,k) %}
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    {% endfor %}
                                    {% endif %}
                                    {% set t = (5 - rating.rating) %}
                                    {% if t == 5 %}
                                        {% else %}
                                    {% for s in range(1,t) %}
                                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    {% endfor %}
                                                                        {% endif %}

                                {{rating.firstName}}
                                <span class=\"pull-right\">{{rating.daysCount }} {{\"days ago\"|trans}}</span><br>
                                <p>{{rating.review}}</p>
                            </div>
                        </div>
                           {% endfor %}
                       </div>
                    </div>
<ul class=\"pagination\">
  <li><button id=\"page\">1</button></li>
  <li><button id=\"page\">1</button></li>

  <li><a href=\"#\">3</a></li>
  <li><a href=\"#\">4</a></li>
  <li><a href=\"#\">5</a></li>
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
