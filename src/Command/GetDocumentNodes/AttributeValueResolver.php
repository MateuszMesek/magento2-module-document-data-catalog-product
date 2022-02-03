<?php declare(strict_types=1);

namespace MateuszMesek\DocumentCatalogProduct\Command\GetDocumentNodes;

use Magento\Catalog\Model\Product;
use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\Document\Api\InputInterface;
use MateuszMesek\DocumentCatalogProduct\Data\Input;
use MateuszMesek\DocumentEavApi\AttributeValueResolverInterface;

class AttributeValueResolver implements AttributeValueResolverInterface
{
    public function resolver(AttributeInterface $attribute, InputInterface $input)
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
