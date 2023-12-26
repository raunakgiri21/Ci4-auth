<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function signin()
    {
      $data['display'] = 'd-none';
      $data['msg'] = [];
      $data['signinActive'] = 'active-tab';
      $data['signupActive'] = '';
      return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signin').view('templates/footer');
    }
    public function signinPost()
    {
      $model = new UserModel();
      $email = $this->request->getVar('email');
      $password = $this->request->getVar('password');
      $result = $model->where('email',$email)->first();
      if($result) {
        if(!password_verify($password, $result['password'])){
          $data['display'] = '';
          $data['msg'] = ['Incorrect Password!'];
          $data['signinActive'] = 'active-tab';
          $data['signupActive'] = '';
          return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signin').view('templates/footer');
        }else {
          $session = session();
          $session->set('name',$result['name']);
          $session->set('email',$result['email']);
          return redirect()->to(base_url('/'));
        }
      }else {
        $data['display'] = '';
        $data['msg'] = ['Incorrect Credentials!'];
        $data['signinActive'] = 'active-tab';
        $data['signupActive'] = '';
        return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signin').view('templates/footer');
      }
    }
    public function signup()
    {
      $data['display'] = 'd-none';
      $data['msg'] = [];
      $data['signinActive'] = '';
      $data['signupActive'] = 'active-tab';
      return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signup').view('templates/footer');
    }
    public function signupPost()
    {
      helper('form');
      
      if (! $this->validate([
        'name' => 'required|max_length[100]|min_length[2]',
        'email'  => 'required|max_length[255]',
        'password'  => 'required|max_length[255]|min_length[8]',
        'confirm-password'  => 'required|max_length[255]|min_length[8]',
        ])) {
          // The validation fails, so returns the form.
          $validation = \Config\Services::validation();
          $data['display'] = '';
          $data['msg'] = $validation->getErrors();
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signup').view('templates/footer');
        }
        
        $model = new UserModel();
        
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $cnfPassword = $this->request->getVar('confirm-password');
        
        $result = $model->where('email',$email)->first();
        if($result) {
          $data['display'] = '';
          $data['msg'] = ['Email already exists!'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
          return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signup').view('templates/footer');
        }  
        elseif($password !== $cnfPassword){
          $data['display'] = '';
          $data['msg'] = ['Passwords do not match!'];
          $data['signinActive'] = '';
          $data['signupActive'] = 'active-tab';
        return view('templates/header').view('templates/navbar').view('templates/switchTab',$data).view('pages/signup').view('templates/footer');
      }else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $model->save([
          'name' => $name,
          'email'  => $email,
          'password'  => $hash,
        ]);
        $session = session();
        $session->set('name',$name);
        $session->set('email',$email);
        return redirect()->to(base_url('/'));
      }
    }
    public function logout()
    {
      $session = session();
      $session->destroy();
      return redirect()->to(base_url('signin'));
    }
}