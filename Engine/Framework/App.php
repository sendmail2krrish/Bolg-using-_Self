<?php
namespace _Self;

final class App
{
    /**
     * Use to store aliases.
     */
    private $aliases;

    /**
     * Constructor loads & store all the aliases.
     * @return void
     */
    public function __construct()
    {
        $this->aliases = $GLOBALS['aliases'];
    }

    /**
     * Main method to run the framework.
     * This method loads all the necessarily models & controllers.
     * @return void
     */
    public function run()
    {
        spl_autoload_register(function ($class) {
            $this->loadModel(str_replace('\\', '/', $class));
            $this->loadController(str_replace('\\', '/', $class));
        });

        $this->loadRoutes();
    }

    /**
     * Use to load model from their alias
     * @params string $model
     * @return void
     */
    private function loadModel($model)
    {
        foreach ($this->aliases as $alias) {
            if (file_exists("../Modules/" . $alias . "/models/" . ucfirst($model) . ".php")) {
                require_once "../Modules/" . $alias . "/models/" . ucfirst($model) . ".php";
            }
        }
    }

    /**
     * Use to load controller from their alias
     * @params string $controller
     * @return void
     */
    private function loadController($controller)
    {
        foreach ($this->aliases as $alias) {
            if (file_exists("../Modules/" . $alias . "/controllers/" . ucfirst($controller) . ".php")) {
                require_once "../Modules/" . $alias . "/controllers/" . ucfirst($controller) . ".php";
            }
        }
    }

    /**
     * Use to load routes from their alias
     * @return void
     */
    private function loadRoutes()
    {
        foreach ($this->aliases as $alias) {
            require_once '../Modules/' . $alias . '/route.php';
        }
    }
}
