<?php declare(strict_types=1);

namespace MateuszMesek\DocumentCatalogProduct\Data;

use Magento\Catalog\Api\Data\ProductInterface;
use MateuszMesek\Document\Api\InputInterface;

class Input implements InputInterface
{
    private ProductInterface $product;

    public function __construct(
        ProductInterface $product
    )
    {
        $this->product = $product;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }
}
