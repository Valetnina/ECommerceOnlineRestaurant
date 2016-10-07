<?php

/* rating.html.twig */
class __TwigTemplate_465f1aef3daf9b16f61e96cd8d2b9e706a8d917afcc4f0a3fedd1995f5fa708c extends Twig_Template
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
        echo "<p class=\"pull-right\" ><span>";
        echo twig_escape_filter($this->env, (isset($context["reviewCount"]) ? $context["reviewCount"] : null), "html", null, true);
        echo "</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("reviews"), "html", null, true);
        echo "</p>
<p>";
        // line 2
        $context["k"] = (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null);
        // line 3
        echo "    ";
        if (((isset($context["k"]) ? $context["k"] : null) == 0)) {
            // line 4
            echo "    ";
        } else {
            // line 5
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 6
                echo "            <span class=\"glyphicon glyphicon-star\"></span>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 8
            echo "    ";
        }
        // line 9
        echo "    ";
        $context["t"] = (5 - (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null));
        // line 10
        echo "    ";
        if (((isset($context["t"]) ? $context["t"] : null) == 5)) {
            // line 11
            echo "    ";
        } else {
            // line 12
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                // line 13
                echo "            <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "    ";
        }
        // line 16
        echo "
    <span id=\"averageStars\">";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["ratingAverage"]) ? $context["ratingAverage"] : null), "html", null, true);
        echo "</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("stars"), "html", null, true);
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "rating.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 17,  73 => 16,  70 => 15,  63 => 13,  58 => 12,  55 => 11,  52 => 10,  49 => 9,  46 => 8,  39 => 6,  34 => 5,  31 => 4,  28 => 3,  26 => 2,  19 => 1,);
    }

    public function getSource()
    {
        return "<p class=\"pull-right\" ><span>{{reviewCount}}</span> {{ \"reviews\"|trans }}</p>
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

    <span id=\"averageStars\">{{ratingAverage}}</span> {{ \"stars\"|trans }}</p>";
    }
}
