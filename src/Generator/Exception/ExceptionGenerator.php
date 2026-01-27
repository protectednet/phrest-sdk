<?php

namespace Phrest\SDK\Generator\Exception;

use Laminas\Code\Generator\ClassGenerator;
use Phrest\SDK\Generator\AbstractGenerator;
use Phrest\SDK\Generator\Helper\ClassGen;

class ExceptionGenerator extends AbstractGenerator
{
  /**
   * @var string
   */
  protected $namespace;

  /**
   * @var string
   */
  protected $extends;

  /**
   * @var string
   */
  protected $entityName;

  /**
   * @var string
   */
  protected $exception;

  /**
   * @var string
   */
  protected $message;

  /**
   * @param string $version
   * @param string $entityName
   * @param        $exception
   */
  public function __construct(
    $version,
    $entityName,
    $exception
  )
  {
    $this->entityName = $entityName;
    $this->exception = $exception->exception;
    $this->message = $exception->message;
    $this->extends = $exception->extends;
    parent::__construct($version, $entityName);
  }

  /**
   * @return ClassGenerator
   */
  public function create()
  {
    $class = ClassGen::classGen(
      $this->exception,
      $this->namespace
    );

    if (!empty($this->extends))
    {
      $class->addUse('Phrest\\API\\Exceptions\\' . $this->extends);
      $class->setExtendedClass($this->extends);
    }

    return $class;
  }

  /**
   * @param string $namespace
   *
   * @return ExceptionGenerator
   */
  public function setNamespace($namespace)
  {
    $this->namespace = $namespace;

    return $this;
  }

  /**
   * @return string
   */
  public function getEntityName()
  {
    return $this->entityName;
  }

  /**
   * @param array $extends
   *
   * @return ExceptionGenerator
   */
  public function setExtends($extends)
  {
    $this->extends = $extends;

    return $this;
}

  /**
   * @return string
   */
  public function getException()
  {
    return $this->exception;
  }
}
