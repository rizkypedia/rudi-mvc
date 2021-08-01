<?php
namespace RudiMVC\Controller;

use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;

class UsersController extends RudiController 
{
    public function __construct(AbstractView $view)
    {
        parent::__construct($view);
        
    }
    public function indexAction()
    {
        $users = [
            '1' => [
                'id' => 1,
                'name' => 'John Doe',
                'birth' => '1995-03-03',
    //            it used to be packageId, changed it to package
                'package' => 1,
                'active' => true,
            ],
            '2' => [
                'id' => 2,
                'name' => 'Ana Bock',
                'birth' => '1997-05-03',
                'package' => 2,
                'active' => true,
            ],
            '3' => [
                'id' => 3,
                'name' => 'Hari Seldon',
                'birth' => '1989-02-12',
                'package' => 2,
                'active' => false,
            ]
        ];
        $data['message'] = $users;
        $this->view->render(__METHOD__, $data);
    }
    
}