<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Model\AttributeValueResolver;

use Magento\Catalog\Model\Product;
use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;
use MateuszMesek\DocumentDataCatalogProduct\Model\Data\Input;
use MateuszMesek\DocumentDataEavApi\Model\AttributeValueResolverInterface;

class DefaultResolver implements AttributeValueResolverInterface
{
    public function resolver(AttributeInterface $attribute, InputInterface $input): mixed
    {
        if (!$input instanceof Input) {
            return null;
        }

        $product = $input->getProduct();

        if (!$product instanceof Product) {
            return null;
        }

        $attributeCode = $attribute->getAttributeCode();

        return $product->getDataUsingMethod($attributeCode);
    }
}
