<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterface;

class OnCategoryRepository
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundGet(
        CategoryRepositoryInterface $categoryRepository,
        callable                    $proceed,
                                    $categoryId,
                                    $storeId = null
    ): CategoryInterface
    {
        $product = $this->state->getProduct();

        if ($product && null === $storeId) {
            $storeId = (int)$product->getStoreId();
        }

        return $proceed($categoryId, $storeId);
    }
}
