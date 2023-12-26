<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if($session->get('name')) {
            $data['name'] = $session->get('name');
            $data['email'] = $session->get('email');
            return view('templates/header').view('templates/navbar').view('pages/home',$data).view('templates/footer');
        }
        return redirect()->to(base_url('signin'));
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('signin'));
    }
}
