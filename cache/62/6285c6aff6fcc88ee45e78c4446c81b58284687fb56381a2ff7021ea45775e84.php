<?php

/* index-products.html.twig */
class __TwigTemplate_ed39ef6ea1f4c3af0ea8615dea4996b70b0b588925e950ce211c097c60bade6b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prodList"]) ? $context["prodList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            echo "    
    <div class=\"col-sm-4 col-lg-4 col-md-4 div-products\">                          
        <div class=\"thumbnail product-thumbnail\">
            <img src=\"data:image/png;base64,";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"100px\">
            <a href=\"/cart\"><img src=\"/images/cart.png\" id=\"imgCart\" class=\"cart\" placeholder=\"Add to cart\"></a>
            <div class=\"caption\">
                <h4 class=\"pull-right\">\$ ";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
            echo "</h4>
                <h4><a href=\"/product/";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "productID", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name", array()), "html", null, true);
            echo "</a>
                </h4>
                <p>";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description", array()), "html", null, true);
            echo "</p>
            </div>
            <div class=\"ratings\">
                <p class=\"pull-right\">";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "totalReviews", array()), "html", null, true);
            echo " reviews</p>
                <p>
                    ";
            // line 15
            if (($this->getAttribute($context["product"], "average", array()) < 1)) {
                // line 16
                echo "                    ";
            } else {
                // line 17
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute($context["product"], "average", array())));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 18
                    echo "                            <span class=\"glyphicon glyphicon-star\" id=\"star-full\"></span>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                echo "                    ";
            }
            // line 21
            echo "                    ";
            $context["t"] = (5 - $this->getAttribute($context["product"], "average", array()));
            // line 22
            echo "                    ";
            if (($this->getAttribute($context["product"], "average", array()) > 4)) {
                // line 23
                echo "                    ";
            } else {
                // line 24
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                    // line 25
                    echo "                            <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 27
                echo "                    ";
            }
            // line 28
            echo "                </p>
            </div>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "index-products.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 28,  96 => 27,  89 => 25,  84 => 24,  81 => 23,  78 => 22,  75 => 21,  72 => 20,  65 => 18,  60 => 17,  57 => 16,  55 => 15,  50 => 13,  44 => 10,  37 => 8,  33 => 7,  27 => 4,  19 => 1,);
    }

    public function getSource()
    {
        return "{% for product in prodList %}    
    <div class=\"col-sm-4 col-lg-4 col-md-4 div-products\">                          
        <div class=\"thumbnail product-thumbnail\">
            <img src=\"data:image/png;base64,{{product.picture}}\" alt=\"product image\" width=\"100px\">
            <a href=\"/cart\"><img src=\"/images/cart.png\" id=\"imgCart\" class=\"cart\" placeholder=\"Add to cart\"></a>
            <div class=\"caption\">
                <h4 class=\"pull-right\">\$ {{ product.price }}</h4>
                <h4><a href=\"/product/{{product.productID}}\">{{ product.name }}</a>
                </h4>
                <p>{{ product.description }}</p>
            </div>
            <div class=\"ratings\">
                <p class=\"pull-right\">{{product.totalReviews}} reviews</p>
                <p>
                    {% if product.average < 1 %}
                    {% else %}
                        {% for i in range(1, product.average ) %}
                            <span class=\"glyphicon glyphicon-star\" id=\"star-full\"></span>
                        {% endfor %}
                    {% endif %}
                    {% set t = (5 - product.average) %}
                    {% if product.average > 4 %}
                    {% else %}
                        {% for s in range(1, t) %}
                            <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                        {% endfor %}
                    {% endif %}
                </p>
            </div>
        </div>
    </div>
{% endfor %}
";
    }
}
