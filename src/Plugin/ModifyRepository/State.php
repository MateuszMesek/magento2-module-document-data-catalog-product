<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\ProductInterface;

class State
{
    private array $level = [];

    public function setProduct(ProductInterface $product): void
    {
        $this->level[] = $product;
    }

    public function getProduct(): ?ProductInterface
    {
        $product = current($this->level);

        if (!$product) {
            return null;
        }

        return $product;
    }

    public function unsetProduct(): void
    {
        array_pop($this->level);
    }
}
