<?php

namespace App\Core;

abstract class Controller
{
    protected function renderView(string $viewName, array $arguments = []): void
    {
        $filename = $this->getViewPath($viewName);

        // Return 404 page if view does not exist
        if (!file_exists($filename)) {
            $filename = $this->getViewPath("_404");
        }

        // Make all arguments to variables
        foreach ($arguments as $argumentName => $argumentValue) {
            $$argumentName = $argumentValue;
        }

        require $filename;
    }

    private function getViewPath(string $viewName): string
    {
        return dirname(__DIR__) . "/View/" . $viewName . ".view.php";
    }
}