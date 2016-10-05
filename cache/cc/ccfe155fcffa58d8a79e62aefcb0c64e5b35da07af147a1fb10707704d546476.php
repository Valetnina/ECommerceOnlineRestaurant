<?php

/* index.html.twig */
class __TwigTemplate_db6ee13b7975ae4eb6b3fa133965f4d554a564262b0df1494a487c36589de8ec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
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
        echo " E-Shop";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        echo "   
    <!-- Custom CSS -->
     <link href=\"../bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "  
     <!-- Page Content -->
    <div class=\"container\">

        
            <div class=\"col-md-9\" style=\"width:100%; margin-bottom:50px;\">

                    

                    <div class=\"col-md-12\">
                        <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
                            <ol class=\"carousel-indicators\">
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>
                            </ol>
                            <div class=\"carousel-inner\">
                                <div class=\"item active\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                                <div class=\"item\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                                <div class=\"item\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                            </div>
                            <a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">
                                <span class=\"glyphicon glyphicon-chevron-left\"></span>
                            </a>
                            <a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">
                                <span class=\"glyphicon glyphicon-chevron-right\"></span>
                            </a>
                        </div>
                    </div>

                </div>
<div class=\"row\">

            <div class=\"col-md-3 myClass\" style=\"height:800px\">
                <p class=\"lead\">Shop Name</p>
                <div class=\"list-group\">
                    <a href=\"#\" class=\"list-group-item\">Category 1</a>
                    <a href=\"#\" class=\"list-group-item\">Category 2</a>
                    <a href=\"#\" class=\"list-group-item\">Category 3</a>
                </div>
            </div>

                <div class=\"row\">

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$24.99</h4>
                                <h4><a href=\"#\">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target=\"_blank\" href=\"http://www.bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">15 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$64.99</h4>
                                <h4><a href=\"#\">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">12 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$74.99</h4>
                                <h4><a href=\"#\">Third Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">31 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$84.99</h4>
                                <h4><a href=\"#\">Fourth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">6 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$94.99</h4>
                                <h4><a href=\"#\">Fifth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">18 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <h4><a href=\"#\">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target=\"_blank\" href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class=\"btn btn-primary\" target=\"_blank\" href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">View Tutorial</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
    
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
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

{% block title %} E-Shop{% endblock %}
{% block head %}   
    <!-- Custom CSS -->
     <link href=\"../bootstrap/css/shop-homepage.css\" rel=\"stylesheet\">
{% endblock %}

{% block content %}
  
     <!-- Page Content -->
    <div class=\"container\">

        
            <div class=\"col-md-9\" style=\"width:100%; margin-bottom:50px;\">

                    

                    <div class=\"col-md-12\">
                        <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
                            <ol class=\"carousel-indicators\">
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>
                                <li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>
                            </ol>
                            <div class=\"carousel-inner\">
                                <div class=\"item active\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                                <div class=\"item\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                                <div class=\"item\">
                                    <img class=\"slide-image\" src=\"http://placehold.it/800x300\" alt=\"\">
                                </div>
                            </div>
                            <a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">
                                <span class=\"glyphicon glyphicon-chevron-left\"></span>
                            </a>
                            <a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">
                                <span class=\"glyphicon glyphicon-chevron-right\"></span>
                            </a>
                        </div>
                    </div>

                </div>
<div class=\"row\">

            <div class=\"col-md-3 myClass\" style=\"height:800px\">
                <p class=\"lead\">Shop Name</p>
                <div class=\"list-group\">
                    <a href=\"#\" class=\"list-group-item\">Category 1</a>
                    <a href=\"#\" class=\"list-group-item\">Category 2</a>
                    <a href=\"#\" class=\"list-group-item\">Category 3</a>
                </div>
            </div>

                <div class=\"row\">

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$24.99</h4>
                                <h4><a href=\"#\">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target=\"_blank\" href=\"http://www.bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">15 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$64.99</h4>
                                <h4><a href=\"#\">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">12 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$74.99</h4>
                                <h4><a href=\"#\">Third Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">31 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$84.99</h4>
                                <h4><a href=\"#\">Fourth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">6 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <div class=\"thumbnail\">
                            <img src=\"http://placehold.it/320x150\" alt=\"\">
                            <div class=\"caption\">
                                <h4 class=\"pull-right\">\$94.99</h4>
                                <h4><a href=\"#\">Fifth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class=\"ratings\">
                                <p class=\"pull-right\">18 reviews</p>
                                <p>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star\"></span>
                                    <span class=\"glyphicon glyphicon-star-empty\"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"col-sm-4 col-lg-4 col-md-4\">
                        <h4><a href=\"#\">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target=\"_blank\" href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class=\"btn btn-primary\" target=\"_blank\" href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">View Tutorial</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
    
{% endblock %}";
    }
}
