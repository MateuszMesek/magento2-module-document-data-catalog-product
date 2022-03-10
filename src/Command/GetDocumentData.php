<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Command;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use MateuszMesek\DocumentDataApi\Command\GetDocumentDataInterface;
use MateuszMesek\DocumentDataCatalogProduct\Data\InputFactory;

class GetDocumentData
{
    private InputFactory $inputFactory;
    private GetDocumentDataInterface $getDocumentData;

    public function __construct(
        InputFactory $inputFactory,
        GetDocumentDataInterface $getDocumentData
    )
    {
        $this->inputFactory = $inputFactory;
        $this->getDocumentData = $getDocumentData;
    }

    public function execute(ProductInterface $product)
    {
        $input = $this->inputFactory->create(['product' => $product]);

        return $this->getDocumentData->execute(Product::ENTITY, $input);
    }
}
