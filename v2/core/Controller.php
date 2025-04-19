<?php
namespace Core;

use Exception;

class Controller
{
    /**
     * Render a view by its name.
     *
     * @param string $name    Name of the view (without extension)
     * @param array  $data    Optional associative array of data to pass to the view
     * @throws Exception      If the view file does not exist
     */
    public function view(string $name, array $data = []): void
    {
        $filePath = ROOT . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $name . ".view.php";

        if (! file_exists($filePath)) {
            throw new Exception("View file '{$name}.view.php' not found at path: {$filePath}");
        }

        extract($data); // Converts array keys to variables
        require $filePath;
    }

    public function previewData($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
