<?php

namespace App\Services\Rabbit\Messages;

use App\Enums\Lang;
use ReflectionClass;

class BaseMessage implements \JsonSerializable
{

    public function __construct(object $data)
    {
        $reflect = new ReflectionClass($this);

        foreach ($reflect->getProperties() as $property) {
            $propertyName = $property->getName();
            $type = $property->getType()->getName();
            if ($property->hasDefaultValue() && isset($data->$propertyName) === false) {
                $value = $property->getDefaultValue();
            } elseif ($property->getType()->allowsNull() && isset($data->$propertyName) === false) {
                $value = null;
            } else {
                $value = $data->$propertyName;
            }
            // Todo Check Enum; not Lang
            if ($type === Lang::class) {
                $value = Lang::from($value);
            }
            $this->$propertyName = $value;
        }
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
