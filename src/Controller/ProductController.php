<?php


namespace App\Controller;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/detail/product/{product}", name="product_detail_product")
     */
    public function getProductDetail(Product $product, Request $request, EntityManagerInterface $em)
    {

    }
}