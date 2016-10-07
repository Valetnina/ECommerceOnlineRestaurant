<?php

/* product_view.html.twig */
class __TwigTemplate_ff6efdd8cf7bed117f5967e13016f6d310a14a2cb5478916b2f8042eeabda257 extends Twig_Template
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
                        <div>
                            <img src=\"/images/calories.png\" alt=\"nutritional value\" style=\"width:50px;\"><span>Calories: ";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "nutritionalValue", array()), "html", null, true);
            echo "</span>
                        </div>
                        <div class=\"ratings\" id=\"ratingsProduct\">

                        </div>
                        <div style=\"text-align: center; margin-bottom:20px;\">
                            <input type=\"hidden\" id=\"productID\" value=\"";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "\">
                            <form method=\"POST\" action=\"/cart\">
                            Quantity: <input type=\"number\" value=\"1\" style=\"width: 30px;\"><br><br>
                            <input type=\"submit\" value=\"addToCart\">
                        </div>
                    </div>

                    <div class=\"well\">

                        <div class=\"text-right\">
                            <button class=\"btn btn-success\" id=\"leaveReview\">";
            // line 49
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                        </div>
                        <div id =\"reviewForm\">
                            <label>";
            // line 52
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Review"), "html", null, true);
            echo ": </label><br><textarea rows=\"4\" cols=\"80\" name=\"reviewText\"></textarea><span class=\"error\"></span><br><br>
                            <label>";
            // line 53
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
            // line 61
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leave a Review"), "html", null, true);
            echo "</button>
                        </div>

                        <hr>
                        <div id=\"reviewList\">

                        </div>
                    </div>
                    <ul class=\"pagination\">
                        <span id=\"totalPages\" hidden>";
            // line 70
            echo twig_escape_filter($this->env, (isset($context["totalPages"]) ? $context["totalPages"] : null), "html", null, true);
            echo "</span>
                        <li><button id=\"previous\">«</button></li>
                        <!--    ";
            // line 72
            if (((isset($context["totalPages"]) ? $context["totalPages"] : null) > 3)) {
                // line 73
                echo "                                ";
                $context["t"] = 3;
                // line 74
                echo "
                        ";
            } else {
                // line 76
                echo "                            ";
                $context["t"] = (isset($context["totalPages"]) ? $context["totalPages"] : null);
                // line 77
                echo "
                        ";
            }
            // line 78
            echo " -->

                        ";
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["totalPages"]) ? $context["totalPages"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 81
                echo "                            <li><button id=\"pageButton_";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\" class=\"pageButton\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</button></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 83
            echo "                        <li><button id=\"next\">»</button></li>
                    </ul>

                </div>

            </div>

        </div>

    ";
        } else {
            // line 93
            echo "        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            ";
        }
        // line 95
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
        return array (  202 => 95,  198 => 93,  186 => 83,  175 => 81,  171 => 80,  167 => 78,  163 => 77,  160 => 76,  156 => 74,  153 => 73,  151 => 72,  146 => 70,  134 => 61,  123 => 53,  119 => 52,  113 => 49,  100 => 39,  91 => 33,  85 => 30,  81 => 29,  77 => 28,  72 => 26,  64 => 21,  58 => 17,  55 => 16,  52 => 15,  38 => 4,  30 => 3,  11 => 1,);
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
                        <div>
                            <img src=\"/images/calories.png\" alt=\"nutritional value\" style=\"width:50px;\"><span>Calories: {{product.nutritionalValue}}</span>
                        </div>
                        <div class=\"ratings\" id=\"ratingsProduct\">

                        </div>
                        <div style=\"text-align: center; margin-bottom:20px;\">
                            <input type=\"hidden\" id=\"productID\" value=\"{{product.ID}}\">
                            <form method=\"POST\" action=\"/cart\">
                            Quantity: <input type=\"number\" value=\"1\" style=\"width: 30px;\"><br><br>
                            <input type=\"submit\" value=\"addToCart\">
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
                        <span id=\"totalPages\" hidden>{{totalPages}}</span>
                        <li><button id=\"previous\">«</button></li>
                        <!--    {% if  totalPages > 3 %}
                                {% set t = 3 %}

                        {% else %}
                            {% set t = totalPages %}

                        {% endif %} -->

                        {% for i in 1..totalPages %}
                            <li><button id=\"pageButton_{{i}}\" class=\"pageButton\">{{i}}</button></li>
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
