<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class LineController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/line/callback', name: 'customer')]
    public function index()
    {
        $this->logger->info('line callback');
        return $this->render('line/index.html.twig', [
            'controller_name' => self::class,
        ]);
    }
}
