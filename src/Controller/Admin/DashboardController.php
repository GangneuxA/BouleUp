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
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\EventRepository;

class DashboardController extends AbstractDashboardController
{

    protected $userRepository;
    protected $articleRepository;
    protected $eventRepository;

    public function __construct(UserRepository $userRepository,ArticleRepository $articleRepository, EventRepository $eventRepository)
    {
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
        $this->eventRepository = $eventRepository;
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
            return $this->render('admin/dashboard.html.twig', [
                'countAllUser' => $this->userRepository->countAllUser(),
                'countAllArticle' => $this->articleRepository->countAllArticle(),
                'allEvent' => $this->eventRepository->findAll()
            ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BouleUp')
            ->disableDarkMode()
            ->renderContentMaximized()
        ;
    }

    public function configureMenuItems(): iterable
    {
        return[

            MenuItem::linkToUrl('HomePage', 'fa fa-home', 'http://127.0.0.1:8000/home'),
            MenuItem::section('Entity'),
            MenuItem::linkToCrud('User', 'fas fa-address-card', User::class),
            MenuItem::linkToCrud('Article', 'far fa-newspaper', Article::class),
            MenuItem::linkToCrud('Order', 'fas fa-shopping-basket', Order::class),
            MenuItem::linkToCrud('Product', 'fas fa-gift', Product::class),
            MenuItem::linkToCrud('Event', 'fas fa-trophy', Event::class),
            
            
        ];
         
        
    }
}
