<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Event;
use App\Entity\Product;
use App\Entity\Order;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
            return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BouleUp')
            ->disableDarkMode();
    }

    public function configureMenuItems(): iterable
    {
        return[

            MenuItem::linkToUrl('HomePage', 'fa fa-home', 'http://127.0.0.1:8000/home'),
            MenuItem::section('Entity'),
            MenuItem::linkToCrud('User', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Article', 'fas fa-list', Article::class),
            MenuItem::linkToCrud('Order', 'fas fa-list', Order::class),
            MenuItem::linkToCrud('Product', 'fas fa-list', Product::class),
            MenuItem::linkToCrud('Event', 'fas fa-list', Event::class),
            
            
        ];
         
        
    }
}
