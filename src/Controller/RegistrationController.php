<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Entity\Protocoles;
use App\Form\RegistrationFormType;
use App\Repository\UtilisateursRepository;
use App\Security\EmailVerifier;
use App\Security\UtilisateursAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    
    private string $stripeSecretKey; // Ajoutez cette ligne pour définir la propriété

    public function __construct(EmailVerifier $emailVerifier, ParameterBagInterface $params)
    {
        
        $this->emailVerifier = $emailVerifier;
        
        $this->stripeSecretKey = $params->get('stripe.secret_key');
    }
   
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, 
    UtilisateursAuthenticator $authenticator, EntityManagerInterface $entityManager, UtilisateursRepository $repo): Response
    {
        $user = new Utilisateurs();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stripeToken = $request->request->get('stripeToken');
            // Utilisez ce token avec l'API Stripe pour créer un paiement ou un abonnement
            $selectedProtocole = $form->get('relation')->getData();
            $user->setRelation($selectedProtocole); // Utilisez la méthode setRelation pour définir la relation

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

// Avant de persister l'utilisateur, créez un client Stripe
Stripe::setApiKey($this->stripeSecretKey);
 // Assurez-vous que STRIPE_SECRET_KEY est défini dans .env
 try {
    $customer = Customer::create([
        'email' => $form->get('email')->getData(),
        // Vous pouvez ajouter d'autres informations de l'utilisateur ici si nécessaire
    ]);

    // Stockez l'ID du client Stripe avec l'utilisateur (ajoutez une propriété à votre entité si nécessaire)
    $user->setStripeCustomerId($customer->id);
    $paymentMethodId = $request->request->get('paymentMethodId');
    if ($paymentMethodId) {
        try {
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            $paymentMethod->attach(['customer' => $customer->id]);
        } catch (ApiErrorException $e) {
            // Gérer l'erreur d'attachement
        }
    }
    $selectedProtocolePrice = $selectedProtocole-> getPrixProtocole(); // Assurez-vous que votre entité Protocoles a une méthode getPrice
    // Création du PaymentIntent
    $paymentIntent = PaymentIntent::create([
        'customer' => $customer->id,
        'amount' => $selectedProtocolePrice * 100, // Assurez-vous que ce montant est correct pour votre cas d'utilisation
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'payment_method' => $paymentMethodId,
    ]);
    $paymentIntent->confirm();
    if ($paymentIntent->status === 'succeeded') {
        // Le paiement a été effectué avec succès
    } else {
        // Le paiement a échoué ou est en attente, gérez selon les cas
    }

    // Ici, vous pouvez enregistrer l'ID de l'intent de paiement avec votre utilisateur si nécessaire
    // Par exemple: $user->setPaymentIntentId($paymentIntent->id);
    // Assurez-vous que cela correspond à ce que votre frontend envoie
    // Attach the PaymentMethod to the Customer
    Customer::createSource(
        $customer->id,
        ['source' => $paymentMethodId]
    );
} catch (ApiErrorException $e) {
    // Gérer l'erreur ici
    // Par exemple, ajouter un message flash pour informer l'utilisateur de l'erreur
    // $this->addFlash('error', 'Une erreur est survenue lors de la création du paiement : ' . $e->getMessage());
    // return $this->redirectToRoute('articles');
}
            
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('eryandelmon@laposte.net', 'PREVENTION SPORT'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
// Authentification automatique de l'utilisateur
$userAuthenticator->authenticateUser(
    $user,
    $authenticator,
    $request
);
          // Ajoute un message flash pour informer l'utilisateur que l'inscription a réussi et lui demande de se connecter.
// $this->addFlash('success', 'Inscription réussie. Veuillez vous connecter.');
// Redirige l'utilisateur vers la page de connexion.
return $this->redirectToRoute('app_success');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
