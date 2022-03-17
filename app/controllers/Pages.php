<?php
class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('Event');
    }


    public function category() {

       if(isset($_GET['filter'])) {

            $category = $_GET['filter'];
        }

        $events = $this->userModel->searchEventByCategory($category);

        $data = [
            'title' => 'Home page',
            'events' => $events,
        ]; 
        
        $this->view('index', $data);

    }


    public function index() {

        if(isset($_GET['filter'])) {

            $filter = $_GET['filter'];

        }else if(isset($_GET['category'])) {

            $category = $_GET['category'];

        }

        $events = $this->userModel->loadAllEvents($filter);

        if($events == null) {

            $loadData = false;

            $events = $this->userModel->loadAllEvents('all');

        }else{

            $loadData = true;
        }

        $data = [
            'title' => 'Home page',
            'events' => $events,
            'loadData' => $loadData,
            'filter' => $filter,
        ]; 
        
        $this->view('index', $data);

    }

    public function about() {
        
        echo 'hello i am here';
        exit();
    }
}
