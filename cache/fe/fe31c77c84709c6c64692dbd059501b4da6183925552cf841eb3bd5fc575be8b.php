<?php

/* product_addedit.html.twig */
class __TwigTemplate_7fc6cafb747a9b6ee8fd3e53abdf67094e74aba20f09e85139015719cece2a57 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "product_addedit.html.twig", 1);
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
        echo " Page add/edit product";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo " <script src=\"/js/product_addedit.js\"></script>";
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "    <div id=\"container-addedit_product\">
        <div id=\"top-side-addedit\">
            <div class = \"scrolltable\">
                <table>
                    <tr id = \"headRow\">
                        <th> Image </th>
                        <th> ID </th>
                        <th> Name </th>
                        <th> Category </th>
                        <th> Price </th>
                        <th> Nutr_Value </th>
                        <th> IsVeget </th>
                        <th> Slugname </th>
                        <th class = \"descriptionRow\"> Description </th>
                    </tr>
                </table>
                <div class = \"body\">
                    <table id = \"tbProducts\">
                        ";
        // line 25
        $context["catName"] = $this->getAttribute($this->getAttribute((isset($context["prodTable"]) ? $context["prodTable"] : null), 0, array(), "array"), "categoryName", array());
        echo " 
                        <tr class = \"categoryRow\">
                            <td colspan = \"10\">";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["catName"]) ? $context["catName"] : null), "html", null, true);
        echo " </td>
                        </tr> 
                        ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prodTable"]) ? $context["prodTable"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            echo " 
                            ";
            // line 30
            if (((isset($context["catName"]) ? $context["catName"] : null) == $this->getAttribute($context["product"], "categoryName", array()))) {
                // line 31
                echo "                                <tr class = \"productHeight\">
                                    <td> <img src = \"data:image/png;base64,";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "picture", array()), "html", null, true);
                echo "\" alt = \"product image\" width = \"100px\"> <br> <br>
                                        <button <button id = \"";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
                echo "\" class = \"btEdit\"> Edit </button></td>
                                    <td id = \"";
                // line 34
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
                echo "\" class = \"tdID\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 36
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "categoryName", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "nutritionalValue", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 39
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "isVegetarian", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 40
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "slugname", array()), "html", null, true);
                echo " </td>
                                    <td class = \"descriptionRow\">";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description", array()), "html", null, true);
                echo " </td>
                                </tr>
                            ";
            } else {
                // line 44
                echo "                                ";
                $context["catName"] = $this->getAttribute($context["product"], "categoryName", array());
                echo " 
                                <tr class = \"categoryRow\">
                                    <td colspan = \"10\">";
                // line 46
                echo twig_escape_filter($this->env, (isset($context["catName"]) ? $context["catName"] : null), "html", null, true);
                echo " </td>
                                </tr>
                                <tr class = \"productHeight\">
                                    <td> <img src = \"data:image/png;base64,";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "picture", array()), "html", null, true);
                echo "\" alt = \"product image\" width = \"100px\"> <br> <br>
                                        <button id = \"";
                // line 50
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
                echo "\" class = \"btEdit\"> Edit </button></td>
                                    <td class = \"tdID\">";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "categoryName", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 55
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "nutritionalValue", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 56
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "isVegetarian", array()), "html", null, true);
                echo " </td>
                                    <td>";
                // line 57
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "slugname", array()), "html", null, true);
                echo " </td>
                                    <td class = \"descriptionRow\">";
                // line 58
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description", array()), "html", null, true);
                echo " </td>
                                </tr>
                            ";
            }
            // line 60
            echo "                            
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo " 
                    </table>
                </div> 
            </div>
        </div>
        <div id = \"bottom-side-addedit\">


        </div>  
    </div> 
";
    }

    public function getTemplateName()
    {
        return "product_addedit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 61,  184 => 60,  178 => 58,  174 => 57,  170 => 56,  166 => 55,  162 => 54,  158 => 53,  154 => 52,  150 => 51,  146 => 50,  142 => 49,  136 => 46,  130 => 44,  124 => 41,  120 => 40,  116 => 39,  112 => 38,  108 => 37,  104 => 36,  100 => 35,  94 => 34,  90 => 33,  86 => 32,  83 => 31,  81 => 30,  75 => 29,  70 => 27,  65 => 25,  45 => 7,  42 => 6,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} Page add/edit product{% endblock %}
{% block head %} <script src=\"/js/product_addedit.js\"></script>{% endblock %}

{% block content %}
    <div id=\"container-addedit_product\">
        <div id=\"top-side-addedit\">
            <div class = \"scrolltable\">
                <table>
                    <tr id = \"headRow\">
                        <th> Image </th>
                        <th> ID </th>
                        <th> Name </th>
                        <th> Category </th>
                        <th> Price </th>
                        <th> Nutr_Value </th>
                        <th> IsVeget </th>
                        <th> Slugname </th>
                        <th class = \"descriptionRow\"> Description </th>
                    </tr>
                </table>
                <div class = \"body\">
                    <table id = \"tbProducts\">
                        {% set catName = prodTable[0].categoryName %} 
                        <tr class = \"categoryRow\">
                            <td colspan = \"10\">{{catName}} </td>
                        </tr> 
                        {% for product in prodTable %} 
                            {% if(catName == product.categoryName)%}
                                <tr class = \"productHeight\">
                                    <td> <img src = \"data:image/png;base64,{{product.picture}}\" alt = \"product image\" width = \"100px\"> <br> <br>
                                        <button <button id = \"{{product.ID}}\" class = \"btEdit\"> Edit </button></td>
                                    <td id = \"{{product.ID}}\" class = \"tdID\">{{product.ID}} </td>
                                    <td>{{product.name}} </td>
                                    <td>{{product.categoryName}} </td>
                                    <td>{{product.price}} </td>
                                    <td>{{product.nutritionalValue}} </td>
                                    <td>{{product.isVegetarian}} </td>
                                    <td>{{product.slugname}} </td>
                                    <td class = \"descriptionRow\">{{product.description}} </td>
                                </tr>
                            {% else %}
                                {% set catName = product.categoryName %} 
                                <tr class = \"categoryRow\">
                                    <td colspan = \"10\">{{catName}} </td>
                                </tr>
                                <tr class = \"productHeight\">
                                    <td> <img src = \"data:image/png;base64,{{product.picture}}\" alt = \"product image\" width = \"100px\"> <br> <br>
                                        <button id = \"{{product.ID}}\" class = \"btEdit\"> Edit </button></td>
                                    <td class = \"tdID\">{{product.ID}} </td>
                                    <td>{{product.name}} </td>
                                    <td>{{product.categoryName}} </td>
                                    <td>{{product.price}} </td>
                                    <td>{{product.nutritionalValue}} </td>
                                    <td>{{product.isVegetarian}} </td>
                                    <td>{{product.slugname}} </td>
                                    <td class = \"descriptionRow\">{{product.description}} </td>
                                </tr>
                            {% endif %}                            
                        {% endfor %} 
                    </table>
                </div> 
            </div>
        </div>
        <div id = \"bottom-side-addedit\">


        </div>  
    </div> 
{% endblock %}
";
    }
}
