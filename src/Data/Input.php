<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Data;

use Magento\Catalog\Api\Data\ProductInterface;
use MateuszMesek\DocumentDataApi\InputInterface;

class Input implements InputInterface
{
    private ProductInterface $product;

    public function __construct(
        ProductInterface $product
    )
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string)$this->product->getId();
    }

    /**
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }
}
