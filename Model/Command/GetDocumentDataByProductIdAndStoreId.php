<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Model\Command;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Catalog\Model\ResourceModel\Product\Website\Link as ProductWebsiteLinkResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;

class GetDocumentDataByProductIdAndStoreId
{
    public function __construct(
        private readonly ProductWebsiteLinkResource $productWebsiteLinkResource,
        private readonly StoreManagerInterface      $storeManager,
        private readonly ProductResource            $productResource,
        private readonly ProductFactory             $productFactory,
        private readonly GetDocumentData            $getDocumentData
    )
    {
    }

    public function execute(int $productId, int $storeId): ?DocumentDataInterface
    {
        if (!$this->isProductAvailableInStore($productId, $storeId)) {
            return null;
        }

        $product = $this->productFactory->create();
        $product->setStoreId($storeId);

        $this->productResource->load($product, $productId);

        return $this->getDocumentData->execute($product);
    }

    /**
     * @param int $productId
     * @param int $storeId
     * @return bool
     */
    private function isProductAvailableInStore(int $productId, int $storeId): bool
    {
        return in_array(
            $this->getWebsiteIdByStoreId($storeId),
            $this->getWebsiteIdsByProductId($productId),
            true
        );
    }

    /**
     * @param int $storeId
     * @return int
     */
    private function getWebsiteIdByStoreId(int $storeId): int
    {
        try {
            return (int)$this->storeManager->getStore($storeId)->getWebsiteId();
        } catch (NoSuchEntityException $exception) {
            return Store::DEFAULT_STORE_ID;
        }
    }

    /**
     * @param int $productId
     * @return int[]
     */
    private function getWebsiteIdsByProductId(int $productId): array
    {
        return array_map(
            'intval',
            $this->productWebsiteLinkResource->getWebsiteIdsByProductId($productId)
        );
    }
}
