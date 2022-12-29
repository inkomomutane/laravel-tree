<?php

namespace Nevadskiy\Tree\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Nevadskiy\Tree\ValueObjects\Path;
use RuntimeException;

class AsPath implements CastsAttributes
{
    /**
     * @inheritdoc
     */
    public function get($model, string $key, $value, array $attributes): ?Path
    {
        if (is_null($value)) {
            return null;
        }

        return new Path($value);
    }

    /**
     * @inheritdoc
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if ($value instanceof Path) {
            return $value->getValue();
        }

        throw new RuntimeException(sprintf('Unexpected "%s" type.', gettype($value)));
    }
}