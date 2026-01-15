<?php
class Controller
{
    public function view($view, $data)
    {
        $viewFile = VIEW_PATH . "/$view" . ".php";
        if (!file_exists($viewFile)) {
            throw new Exception("view file not found");
        }
        extract($data, EXTR_SKIP);
        require $viewFile;
    }
    // product ->
    public function model($name)
    {
        $class = ucfirst($name);
        if (!class_exists($class)) {
            throw new Exception("class not found");
        }
        return new $class();
    }

    public function redirect($path)
    {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        $target = $base . '/' . ltrim($path, '/');
        header('Location: ' . $target);
        exit;
    }

    public function notFound($message): void
    {
        http_response_code(404);
        /**
         * sau nay co the load theo view errors
         */
        echo "controller Not Found - ' . $message. </h1>";
    }
}