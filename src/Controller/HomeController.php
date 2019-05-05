<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $allProjects    = ModelFactory::get('Project')->list();
        $project        = $allProjects[array_rand($allProjects)];

        return $this->render('front/home.twig', [
            'project' => $project
        ]);
    }
}
