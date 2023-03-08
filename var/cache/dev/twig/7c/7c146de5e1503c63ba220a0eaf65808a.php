<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* teacher/list.html.twig */
class __TwigTemplate_e4584f45b3485fa3f1b359c0481911f3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "teacher/list.html.twig"));

        // line 1
        echo "<h1>Teachers</h1>
<div class=\"addTeacher\">
    <a href=";
        // line 3
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("teacher_create");
        echo "> Add a new teacher </a>
</div>
<div class=\"teachers\">
    <table>
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["teachers"]) || array_key_exists("teachers", $context) ? $context["teachers"] : (function () { throw new RuntimeError('Variable "teachers" does not exist.', 7, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["teacher"]) {
            // line 8
            echo "            <tr>
                <td> ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["teacher"], "id", [], "any", false, false, false, 9), "html", null, true);
            echo " </td>
                <td> ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["teacher"], "name", [], "any", false, false, false, 10), "html", null, true);
            echo " </td>
                <td> ";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["teacher"], "firstName", [], "any", false, false, false, 11), "html", null, true);
            echo " </td>
                <td> ";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["teacher"], "email", [], "any", false, false, false, 12), "html", null, true);
            echo " </td>
                <td> <a href=";
            // line 13
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("teacher_update", ["id" => twig_get_attribute($this->env, $this->source, $context["teacher"], "id", [], "any", false, false, false, 13)]), "html", null, true);
            echo ">Edit</a> </td>
                <td> <a href=";
            // line 14
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("teacher_delete", ["id" => twig_get_attribute($this->env, $this->source, $context["teacher"], "id", [], "any", false, false, false, 14)]), "html", null, true);
            echo ">Remove</a> </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['teacher'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "    </table>
</div>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "teacher/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 17,  78 => 14,  74 => 13,  70 => 12,  66 => 11,  62 => 10,  58 => 9,  55 => 8,  51 => 7,  44 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1>Teachers</h1>
<div class=\"addTeacher\">
    <a href={{ path('teacher_create') }}> Add a new teacher </a>
</div>
<div class=\"teachers\">
    <table>
        {% for teacher in teachers %}
            <tr>
                <td> {{ teacher.id }} </td>
                <td> {{ teacher.name }} </td>
                <td> {{ teacher.firstName }} </td>
                <td> {{ teacher.email }} </td>
                <td> <a href={{ path('teacher_update', {id: teacher.id}) }}>Edit</a> </td>
                <td> <a href={{ path('teacher_delete', {id: teacher.id}) }}>Remove</a> </td>
            </tr>
        {% endfor %}
    </table>
</div>", "teacher/list.html.twig", "C:\\Users\\mwarmee\\Documents\\Cours\\WEB\\Prof-Advisor\\templates\\teacher\\list.html.twig");
    }
}
