<?php

namespace RebelCode\Transformers;

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
