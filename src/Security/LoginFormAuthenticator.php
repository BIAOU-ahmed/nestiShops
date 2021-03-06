<?php

namespace App\Security;

use App\Entity\ConnectionLog;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';
    
    /**
     * entityManager
     *
     * @var mixed
     */
    private $entityManager;    
    /**
     * urlGenerator
     *
     * @var mixed
     */
    private $urlGenerator;    
    /**
     * csrfTokenManager
     *
     * @var mixed
     */
    private $csrfTokenManager;    
    /**
     * passwordEncoder
     *
     * @var mixed
     */
    private $passwordEncoder;
    
    /**
     * __construct
     *
     * @param  EntityManagerInterface $entityManager
     * @param  UrlGeneratorInterface $urlGenerator
     * @param  CsrfTokenManagerInterface $csrfTokenManager
     * @param  UserPasswordEncoderInterface $passwordEncoder
     * @return void
     */
    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    /**
     * supports
     *
     * @param  Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }
    
    /**
     * getCredentials
     *
     * @param  Request $request
     * @return array<String, mixed>
     */
    public function getCredentials(Request $request)
    {
        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['username']
        );
        return $credentials;
    }
    
    /**
     * getUser
     *
     * @param  mixed $credentials
     * @param  UserProviderInterface $userProvider
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $credentials['username'], 'flag' => 'a']);

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Username could not be found.');
        }
        return $user;
    }
    
    /**
     * checkCredentials
     *
     * @param  mixed $credentials
     * @param  UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        // Check the user's password or other credentials and return true or false
        // If there are no credentials to check, you can just return true
        // throw new \Exception('TODO: check the credentials inside '.__FILE__);
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }
    
    /**
     * onAuthenticationSuccess
     *
     * @param  Request $request
     * @param  TokenInterface $token
     * @param  string $providerKey
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {

//        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $credentials['username'], 'flag' => 'a']);
        
        $loggingUser = $request->getSession()->get('_security.last_username');
        
        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $loggingUser]);
        
        $connection = new ConnectionLog();
        $connection->setIdUsers($user)
            ->setDateConnection(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        $this->entityManager->persist($connection);
        $this->entityManager->flush();
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
    
    /**
     * getLoginUrl
     *
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
