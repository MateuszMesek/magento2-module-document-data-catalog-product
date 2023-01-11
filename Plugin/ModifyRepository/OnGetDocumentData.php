<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\ProductInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogProduct\Model\Command\GetDocumentData;

class OnGetDocumentData
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundExecute(
        GetDocumentData  $getDocumentData,
        callable         $proceed,
        ProductInterface $product
    ): ?DocumentDataInterface
    {
        try {
            $this->state->setProduct($product);

            return $proceed($product);
        } finally {
            $this->state->unsetProduct();
        }
    }
}
