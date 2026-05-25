<?php

namespace AlazziAz\OdooXmlrpc\Value;

use Laminas\XmlRpc\AbstractValue;
use Laminas\XmlRpc\Value\AbstractScalar;
use Override;

final class XmlRpcBoolean extends AbstractScalar
{
    public function __construct(bool $value)
    {
        $this->type  = AbstractValue::XMLRPC_TYPE_BOOLEAN;
        $this->value = $value ? 1 : 0;  // serialize as <boolean>0|1</boolean>
    }

    #[Override]
    public function getValue(): bool
    {
        return (bool) $this->value;
    }
}

