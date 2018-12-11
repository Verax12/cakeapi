<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $users = $this->Users->find('all');
        $this->set([
            'users' => $users,
            '_serialize' => ['users'],
        ]);
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set([
            'user' => $user,
            '_serialize' => ['user'],
        ]);
    }

    public function add()
    {

        $user = $this->Users->newEntity($this->request->getData());
        if ($this->Users->save($user)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'user' => $user,
            '_serialize' => ['message', 'user'],
        ]);
    }

    public function edit($id)
    {

        $user = $this->Users->get($id);
        if ($this->request->is(['put', 'patch'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message', 'user'],
        ]);

    }

    public function delete($id)
    {
        $user = $this->Users->get($id);
        $message = 'Deleted';
        if (!$this->Users->delete($user)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message', 'user'],
        ]);
    }
}