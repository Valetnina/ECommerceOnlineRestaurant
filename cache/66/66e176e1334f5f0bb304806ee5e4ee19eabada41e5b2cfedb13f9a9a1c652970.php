<?php

/* reviews.html.twig */
class __TwigTemplate_a4f24e8500360d5c88cf56c59e14765640f6f8ed27ab0c903dd8e3601d5558b8 extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable((isset($context["reviewList"]) ? $context["reviewList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["rating"]) {
            // line 2
            echo "    <div class=\"row\" style=\"margin: 25px 0 0 0\">
        <div class=\"col-md-12\">
            ";
            // line 4
            $context["k"] = $this->getAttribute($context["rating"], "rating", array());
            // line 5
            echo "            ";
            if (((isset($context["k"]) ? $context["k"] : null) == 0)) {
                // line 6
                echo "            ";
            } else {
                // line 7
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["k"]) ? $context["k"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 8
                    echo "                    <span class=\"glyphicon glyphicon-star\"></span>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 10
                echo "            ";
            }
            // line 11
            echo "            ";
            $context["t"] = (5 - $this->getAttribute($context["rating"], "rating", array()));
            // line 12
            echo "            ";
            if (((isset($context["t"]) ? $context["t"] : null) == 5)) {
                // line 13
                echo "            ";
            } else {
                // line 14
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["t"]) ? $context["t"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                    // line 15
                    echo "                    <span class=\"glyphicon glyphicon-star-empty\" id=\"star-empty\"></span>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 17
                echo "            ";
            }
            // line 18
            echo "
            ";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "firstName", array()), "html", null, true);
            echo "
            <span class=\"pull-right\">";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "daysCount", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("days ago"), "html", null, true);
            echo "</span><br>
            <p>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["rating"], "review", array()), "html", null, true);
            echo "</p>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rating'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "reviews.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 21,  81 => 20,  77 => 19,  74 => 18,  71 => 17,  64 => 15,  59 => 14,  56 => 13,  53 => 12,  50 => 11,  47 => 10,  40 => 8,  35 => 7,  32 => 6,  29 => 5,  27 => 4,  23 => 2,  19 => 1,);
    }

    public function getSource()
    {
        return "{% for rating in reviewList %}
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
";
    }
}
