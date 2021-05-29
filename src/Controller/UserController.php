<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Entity\Orders;
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

class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(
        EntityManagerInterface $em,
        Request $request,
        UserInterface $user,
        UsersRepository $userRepository
    ): Response {
        //        $localUser = $userRepository->find(1);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $clear = false;
        if ($this->get('session')->get('clear')) {
            $clear = True;

            $this->get('session')->remove('clear');
        }
        // if ($form->isSubmitted()) {
        //     //            dump($localUser);
        //     dump($userRepository->find(1));
        //     dump($form);
        // }
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
     * @Route("/panier", name="cart")
     */
    public function cart(ArticleRepository $repo, Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $email = $request->request->get('email', null);

            $value = 0;
            $data = false;
            $total = 0;
            if (isset($_POST['localStorage'])) {
                $data = [];
                $value = $_POST['localStorage'];
                foreach ($value as $elem) {
                    //                    var_dump('toto',$elem);
                    $article = $repo->findOneBy(['idArticle' => $elem['id']]);
                    $data[] = ['article' => $article, 'nb' => $elem['nb']];
                }
                $subTotal = 0;
                foreach ($data as $value) {
                    $subTotal += $value['article']->getprice() * $value['nb'];
                }
                $this->get('session')->set('orderlines', $data);
            }
            //            dd($value);
            //            dump('totototototoo');
            //            dump($email);
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
     * @Route("/validation", name="payment")
     */
    public function payment(Request $request, UserInterface $user, EntityManagerInterface $em, ArticleRepository $repoArticle)
    {

        $form = $this->createForm(PaymentType::class);
        $form->handleRequest($request);
        $orderLines = $this->get('session')->get('orderlines');

        if (!$orderLines) {
            return $this->redirectToRoute('index');
        } else {
            dump($orderLines);
            $subTotal = 0;
            foreach ($orderLines as $value) {
                $subTotal += $value['article']->getprice() * $value['nb'];
            }
        }
        if ($form->isSubmitted() ){
            dump('is submit');
            dump($form);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            dump('form is valid');
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
                //                dump($line['article']);
                $orderLine->setIdOrders($order)
                    ->setIdArticle($article)
                    ->setQuantity($line['nb']);
                //                dump($orderLine);
                //                $order->addOrderLine($orderLine);
                $em->persist($orderLine);
                $em->flush();
            }
            //            dump($order);
            $this->get('session')->set('clear', 'true');
            $this->get('session')->remove('orderlines');
            $this->addFlash('success', 'Votre Commande à bien été validé.');
            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }
        dump('after if not valid');
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

    /**
     * @Route("/clear", name="clear")
     */
    public function clear(Request $request)
    {
        sleep(1);
        return $this->redirectToRoute('profil');
    }
}
