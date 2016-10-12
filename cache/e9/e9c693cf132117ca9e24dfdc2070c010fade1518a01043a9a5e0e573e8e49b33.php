<?php

/* product_form.html.twig */
class __TwigTemplate_4b2d86b051cc27e9731c9393e3d1584f646a5fef093a5e7a2aaeab40e9e20c71 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('javascripts', $context, $blocks);
        // line 5
        echo "
<div id=\"left-side-addedit\">
    <label>ID: </label>
    <input type=\"number\" name=\"productID\" id=\"productID\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "ID", array()), "html", null, true);
        echo "\"><br><br>
    <label>Language: </label>
    <input type=\"text\" name=\"lang\" value=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "lang", array()), "html", null, true);
        echo "\"><br><br>
    <label>Product name: </label>
    <input type=\"text\" name=\"name\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "name", array()), "html", null, true);
        echo "\"><br><br>
    <label>Category: </label>
    <select id=\"categoryName\">
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categoryList"]) ? $context["categoryList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            echo "   
            <option>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "    </select><br><br>
    <label>Price: </label>
    <input type=\"text\" name=\"price\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "price", array()), "html", null, true);
        echo "\"><br><br>
    <label>Nutritional value: </label>
    <input type=\"text\" name=\"nutritionalValue\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "nutritionalValue", array()), "html", null, true);
        echo "\"><br><br>
    <label>Is vegetarian: </label>
    <input type=\"checkbox\" name=\"isVegetarian\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "isVegetarian", array()), "html", null, true);
        echo "\"><br><br>
    <label>Slug name: </label>
    <input type=\"text\" name=\"slugname\" value=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "slugname", array()), "html", null, true);
        echo "\"><br><br>
</div>
<div id=\"right-side-addedit\">
    <label  name=\"description\" style=\"text-align: left; width:100px;\">Description: </label><br>
    <textarea  name=\"description\" cols=\"62\" rows=\"6\">";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "description", array()), "html", null, true);
        echo "</textarea><br><br>
    <label style=\"text-align: left; width:100px;\">Image: </label>
    <input id=\"chooseImage\" type=\"file\" name=\"fileToUpload\">
    <div id=\"dvPreview\">
        <img id=\"uploadImage\" src=\"data:image/png;base64,";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product_form"]) ? $context["product_form"] : null), "picture", array()), "html", null, true);
        echo "\"  alt=\"product image\" width=\"160px\">
    </div><br><br>
</div>
    <div id = \"divButtons\">
        <button id = \"btAddPutProduct\" class = \"buttonStyle\"> Add / Edit product </button>
        <button id = \"btCancelProduct\" class = \"buttonStyle\"> Cancel </button>
    </div>";
    }

    // line 1
    public function block_javascripts($context, array $blocks = array())
    {
        // line 2
        echo "    
    
";
    }

    public function getTemplateName()
    {
        return "product_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 2,  101 => 1,  90 => 34,  83 => 30,  76 => 26,  71 => 24,  66 => 22,  61 => 20,  57 => 18,  49 => 16,  43 => 15,  37 => 12,  32 => 10,  27 => 8,  22 => 5,  20 => 1,);
    }

    public function getSource()
    {
        return "{% block javascripts %}
    
    
{% endblock %}

<div id=\"left-side-addedit\">
    <label>ID: </label>
    <input type=\"number\" name=\"productID\" id=\"productID\" value=\"{{product_form.ID}}\"><br><br>
    <label>Language: </label>
    <input type=\"text\" name=\"lang\" value=\"{{product_form.lang}}\"><br><br>
    <label>Product name: </label>
    <input type=\"text\" name=\"name\" value=\"{{product_form.name}}\"><br><br>
    <label>Category: </label>
    <select id=\"categoryName\">
        {% for category in categoryList %}   
            <option>{{category.name}}</option>
        {% endfor %}
    </select><br><br>
    <label>Price: </label>
    <input type=\"text\" name=\"price\" value=\"{{product_form.price}}\"><br><br>
    <label>Nutritional value: </label>
    <input type=\"text\" name=\"nutritionalValue\" value=\"{{product_form.nutritionalValue}}\"><br><br>
    <label>Is vegetarian: </label>
    <input type=\"checkbox\" name=\"isVegetarian\" value=\"{{product_form.isVegetarian}}\"><br><br>
    <label>Slug name: </label>
    <input type=\"text\" name=\"slugname\" value=\"{{product_form.slugname}}\"><br><br>
</div>
<div id=\"right-side-addedit\">
    <label  name=\"description\" style=\"text-align: left; width:100px;\">Description: </label><br>
    <textarea  name=\"description\" cols=\"62\" rows=\"6\">{{product_form.description}}</textarea><br><br>
    <label style=\"text-align: left; width:100px;\">Image: </label>
    <input id=\"chooseImage\" type=\"file\" name=\"fileToUpload\">
    <div id=\"dvPreview\">
        <img id=\"uploadImage\" src=\"data:image/png;base64,{{product_form.picture}}\"  alt=\"product image\" width=\"160px\">
    </div><br><br>
</div>
    <div id = \"divButtons\">
        <button id = \"btAddPutProduct\" class = \"buttonStyle\"> Add / Edit product </button>
        <button id = \"btCancelProduct\" class = \"buttonStyle\"> Cancel </button>
    </div>";
    }
}
