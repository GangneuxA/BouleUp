<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Product;
use App\Repository\ProductRepository;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $panier = $session->get("panier", []);

        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $product = $productRepository->find($id);
            $dataPanier[] = [
                "produit" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getPrice() * $quantite;
        }

        return $this->render('cart/index.html.twig', compact("dataPanier","total"));
    }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add(Product $product, SessionInterface $session)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove(Product $product, SessionInterface $session)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/delete/{id}', name: 'app_cart_delete')]
    public function delete(Product $product, SessionInterface $session)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
                unset($panier[$id]);
            }
        
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/delete', name: 'app_cart_deleteAll')]
    public function deleteAll(SessionInterface $session)
    {
        
        $session->remove("panier");

        return $this->redirectToRoute("app_cart");
    }
}
