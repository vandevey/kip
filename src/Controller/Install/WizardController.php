<?php


namespace App\Controller\Install;

use App\Form\SetupWizardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WizardController
 * @package App\Controller\Install
 * @Route("/_install")
 */
class WizardController extends AbstractController
{
    /**
     * @Route("")
     */
    public function index(ParameterBagInterface $config, Request $request)
    {
        if ($config->get("installation_done")) {
            return $this->redirectToRoute("knowledge_read_home");
        }
        $form = $this->createForm(SetupWizardType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            dd($form->getData());
        }
        return $this->render("setup/wizard.html.twig", ["form" => $form->createView()]);
    }

}