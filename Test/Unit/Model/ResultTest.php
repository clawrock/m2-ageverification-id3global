<?php

namespace ClawRock\ID3Global\Test\Unit\Model;

use ClawRock\AgeVerification\Api\Data\PersistableResultInterface;
use ClawRock\AgeVerification\Exception\CustomerAuthenticationException;
use ClawRock\ID3Global\Model\Result;
use ClawRock\MagentoTesting\TestCase;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Customer\Model\AddressFactory;
use Magento\Customer\Model\Config\Share;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Address\CollectionFactory;
use Magento\Customer\Model\ResourceModel\Customer as CustomerResource;
use Magento\Eav\Model\Config;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Model\Context;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime;
use Magento\Store\Model\StoreManagerInterface;


/**
 * @covers \ClawRock\ID3Global\Model\Result
 */
class ResultTest extends TestCase
{
    /**
     * @covers \ClawRock\ID3Global\Model\Result::isAuthorized
     * @covers \ClawRock\ID3Global\Model\Result::persistInCustomerData
     */
    public function testSuccessResult()
    {
        $response = (object) [
            'AuthenticateSPResult' => (object) [
                'BandText' => Result::BAND_TEXT_PASS,
                'AuthenticationID' => '00000000-0000-0000-0000-000000000000',
            ],
        ];

        $result = new Result($response);

        $this->assertTrue($result->isAuthorized());

        /** @var Customer $customer */
        $customer = $this->getCustomerMock();

        $result->persistInCustomerData($customer, 'av_method');

        $this->assertTrue($customer->getData(PersistableResultInterface::IS_VERIFIED_FIELD));
        $this->assertEquals('av_method', $customer->getData(PersistableResultInterface::METHOD_FIELD));
        $this->assertEquals(
            '00000000-0000-0000-0000-000000000000',
            $customer->getData(PersistableResultInterface::TOKEN_FIELD)
        );
    }

    /**
     * @covers \ClawRock\ID3Global\Model\Result::isAuthorized
     */
    public function testFailureResult()
    {
        $this->expectException(CustomerAuthenticationException::class);
        $response = (object) [
            'AuthenticateSPResult' => (object) [
                'BandText' => 'Fail',
            ],
        ];

        new Result($response);
    }

    protected function getCustomerMock()
    {
        $contextMock = $this->getMockBuilder(Context::class)->disableOriginalConstructor()->getMock();
        $registryMock = $this->getMockBuilder(Registry::class)->disableOriginalConstructor()->getMock();
        $storeManagerMock = $this->getMockBuilder(StoreManagerInterface::class)->getMockForAbstractClass();
        $configMock = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $scopeConfigMock = $this->getMockBuilder(ScopeConfigInterface::class)->getMockForAbstractClass();
        $resourceMock = $this->getMockBuilder(CustomerResource::class)->disableOriginalConstructor()->getMock();
        $configShareMock = $this->getMockBuilder(Share::class)->disableOriginalConstructor()->getMock();
        $addressFactoryMock = $this->getMockBuilder(AddressFactory::class)->disableOriginalConstructor()->getMock();
        $addressesFactoryMock = $this->getMockBuilder(CollectionFactory::class)->disableOriginalConstructor()->getMock();
        $transportBuilderMock = $this->getMockBuilder(TransportBuilder::class)->disableOriginalConstructor()->getMock();
        $groupRepositoryMock = $this->getMockBuilder(GroupRepositoryInterface::class)->getMockForAbstractClass();
        $encryptorMock = $this->getMockBuilder(EncryptorInterface::class)->getMockForAbstractClass();
        $dateTimeMock = $this->getMockBuilder(DateTime::class)->disableOriginalConstructor()->getMock();
        $customerDataFactoryMock = $this->getMockBuilder(CustomerInterfaceFactory::class)->disableOriginalConstructor()->getMock();
        $dataObjectProcessorMock = $this->getMockBuilder(DataObjectProcessor::class)->disableOriginalConstructor()->getMock();
        $dataObjectHelperMock = $this->getMockBuilder(DataObjectHelper::class)->disableOriginalConstructor()->getMock();
        $metadataServiceMock = $this->getMockBuilder(CustomerMetadataInterface::class)->getMockForAbstractClass();
        $indexerRegistryMock = $this->getMockBuilder(IndexerRegistry::class)->disableOriginalConstructor()->getMock();
        return new Customer(
            $contextMock,
            $registryMock,
            $storeManagerMock,
            $configMock,
            $scopeConfigMock,
            $resourceMock,
            $configShareMock,
            $addressFactoryMock,
            $addressesFactoryMock,
            $transportBuilderMock,
            $groupRepositoryMock,
            $encryptorMock,
            $dateTimeMock,
            $customerDataFactoryMock,
            $dataObjectProcessorMock,
            $dataObjectHelperMock,
            $metadataServiceMock,
            $indexerRegistryMock
        );
    }
}
