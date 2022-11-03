<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact.index")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
        
        //form test   
        //dd($form->getData());

            $contactFormData = $form->getData();
            
            //send a email 
            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('you@example.com')
                ->subject('Vous avez reçu un email')
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL. 'Message : '.
                    $contactFormData['message'],
                    'text/plain');


            $mailer->send($message);
            $this->addFlash('success', 'Vore message a été envoyé');

            return $this->redirectToRoute('contact.index');
        }

        return $this->render('contact/index.html.twig', ['our_form' => $form->createView()]);
    }
    

}
