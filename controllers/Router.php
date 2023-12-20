<?php 
class Router {
    private $_controller;
    private $_view;

    public function route() {
        try {
            spl_autoload_register(function($class) {
                require_once('models/'.$class.'.php');
            });

            $url = '';

            // Le contrôleur est inclus selon l'action de l'utilisateur
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_controller = new $controllerClass($url);
                }
                else
                    throw new Exception('Page introuvable');
            }
            else {
                require_once('controllers/ControllerAccueil.php');
                $this->_controller = new ControllerAccueil($url);
            }
        }
        // Gestion des erreurs
        catch (Exception $e) {
            $error_msg = $e->getMessage();
            require_once('views/Error.php');
        }
    }

}
?>