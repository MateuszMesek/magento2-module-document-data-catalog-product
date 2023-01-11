<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Model\Data;

use Magento\Catalog\Api\Data\ProductInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;

class Input implements InputInterface
{
    public function __construct(
        private readonly ProductInterface $product
    )
    {
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
