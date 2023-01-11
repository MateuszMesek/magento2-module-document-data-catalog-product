<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Model\Command;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use MateuszMesek\DocumentDataApi\Model\Command\GetDocumentDataInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogProduct\Model\Data\InputFactory;

class GetDocumentData
{
    public function __construct(
        private readonly InputFactory             $inputFactory,
        private readonly GetDocumentDataInterface $getDocumentData
    )
    {
    }

    public function execute(ProductInterface $product): ?DocumentDataInterface
    {
        $input = $this->inputFactory->create(['product' => $product]);

        return $this->getDocumentData->execute(Product::ENTITY, $input);
    }
}
