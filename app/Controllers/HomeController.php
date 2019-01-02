<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use \DB;
use Respect\Validation\Validator as v;
use \View;

class HomeController extends Controller
{
    
    public function index(/*$request, $response*/)
    {
        /*var_dump($this);
        $this->data['title'] = 'HomeController';
        return View::fetch('home.twig', $this->data);
        return $this->view->render($this->response, 'home.twig', $this->data);
        die();*/

        $validation = $this->validator->validate($this->request, [
            'name' => v::emailAvailable()
        ]);

        if ($validation->failed()){

            //return $this->response->withRedirect();
            var_dump($validation);
            die();
        }
        $user = User::all()->toJson();
        var_dump($user);

        die();
        echo DB::table("lavalle.usuarios")->get();

        $this->data['title'] = 'HomeController';
        //$this->view->render($this->response, 'home.twig', $this->data);
        //return 'Home controller';
    }


}