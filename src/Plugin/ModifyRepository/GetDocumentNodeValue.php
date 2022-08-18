<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogProduct\Plugin\ModifyRepository;

use MateuszMesek\DocumentDataApi\Command\GetDocumentNodeValueInterface;
use MateuszMesek\DocumentDataApi\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataApi\Data\DocumentNodeInterface;
use MateuszMesek\DocumentDataApi\InputInterface;
use MateuszMesek\DocumentDataCatalogProduct\Data\Input;

class GetDocumentNodeValue
{
    private State $state;

    public function __construct(
        State $state
    )
    {
        $this->state = $state;
    }

    public function aroundExecute(
        GetDocumentNodeValueInterface $getDocumentNodeValue,
        callable $proceed,
        DocumentNodeInterface $documentNode,
        InputInterface $input
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
