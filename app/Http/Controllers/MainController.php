<?php

namespace App\Http\Controllers;

class MainController {

    public function index(): void {
        echo 'MVC Main Controller';
    }

    public function ping(): void {
        echo 'Pong 🏓';
    }
}