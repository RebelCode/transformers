<?php

namespace RebelCode\Transformers;

use Dhii\Transformer\TransformerInterface;

/**
 * A no-operation transformer implementation.
 *
 * @since [*next-version*]
 */
class NoOpTransformer implements TransformerInterface
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function transform($source)
    {
        return $source;
    }
}
