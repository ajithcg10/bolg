<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/CategoriesController.php';
class Router 

{
    private $routes = [];
    public function add($uri,$callback)
    {
        $this->routes[$uri]=$callback ;
    }
    public function resolve($reqiure)
    {
        $callback = $this->routes[$reqiure] ?? null;
     
        if($reqiure == "/user-register"){
            $authController = new AuthController($reqiure);
            return $authController->register();
        }elseif(($reqiure == "/login-form")){
            $authController = new AuthController($reqiure);
            return $authController->login();
        }
        elseif($reqiure == "/logout"){
            $authController = new AuthController($reqiure);
            return $authController->logout();
        }
        elseif($reqiure == "/user-update"){
            $authController = new AuthController($reqiure);
            return $authController->updateUser();
        }
        elseif($reqiure == "/delete_user"){
            $authController = new AuthController($reqiure);
            return $authController->deleteUser();
        }
        elseif($reqiure == "/categorey_add"){
            $CategoriesController = new CategoriesController();
            return $CategoriesController->addcategorey();
        }
        elseif($reqiure == "/update-category"){
            $CategoriesController = new CategoriesController();
            return $CategoriesController->updateCategory();
        } 
        elseif($reqiure == "/delete_category"){
            $CategoriesController = new CategoriesController();
            return $CategoriesController->deleteCategory();
        } 
        if(!$callback){
            http_response_code(404);
            echo "page not found";
            return;
        }
        if(is_callable($callback )){
            call_user_func($callback);

        } elseif(file_exists($callback)){
            require $callback;
        } else {
            http_response_code(500);
            echo "invalid route";
        }
    }
}
