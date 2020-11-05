<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Customers;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="samplehome")
     */
    public function index() {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/customer", name="customer_list")
     *
     */
    public function customer() {
        
        $customers = $this->getDoctrine()->getRepository
        (Customers::class)->findAll();

        return $this->render('home/customers.html.twig', array(
            'customers' => $customers
        ));
    }

    /**
     * @Route("/customer/{id}", name="customer_show")
     *
     */
    public function show($id) {
        
        $customer = $this->getDoctrine()->getRepository
        (Customers::class)->find($id);

        return $this->render('home/customer-show.html.twig', array(
            'customer' => $customer
        ));
    }
}