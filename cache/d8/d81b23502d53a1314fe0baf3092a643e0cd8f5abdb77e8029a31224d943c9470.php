<?php

/* product_view.html.twig */
class __TwigTemplate_630e03845235895edf5ff3aab1b67521be54027ef5292287213e05ed08a600eb extends Twig_Template
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
        echo " Product View ";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo "   
    <!-- Custom CSS -->
        <link href=\"../bootstrap/css/shop-item.css\" rel=\"stylesheet\">
";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "    <div class=\"container\">

        <div class=\"row\">

            <div class=\"col-md-3\">
                <p class=\"lead\">Shop Name</p>
                <div class=\"list-group\">
                    <a href=\"#\" class=\"list-group-item active\">Category 1</a>
                    <a href=\"#\" class=\"list-group-item\">Category 2</a>
                    <a href=\"#\" class=\"list-group-item\">Category 3</a>
                </div>
            </div>

            <div class=\"col-md-9\">

                <div class=\"thumbnail\">
                    <img class=\"img-responsive\" src=\"http://placehold.it/800x300\" alt=\"\">
                    <div class=\"caption-full\">
                        <h4 class=\"pull-right\">\$24.99</h4>
                        <h4><a href=\"#\">Product Name</a>
                        </h4>
                        <p>See more snippets like these online store reviews at <a target=\"_blank\" href=\"http://bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                        <p>Want to make these reviews work? Check out
                            <strong><a href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this building a review system tutorial</a>
                            </strong>over at maxoffsky.com!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\">3 reviews</p>
                        <p>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            4.0 stars
                        </p>
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
        return array (  48 => 10,  45 => 9,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %} Product View {% endblock %}
{% block head %}   
    <!-- Custom CSS -->
        <link href=\"../bootstrap/css/shop-item.css\" rel=\"stylesheet\">
{% endblock %}

{% block content %}
    <div class=\"container\">

        <div class=\"row\">

            <div class=\"col-md-3\">
                <p class=\"lead\">Shop Name</p>
                <div class=\"list-group\">
                    <a href=\"#\" class=\"list-group-item active\">Category 1</a>
                    <a href=\"#\" class=\"list-group-item\">Category 2</a>
                    <a href=\"#\" class=\"list-group-item\">Category 3</a>
                </div>
            </div>

            <div class=\"col-md-9\">

                <div class=\"thumbnail\">
                    <img class=\"img-responsive\" src=\"http://placehold.it/800x300\" alt=\"\">
                    <div class=\"caption-full\">
                        <h4 class=\"pull-right\">\$24.99</h4>
                        <h4><a href=\"#\">Product Name</a>
                        </h4>
                        <p>See more snippets like these online store reviews at <a target=\"_blank\" href=\"http://bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                        <p>Want to make these reviews work? Check out
                            <strong><a href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this building a review system tutorial</a>
                            </strong>over at maxoffsky.com!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\">3 reviews</p>
                        <p>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            4.0 stars
                        </p>
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

{% endblock %}
    ";
    }
}
