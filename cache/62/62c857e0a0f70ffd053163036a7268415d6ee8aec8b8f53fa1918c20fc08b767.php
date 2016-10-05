<?php

/* product_view.html.twig */
class __TwigTemplate_7de322f0bf9e1837ba0bfeb94ae4e97cfc1f1298a5e44123d45303d1e73de66d extends Twig_Template
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
        <link href=\"../../bootstrap/css/shop-item.css\" rel=\"stylesheet\">
        

     <!-- jQuery -->
    <script src=\"../../js/product_script.js\"></script>

";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        if ((isset($context["product"]) ? $context["product"] : null)) {
            // line 17
            echo "    
<ul>
    <li><a href=\"?lang=en_US\">English</a></li>
    <li><a href=\"?lang=fr_CA\">Francais</a></li> 
     <li><a href=\"/product/";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "/en\">English</a></li>
     <li><a href=\"/product/";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "/fr\">Francais</a></li>
</ul>
    <div class=\"container\">
        <span id=\"productID\" visibility=\"hidden\">";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "ID", array()), "html", null, true);
            echo "</span>
        <div class=\"row\">

          
            <div class=\"col-md-9\">

                <div class=\"thumbnail\">

                    <img class=\"img-responsive productPageImage\" src=\"data:image/png;base64,";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"200px\">
                    <div class=\"caption-full\">
                        <h4 id=\"productPrice\" class=\"pull-right\">\$";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "price", array()), "html", null, true);
            echo "</h4>
                        <h4>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name_EN", array()), "html", null, true);
            echo "</h4>
                        <p>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "description_EN", array()), "html", null, true);
            echo "</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\" id=\"reviewCount\">";
            // line 40
            echo twig_escape_filter($this->env, (isset($context["reviewCount"]) ? $context["reviewCount"] : null), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("reviews"), "html", null, true);
            echo "</p>
                        <p id=\"averageStars\">";
            // line 41
            echo twig_escape_filter($this->env, (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null), "html", null, true);
            echo "</p>
                            
                        
                    </div>
                </div>

                <div class=\"well\">

                    <div class=\"text-right\">
                        <a class=\"btn btn-success\">Leave a Review</a>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">12 days ago</span>
                            <p>I've alredy ordered another one!</p>
                        </div>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">15 days ago</span>
                            <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

";
        } else {
            // line 107
            echo "    <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
";
        }
        // line 109
        echo "  ";
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
        return array (  182 => 109,  178 => 107,  109 => 41,  103 => 40,  97 => 37,  93 => 36,  89 => 35,  84 => 33,  73 => 25,  67 => 22,  63 => 21,  57 => 17,  55 => 16,  52 => 15,  38 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} {{ \"home\"|trans }} {% endblock %}
{% block head %}   
     <!-- Bootstrap Core CSS -->
        <link href=\"../../bootstrap/css/shop-item.css\" rel=\"stylesheet\">
        

     <!-- jQuery -->
    <script src=\"../../js/product_script.js\"></script>

{% endblock %}


{% block content %}
{% if product %}
    
<ul>
    <li><a href=\"?lang=en_US\">English</a></li>
    <li><a href=\"?lang=fr_CA\">Francais</a></li> 
     <li><a href=\"/product/{{product.ID}}/en\">English</a></li>
     <li><a href=\"/product/{{product.ID}}/fr\">Francais</a></li>
</ul>
    <div class=\"container\">
        <span id=\"productID\" visibility=\"hidden\">{{product.ID}}</span>
        <div class=\"row\">

          
            <div class=\"col-md-9\">

                <div class=\"thumbnail\">

                    <img class=\"img-responsive productPageImage\" src=\"data:image/png;base64,{{product.picture}}\" alt=\"product image\" width=\"200px\">
                    <div class=\"caption-full\">
                        <h4 id=\"productPrice\" class=\"pull-right\">\${{product.price}}</h4>
                        <h4>{{product.name_EN}}</h4>
                        <p>{{product.description_EN}}</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\" id=\"reviewCount\">{{reviewCount}} {{ \"reviews\"|trans }}</p>
                        <p id=\"averageStars\">{{ratingAverage}}</p>
                            
                        
                    </div>
                </div>

                <div class=\"well\">

                    <div class=\"text-right\">
                        <a class=\"btn btn-success\">Leave a Review</a>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">12 days ago</span>
                            <p>I've alredy ordered another one!</p>
                        </div>
                    </div>

                    <hr>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            Anonymous
                            <span class=\"pull-right\">15 days ago</span>
                            <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

{% else %}
    <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
{% endif %}
  {% endblock %}  ";
    }
}
