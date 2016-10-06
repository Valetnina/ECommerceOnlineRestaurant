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
            // line 2
            echo "                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"data:image/png;base64,";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "picture", array()), "html", null, true);
            echo "\" alt=\"product image\" width=\"100px\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
            echo "</h4>
                                <h4><a href=\"#\">";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name_EN", array()), "html", null, true);
            echo "</a>
                                </h4>
                                <p>";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description_EN", array()), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "average", array()), "html", null, true);
            echo " reviews</p>
                                <p>
                                    ";
            // line 14
            $context["k"] = $this->getAttribute($context["product"], "average", array());
            // line 15
            echo "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 16
                echo "                                    <span class=\"glyphicon glyphicon-star\" id=\"star-full\"></span>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "                                    ";
            $context["t"] = (5 - $this->getAttribute($context["product"], "average", array()));
            // line 19
            echo "                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                // line 20
                echo "                                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "                                </p>
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
        return array (  81 => 22,  74 => 20,  69 => 19,  66 => 18,  59 => 16,  54 => 15,  52 => 14,  47 => 12,  41 => 9,  36 => 7,  32 => 6,  27 => 4,  23 => 2,  19 => 1,);
    }

    public function getSource()
    {
        return "{% for product in prodList %}
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
                                <p class=\"pull-right\">{{product.average}} reviews</p>
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
";
    }
}
