<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {

        $session = $this->request->session();
        $idLogado = $this->request->session()->read('Auth.User.id_pessoa');
        

        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            // 'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password',
                    ],
                ],
            ],
            'loginRedirect' => [
                'controller' => 'Products',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout',
                'prefix' => false
            ]
        ]);
    }

    public function randomPassword($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    public function permissaoAcesso($setor){
        
        $permissao = false;
        
        $idLogado = $this->request->session()->read('Auth.User.id');
        if(empty($idLogado)){
            $this->Flash->error(__('O Tempo de Acesso expirou!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            //break;
        }
        
        $nomeLogado = $this->getNomePessoa($idLogado);
        $this->set('nomeLogado', $nomeLogado);
        
        //$perfis = $this->getPerfisLogado($idLogado);
        //$this->set('perfis', $perfis);
        //debug($perfis);
          
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {
        //$this->Auth->allow('index', 'view', 'display', 'home');

        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

	//public function isAuthorized($user) {
	    // Admin pode acessar todas as actions
	    //if (isset($user['role']) && $user['role'] === 'admin') {
	    //    return true;
	   // }

	    // Bloqueia acesso por padr�o
	//    return false;
	//}
     

    public function cumprimento() {

        $data = new Time('now');
        $hora = $data->i18nFormat('HH:mm:ss');
        $this->set('hora', $hora);


        //debug ($data);

        if ($hora < '12:00:00') {
            $cumprimento = 'Bom dia, ';
        } elseif ($hora >= '19:00:00') {
            $cumprimento = 'Boa noite, ';
        } else {
            $cumprimento = 'Boa tarde, ';
        }

        return $cumprimento;
    }
    
    public function getNomePessoa($idPerson) {
        $users_table = TableRegistry::get('Users');

        $person = $users_table->find('all', ['fields' => (['id', 'username'])])
                ->where(['Users.id' => $idPerson])
                //->order(['pre.id' => 'ASC'])
                //->limit(1)
                ->toArray()
        ;

        //debug($person);
        return $person;
    }
    
    public function colorButtonActived($ender) {
        
        $style = 'font-weight: bolder;';
               
        $productsButton = '';
        $usersButton = '';

        if ($ender == 'products/index') {
            $productsButton = $style;
        } elseif ($ender == 'users/index') {
            $usersButton = $style;
        } 

        $this->set(compact('productsButton','usersButton'));
    }
}
