<?php
class HomeController extends Controller
{
    public function index()
    {
        $this->view('index', [
            'title' => 'Home'
        ]);
    }
}
