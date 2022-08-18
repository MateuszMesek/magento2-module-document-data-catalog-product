<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\ProductInterface;
use MateuszMesek\DocumentDataApi\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogProduct\Command\GetDocumentData;

class OnGetDocumentData
{
    private State $state;

    public function __construct(
        State $state
    )
    {
        $this->state = $state;
    }

    public function aroundExecute(
        GetDocumentData $getDocumentData,
        callable $proceed,
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
