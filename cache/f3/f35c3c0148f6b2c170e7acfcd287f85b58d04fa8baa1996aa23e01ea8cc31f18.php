<?php

/* cart_view.html.twig */
class __TwigTemplate_783d1fe9aecf2d04bd9a4dd09f2300639558a74582eee109e6c8c1f581861699 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "cart_view.html.twig", 1);
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
   <h1>Show cart</h1>
  <?php
   \$cart = new cart();
   \$products = \$cart->getCart();
  ?>
  <table cellpadding=\"5\" cellspacing=\"0\" border=\"0\">
   <tr>
    <td align=\"left\" width=\"200\"><b>Product</b></td>
    <td align=\"left\" width=\"200\"><b>Count</b></td>
    <td align=\"left\" width=\"200\"><b>Total</b></td>
   </tr>
   <?php
    foreach(\$products as \$product){
   ?>
    <tr>
     <td align=\"left\"><?php print HtmlSpecialChars(\$product->product); ?></td>
     <td align=\"left\"><?php print \$product->count; ?></td>
     <td align=\"left\">\$<?php print \$product->total; ?></td>
    </tr>
   <?php 
    }
   ?>
  </table>
  <br /><a href=\"index.php\" title=\"go back to products\">Go back to products</a>
 
        </div>

    ";
        } else {
            // line 52
            echo "        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            ";
        }
        // line 54
        echo "        ";
    }

    public function getTemplateName()
    {
        return "cart_view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 54,  95 => 52,  58 => 17,  55 => 16,  52 => 15,  38 => 4,  30 => 3,  11 => 1,);
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
   <h1>Show cart</h1>
  <?php
   \$cart = new cart();
   \$products = \$cart->getCart();
  ?>
  <table cellpadding=\"5\" cellspacing=\"0\" border=\"0\">
   <tr>
    <td align=\"left\" width=\"200\"><b>Product</b></td>
    <td align=\"left\" width=\"200\"><b>Count</b></td>
    <td align=\"left\" width=\"200\"><b>Total</b></td>
   </tr>
   <?php
    foreach(\$products as \$product){
   ?>
    <tr>
     <td align=\"left\"><?php print HtmlSpecialChars(\$product->product); ?></td>
     <td align=\"left\"><?php print \$product->count; ?></td>
     <td align=\"left\">\$<?php print \$product->total; ?></td>
    </tr>
   <?php 
    }
   ?>
  </table>
  <br /><a href=\"index.php\" title=\"go back to products\">Go back to products</a>
 
        </div>

    {% else %}
        <h1>Product not found. <a href=\"\\\">Click to continue</a></h1>
            {% endif %}
        {% endblock %}  ";
    }
}
