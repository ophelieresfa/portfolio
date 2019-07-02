<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class CertificateController
 * @package App\Controller
 */
class CertificateController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        $allCertificates = ModelFactory::get('Certificate')->list();
        $allCertificates = array_reverse($allCertificates);

        $allCourseCertificates  = array();
        $allPathCertificates    = array();
        $allDegreeCertificates  = array();

        foreach ($allCertificates as $certificate) {
            foreach ($certificate as $value) {

                switch ($value) {
                    case 'course':
                        $allCourseCertificates[] = $certificate;
                        break;
                    case 'path':
                        $allPathCertificates[] = $certificate;
                        break;
                    case 'degree':
                        $allDegreeCertificates[] = $certificate;
                        break;
                }
             }
        }

        return $this->render('front/certificate.twig', [
            'allCourseCertificates' => $allCourseCertificates,
            'allPathCertificates'   => $allPathCertificates,
            'allDegreeCertificates' => $allDegreeCertificates
        ]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createAction()
    {
        if (!empty(filter_input_array(INPUT_POST))) {
            ModelFactory::get('Certificate')->create(filter_input_array(INPUT_POST));
            $this->cookie->createAlert('New certificate successfully created !', 'green');

            $this->redirect('admin');
        }

        return $this->render('back/createCertificate.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateAction()
    {
        $id = filter_input(INPUT_GET, 'id');

        if (!empty(filter_input_array(INPUT_POST))) {
            ModelFactory::get('Certificate')->update($id, filter_input_array(INPUT_POST));
            $this->cookie->createAlert('Successful modification of the selected certificate !', 'blue');

            $this->redirect('admin');
        }
        $certificate = ModelFactory::get('Certificate')->read($id);

        return $this->render('back/updateCertificate.twig', ['certificate' => $certificate]);
    }

    public function deleteAction()
    {
        $id = filter_input(INPUT_GET, 'id');
        ModelFactory::get('Course')->delete($id);
        $this->cookie->createAlert('Certificate permanently deleted !', 'red');

        $this->redirect('admin');
    }
}

