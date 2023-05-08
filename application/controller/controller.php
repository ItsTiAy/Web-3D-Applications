<?php
    class Controller
    {
        // Declare public variables for the controller class
        public $load;
        public $model;

        // Create functions for the controller class
        function __construct($pageMethod = null)
        {
            $this->load = new Load();
            $this->model = new Model();
            $this->$pageMethod();
        }

        function home()
        {
            $this->load->view("home");
        }

        function models()
        {
            $this->load->view("models");
        }

        function apiCreateTable()
        {
            $data = $this->model->dbCreateTable();
            $this->load->view('viewMessage', $data);
        }
        
        function apiDeleteTable()
        {
            $data = $this -> model -> dbDeleteTable();
            $this->load->view('viewMessage', $data);
        }

        function apiInsertData()
        {
            $data = $this->model->dbInsertData();
            $this->load->view('viewMessage', $data);
        }

        function apiGetModelData()
        {
            $data = $this -> model -> dbGetModelData();
            echo json_encode($data);
        }

        function apiGetBrandData()
        {
            $data = $this -> model -> dbGetBrandData();
            echo json_encode($data);
        }
    }
?>