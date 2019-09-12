<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    var $helpers = array('Html', 'Form');
    var $name = "Users";
    var $scaffold;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add', 'logout');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->colorButtonActived('users/index');
        
        $users = $this->paginate($this->Users);
        
        $this->set('users', $this->paginate());

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        $this->colorButtonActived('users/index');

        // Define o layout.
        $this->viewBuilder()->setLayout('deslogado');
        
       
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //$this->User->create();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
	    debug($user); 
	    
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
 

    public function login() {

        $session = $this->request->session();
        $user = $this->Auth->identify();

        // Define o layout.
        $this->viewBuilder()->setLayout('login');
             

        if ($this->request->is('post')) {

            //$session = $this->request->session();
            //$user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                
                
                return $this->redirect($this->Auth->redirectUrl());
            } else {

        	$this->Flash->error(__('Usuário ou senha inválidos! Por favor, tente novamente!'));
                return;
            }
        }
    }


    public function logout() {
                
        $idLogado = $this->request->session()->read('Auth.User.id_pessoa');
        
                
        //$this->Flash->success('You are now logged out.');
        $session = $this->request->session();
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }   
    
    
}