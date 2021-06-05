<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Entity\Orders;
use App\Entity\Users;
use App\Form\CommentType;
use App\Form\PaymentType;
use App\Form\UserType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
class UserController extends AbstractController
{
      
    /**
     * index
     *  @Route("/profil", name="profil")
     * @param  EntityManagerInterface $em
     * @param  Request $request
     * @param  UserInterface $user
     * @param  UsersRepository $userRepository
     * @return Response
     */
    public function index(EntityManagerInterface $em, Request $request, UserInterface $user, UsersRepository $userRepository): Response {
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $clear = false;
        if ($this->get('session')->get('clear')) {
            $clear = True;

            $this->get('session')->remove('clear');
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->flush();

            $this->addFlash('success', 'Les information on été bien modifié.');
            return $this->redirectToRoute('profil');
        }

        $response = new Response(null, $form->isSubmitted() ? 422 : 200);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
            'clear' => $clear,
            'user' => $user
        ], $response);
    }

   
    /**
     * cart
     * @Route("/panier", name="cart")
     * @param  ArticleRepository $repo
     * @param  Request $request
     * @return Response
     */
    public function cart(ArticleRepository $repo, Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $email = $request->request->get('email', null);

            $value = 0;
            $data = false;
            $subTotal = 0;
            $total = 0;
            if (isset($_POST['localStorage'])) {
                $data = [];
                $value = $_POST['localStorage'];
                foreach ($value as $elem) {
                    
                    $article = $repo->findOneBy(['idArticle' => $elem['id']]);
                    $quantity = $elem['nb'];
                    if($quantity > $article->getInventory()){
                        $quantity = $article->getInventory();
                    }
                    $data[] = ['article' => $article, 'nb' => $quantity];
                }
                foreach ($data as $value) {
                    $subTotal += $value['article']->getprice() * $value['nb'];
                }
                $this->get('session')->set('orderlines', $data);
            }
            
            return new JsonResponse([
                'content' => $this->renderView('user/_cart_element.html.twig', ['values' => $data, 'subTotal' => $subTotal, 'starDate' => date('y-m-d')]),
                'value' => $value


            ]);
        }
        return $this->render('user/cart.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

      
    /**
     * payment
     *  @Route("/validation", name="payment")
     * @param  UsersRepository $userRepository
     * @param  Request $request
     * @param  UserInterface $user
     * @param  EntityManagerInterface $em
     * @param  ArticleRepository $repoArticle
     * @return Response
     */
    public function payment(UsersRepository $userRepository, Request $request, UserInterface $user, EntityManagerInterface $em, ArticleRepository $repoArticle)
    {

        $user = $userRepository->find($user) ;
        $form = $this->createForm(PaymentType::class);
        $form->handleRequest($request);
        $orderLines = $this->get('session')->get('orderlines');

        if (!$orderLines) {
            return $this->redirectToRoute('index');
        } else {
            
            $subTotal = 0;
            foreach ($orderLines as $value) {
                $subTotal += $value['article']->getprice() * $value['nb'];
            }
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $order = new Orders();
            $order->setDateCreation(new \DateTime('now', new \DateTimeZone('Europe/Paris')))
                ->setFlag('w')
                ->setAdress($form->get('address')->getData())
                ->setIdUsers($user);
            $em->persist($order);
            $em->flush();
            foreach ($orderLines as $line) {
                $article = $repoArticle->find($line['article']->getIdArticle());
                $orderLine = new OrderLine();
                
                $orderLine->setIdOrders($order)
                    ->setIdArticle($article)
                    ->setQuantity($line['nb']);
                    
                $em->persist($orderLine);
                $em->flush();
            }
            
            $this->get('session')->set('clear', 'true');
            $this->get('session')->remove('orderlines');
            $this->addFlash('success', 'Votre Commande à bien été validé.');
            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }
        
        $response = new Response(null, $form->isSubmitted() ? 422 : 200);
        return $this->render(
            'user/payment.html.twig',
            [
                'controller_name' => 'UserController',
                'form' => $form->createView(),
                'subTotal' => $subTotal,
                'orderLines' => $orderLines
            ],
            $response
        );
    }

}
