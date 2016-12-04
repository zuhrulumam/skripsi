<?php

namespace Litipk\Exceptions;

/**
 * @author  Andreu Correa Casablanca <castarco@litipk.com>
 */
final class InvalidCastException extends \LogicException
{
    /**
     * Original Type
     * @var string
     */
    private $source_type;

    /**
     * Target type
     * @var string
     */
    private $target_type;

    /**
     * @param string    $source_type  Original/Source type
     * @param string    $target_type  Target type
     * @param string    $message      See Exception definition
     * @param integer   $code         See Exception definition
     * @param Exception $previous     See Exception definition
     */
    public function __construct ($source_type, $target_type, $message = "", $code = 0, Exception $previous = null)
    {
        if (!is_string($source_type) || empty($source_type) || !is_string($target_type) || empty($target_type)) {
            throw new \LogicException();
        }

        if ($source_type === $target_type) {
            throw new \LogicException("It's a nonsense to raise an InvalidCastException when \$source_type is equal to \$target_type.");
        }

        $this->source_type = $source_type;
        $this->target_type = $target_type;
    }

    /**
     * Returns the source type
     *
     * @return string
     */
    public function getSourceType ()
    {
        return $this->source_type;
    }

    /**
     * Returns the target type
     *
     * @return string
     */
    public function getTargetType ()
    {
        return $this->target_type;
    }
}
