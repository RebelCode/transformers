<?php

namespace RebelCode\Transformers\Exception;

use Dhii\Exception\ThrowableInterface;
use RebelCode\Transformers\TransformerInterface;

/**
 * An exception thrown in relation to a transformer.
 *
 * @since [*next-version*]
 */
interface TransformerExceptionInterface extends ThrowableInterface
{
    /**
     * Retrieves the transformer instance that erred, if any.
     *
     * @since [*next-version*]
     *
     * @return TransformerInterface|null
     */
    public function getTransformer();
}
