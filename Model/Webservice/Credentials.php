<?php

namespace ClawRock\ID3Global\Model\Webservice;

class Credentials
{
    const WSS_NAMESPACE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    const HEADER_NAME   = 'Security';
    const TOKEN_NODE    = 'UsernameToken';
    const SECURITY_NODE = 'Security';

    protected $username;

    protected $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function toSoapHeader(): \SoapHeader
    {
        $auth = new \stdClass();
        $auth->Username = new \SoapVar(
            $this->username,
            XSD_STRING,
            null,
            self::WSS_NAMESPACE,
            null,
            self::WSS_NAMESPACE
        );
        $auth->Password = new \SoapVar(
            $this->password,
            XSD_STRING,
            null,
            self::WSS_NAMESPACE,
            null,
            self::WSS_NAMESPACE
        );

        $usernameToken = new \stdClass();
        $usernameToken->UsernameToken = new \SoapVar(
            $auth,
            SOAP_ENC_OBJECT,
            null,
            self::WSS_NAMESPACE,
            self::TOKEN_NODE,
            self::WSS_NAMESPACE
        );

        $token = new \SoapVar(
            $usernameToken,
            SOAP_ENC_OBJECT,
            null,
            self::WSS_NAMESPACE,
            self::TOKEN_NODE,
            self::WSS_NAMESPACE
        );

        $security = new \SoapVar(
            $token,
            SOAP_ENC_OBJECT,
            null,
            self::WSS_NAMESPACE,
            self::SECURITY_NODE,
            self::WSS_NAMESPACE
        );

        return new \SoapHeader(self::WSS_NAMESPACE, self::HEADER_NAME, $security, true);
    }
}
