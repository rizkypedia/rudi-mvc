<?php

namespace RudiMVC\Core;

use League\Plates\Engine;
use League\Plates\Extension\Asset;
use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\Services\ClassParser;
/**
 * Initiate the plates php template engine
 * https://platesphp.com/
 * Class RudiView
 * @package RudiMVC\Core
 */
class RudiView extends AbstractView {

    protected $template;

    public function __construct() {
        $this->template = new Engine();
        $this->template->addFolder('shared', VIEW_TEMPLATE_LAYOUT);
        $this->template->loadExtension(new Asset(WWW, false));
    }


    public function render(string $className, array $data)
    {
        $classParser = new ClassParser();
        $extractedControllerClass = $classParser->extractClassAndMethod($className);
        $this->template->addFolder($extractedControllerClass['controller'], VIEW_TEMPLATE . $extractedControllerClass['controller'] . DS);
        echo $this->template->render($extractedControllerClass['controller'] . "::" . $extractedControllerClass['action'], $data);
    }


}

