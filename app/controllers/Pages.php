<?php
class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('Store');
    }

    public function index() {

        $data = [
            'title' => 'Home page'
        ]; 
        
        $this->view('index', $data);
    }

    public function about() {
        
        echo 'hello i am here';
        exit();
    }
}
