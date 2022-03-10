<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Command\GetDocumentNodes;

use Magento\Catalog\Model\Product;
use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\DocumentDataApi\InputInterface;
use MateuszMesek\DocumentDataCatalogProduct\Data\Input;
use MateuszMesek\DocumentDataEavApi\AttributeValueResolverInterface;

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
