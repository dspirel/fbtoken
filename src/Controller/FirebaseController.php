<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Services\StorageService;
use Kreait\Firebase\Auth;
use Symfony\Component\HttpFoundation\Request;
use Kreait\Firebase\Factory;

final class FirebaseController extends AbstractController
{
    // #[Route('/firebase', name: 'app_firebase')]
    // public function index(StorageService $storage): JsonResponse
    // {
    //     $token = $storage->generateToken();
    //     dd($storage->getStorage());
    // }

        #[Route('/', name: 'home')]
    public function home(): JsonResponse
    {
        // $creds = $_ENV['FIREBASE_CREDENTIALS'];
        // $json = json_decode($creds, true);

        // if (json_last_error() !== JSON_ERROR_NONE) {
        //     $msg = 'Error: ' . json_last_error_msg();
        // } else {
        //     $msg = 'Valid!';
        // }
        return new JsonResponse([
            'msg' => "ss",
        ]);
    }

    #[Route('/firebase/token', name: 'firebase_generate_token')]
    public function generateToken(Request $request): JsonResponse
    {
        $clientSecret = $request->query->get('secret');

        if ($clientSecret !== $_ENV['MY_API_SECRET']) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $creds = json_decode($_ENV['FIREBASE_CREDENTIALS'], true);

        $auth = (new Factory())
            ->withServiceAccount($creds)
            ->createAuth();

        $uid = 'davor';
        $customToken = $auth->createCustomToken($uid)->toString();
        // $idToken = $auth->signInWithCustomToken($customToken)->idToken();


        return new JsonResponse([
            'custom_token' => $customToken,
        ]);
    }
    // public function generateToken(Auth $auth, Request $request): JsonResponse
    // {
    //     $clientSecret = $request->query->get('secret');

    //     if ($clientSecret !== $_ENV['MY_API_SECRET']) {
    //         return new JsonResponse(['error' => 'Unauthorized'], 401);
    //     }

    //     $uid = 'davor'; // Replace this as needed
    //     $customToken = $auth->createCustomToken($uid);
    //     $idToken = $auth->signInWithCustomToken($customToken)->idToken();

    //     return new JsonResponse([
    //         'custom_token' => $idToken,
    //     ]);
    // }

}
