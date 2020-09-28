<?php


namespace App\Controller;


use App\Entity\CountSearches;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends AbstractController
{
    /**
     * @Route("/detail/product/{id}", name="product_detail_product")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getProductDetail($id, EntityManagerInterface $em)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $cache = new FilesystemAdapter();

        $productCache = null;

        if (!$cache->hasItem('product' . $id))
        {
            $product = $em->getRepository(Product::class)->findOneById($id);

            if (!$product) {
                return new Response('', Response::HTTP_NOT_FOUND);
            }

            $productCache = $cache->getItem('product' . $id);
            $productCache->set($product);
            $cache->save($productCache);
        }

        $productCache = $productCache === null
            ? $cache->getItem('product' . $id)
            : $productCache;

        $em->getRepository(CountSearches::class)->incrementCounterForProduct($id);

        return new Response($serializer->serialize($productCache->get(), 'json'),
            Response::HTTP_OK);
    }
}