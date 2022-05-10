<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Command;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use MateuszMesek\DocumentDataApi\Data\DocumentDataInterface;

class GetDocumentDataByProductIdAndStoreId
{
    private ProductResource $productResource;
    private ProductFactory $productFactory;
    private GetDocumentData $getDocumentData;

    public function __construct(
        ProductResource $productResource,
        ProductFactory  $productFactory,
        GetDocumentData  $getDocumentData
    )
    {
        $this->productResource = $productResource;
        $this->productFactory = $productFactory;
        $this->getDocumentData = $getDocumentData;
    }

    public function execute(int $productId, int $storeId): ?DocumentDataInterface
    {
        $product = $this->productFactory->create();
        $product->setStoreId($storeId);

        $this->productResource->load($product, $productId);

        return $this->getDocumentData->execute($product);
    }
}
