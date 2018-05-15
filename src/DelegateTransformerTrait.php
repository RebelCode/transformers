<?php

namespace RebelCode\Transformers;

use Dhii\Transformer\TransformerInterface;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use Dhii\Transformer\Exception\CouldNotTransformExceptionInterface;
use Dhii\Transformer\Exception\TransformerExceptionInterface;
use RuntimeException;

/**
 * Common functionality for transformers that delegate to other transformers, based on the source data given.
 *
 * @since [*next-version*]
 */
trait DelegateTransformerTrait
{
    /**
     * Transforms some source data into some output data.
     *
     * @since [*next-version*]
     *
     * @param mixed $source The source data to transform.
     *
     * @throws RuntimeException                    If a problem occurred while retrieving the delegate transformer.
     * @throws TransformerExceptionInterface       If an error occurred during transformation.
     * @throws CouldNotTransformExceptionInterface If the given source data could not be transformed.
     *
     * @return mixed The output data.
     */
    protected function _transform($source)
    {
        try {
            $transformer = $this->_getTransformer($source);

            if ($transformer !== null) {
                return $transformer->transform($source);
            }

            return $this->_onNoDelegateTransformer($source);
        } catch (RootException $exception) {
            throw $this->_createRuntimeException(
                $this->__('An error occurred while transforming the source data'),
                null,
                null
            );
        }
    }

    /**
     * Retrieves the transformer to use for the given source data.
     *
     * @since [*next-version*]
     *
     * @param mixed $source The source data for which to retrieve a transformer for.
     *
     * @return TransformerInterface|null The transformer to use for transforming, or null if no suitable transformer
     *                                   can be returned.
     */
    abstract protected function _getTransformer($source);

    /**
     * Handles the source data in the event that no delegate transformer could retrieved.
     *
     * @since [*next-version*]
     *
     * @param mixed $source The source data for which no transformer was retrieved.
     *
     * @throws TransformerExceptionInterface       If an error occurred during transformation.
     * @throws CouldNotTransformExceptionInterface If the given source data could not be transformed.
     *
     * @return mixed The transformed data.
     */
    abstract protected function _onNoDelegateTransformer($source);

    /**
     * Creates a new Runtime exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|int|float|bool|null $message  The message, if any.
     * @param int|float|string|Stringable|null      $code     The numeric error code, if any.
     * @param RootException|null                    $previous The inner exception, if any.
     *
     * @return RuntimeException The new exception.
     */
    abstract protected function _createRuntimeException($message = null, $code = null, $previous = null);

    /**
     * Translates a string, and replaces placeholders.
     *
     * @since [*next-version*]
     * @see   sprintf()
     * @see   _translate()
     *
     * @param string $string  The format string to translate.
     * @param array  $args    Placeholder values to replace in the string.
     * @param mixed  $context The context for translation.
     *
     * @return string The translated string.
     */
    abstract protected function __($string, $args = [], $context = null);
}
