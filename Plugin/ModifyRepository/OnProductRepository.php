<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class OnProductRepository
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundGet(
        ProductRepositoryInterface $productRepository,
        callable                   $proceed,
                                   $sku,
                                   $editMode = false,
                                   $storeId = null,
                                   $forceReload = false
    ): ProductInterface
    {
        $product = $this->state->getProduct();

        if ($product) {
            if ($product->getSku() === $sku) {
                return $product;
            }

            if (null === $storeId) {
                $storeId = (int)$product->getStoreId();
            }
        }

        return $proceed($sku, $editMode, $storeId, $forceReload);
    }

    public function aroundGetById(
        ProductRepositoryInterface $productRepository,
        callable                   $proceed,
                                   $productId,
                                   $editMode = false,
                                   $storeId = null,
                                   $forceReload = false
    ): ProductInterface
    {
        $product = $this->state->getProduct();

        if ($product) {
            if ((int)$product->getId() === (int)$productId) {
                return $product;
            }

            if (null === $storeId) {
                $storeId = (int)$product->getStoreId();
            }
        }

        return $proceed($productId, $editMode, $storeId, $forceReload);
    }
}
