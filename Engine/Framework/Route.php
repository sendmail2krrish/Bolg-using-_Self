<?php
namespace _Self;

final class Route
{
    /**
     * Use to store path.
     */

    private $currentUrl;

    /**
     * Use to store request method.
     */

    private $httpVarb;

    /**
     * Constructor loads & store request method & path.
     * @return void
     */

    public function __construct()
    {
        $this->httpVarb   = $_SERVER['REQUEST_METHOD'];
        $this->currentUrl = $_GET["url"] === "index.php" ? "/" : substr($_GET['url'], -1) === '/' ? "/" . substr($_GET['url'], 0, -1) : "/" . $_GET['url'];
    }

    /**
     * Helps to create get route.
     * @params string $url
     * @params string $action
     * @return void
     */

    public function get($uri, $action)
    {
        if ($this->httpVarb === 'GET') {
            $this->set($uri, $action);
        }
    }

    /**
     * Helps to create post route.
     * @params string $url
     * @params string $action
     * @return void
     */

    public function post($uri, $action)
    {
        if ($this->httpVarb === 'POST') {
            $this->set($uri, $action);
        }
    }

    /**
     * Check route & current URL and seperate all the params passing through the URL.
     * @params string $url & string $action
     * @return void
     */

    private function set($uri, $action)
    {
        if ($this->currentUrl === $uri) {
            $this->loadAction($action);
            exit;
        } else {
            $routeUrl   = explode('/', $uri);
            $requestUrl = explode('/', $this->currentUrl);

            $params  = [];
            $route   = [];
            $request = [];

            foreach ($routeUrl as $key => $ru) {
                if (!empty($ru) && $ru[0] === ":") {
                    $params[substr($ru, 1)] = $requestUrl[$key];
                    $routeUrl[$key]         = $requestUrl[$key];
                }
            }

            $routeUrl   = implode('/', $routeUrl);
            $requestUrl = implode('/', $requestUrl);

            if ($routeUrl === $requestUrl) {
                $this->loadAction($action, $params);
                exit;
            }

        }
    }

    /**
     * Use to load controller & method as per route.
     * @params string $action
     * @params array $params
     * @return void
     */

    private function loadAction($action, $params = [])
    {
        $action = explode('@', $action);
        $class  = $action[0];
        $method = $action[1];

        $appInstance = new $class();
        if (empty($params)) {
            $appInstance->$method();
        } else {
            $appInstance->$method($params);
        }
    }

}
