<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CustomerRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class CustomerController extends AbstractController
{
    public function __construct(
        private readonly CustomerRepositoryInterface $customerRepository
    ) {
    }

    #[Route('/customers', name: 'customer')]
    public function index()
    {
        $customers = $this->customerRepository->findAll();
        $customerDto = [];
        foreach($customers as $customer) {
            $customerDto[] = new CustomerDto(
                $customer->getCustomerId(),
                $customer->getName(),
                $customer->getLineCustomers()[0]->getLineUserId()
            );
        }
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'customers' => $customerDto
        ]);
    }
}
