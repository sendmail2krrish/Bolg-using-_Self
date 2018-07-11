<?php
namespace _Self;

final class View
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

    public function make($file, $data = [])
    {
        foreach ($this->aliases as $alias) {
            if (strpos(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0]['file'], "/Modules/" . $alias . "/")) {
                include "../Modules/" . $alias . "/views/" . $file . ".php";
            }
        }
    }
}
