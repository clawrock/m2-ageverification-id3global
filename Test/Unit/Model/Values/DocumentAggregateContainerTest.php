<?php

namespace ClawRock\ID3Global\Test\Unit\Model\Values;

use ClawRock\ID3Global\Model\Values\DocumentAggregateContainer;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\DocumentAggregateInterface;
use ClawRock\MagentoTesting\TestCase;

/**
 * @covers \ClawRock\ID3Global\Model\Values\DocumentAggregateContainer
 */
class DocumentAggregateContainerTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Values\DocumentAggregateContainer::toStdClass
     * @covers \ClawRock\ID3Global\Model\Values\DocumentAggregateContainer::getAggregates
     */
    public function testValue()
    {
        $documentDataObject = (object) ['document' => 'data'];
        $document = $this->getMockBuilder(DocumentAggregateInterface::class)
            ->getMockForAbstractClass();

        $document->expects($this->once())->method('getAggregateName')->willReturn('document');
        $document->expects($this->once())->method('toStdClass')->willReturn($documentDataObject);

        $container = new DocumentAggregateContainer([$document]);

        $this->assertEquals(['document' => $document], $container->getAggregates());

        $expected = (object) [
            'document' => $documentDataObject,
        ];
        $this->assertEquals($expected, $container->toStdClass());
    }
}
