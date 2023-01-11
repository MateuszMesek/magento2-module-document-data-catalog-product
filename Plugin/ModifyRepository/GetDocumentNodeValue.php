<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use MateuszMesek\DocumentDataApi\Model\Command\GetDocumentNodeValueInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentNodeInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;
use MateuszMesek\DocumentDataCatalogProduct\Model\Data\Input;

class GetDocumentNodeValue
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundExecute(
        GetDocumentNodeValueInterface $getDocumentNodeValue,
        callable                      $proceed,
        DocumentNodeInterface         $documentNode,
        InputInterface                $input
    )
    {
        if (!$input instanceof Input) {
            return $proceed($documentNode, $input);
        }

        try {
            $this->state->setProduct($input->getProduct());

            return $proceed($documentNode, $input);
        } finally {
            $this->state->unsetProduct();
        }
    }
}
