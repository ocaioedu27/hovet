Extension [ <persistent> extension #20 dom version 20031129 ] {

  - Dependencies {
    Dependency [ libxml (Required) ]
    Dependency [ domxml (Conflicts) ]
  }

  - Constants [45] {
    Constant [ int XML_ELEMENT_NODE ] { 1 }
    Constant [ int XML_ATTRIBUTE_NODE ] { 2 }
    Constant [ int XML_TEXT_NODE ] { 3 }
    Constant [ int XML_CDATA_SECTION_NODE ] { 4 }
    Constant [ int XML_ENTITY_REF_NODE ] { 5 }
    Constant [ int XML_ENTITY_NODE ] { 6 }
    Constant [ int XML_PI_NODE ] { 7 }
    Constant [ int XML_COMMENT_NODE ] { 8 }
    Constant [ int XML_DOCUMENT_NODE ] { 9 }
    Constant [ int XML_DOCUMENT_TYPE_NODE ] { 10 }
    Constant [ int XML_DOCUMENT_FRAG_NODE ] { 11 }
    Constant [ int XML_NOTATION_NODE ] { 12 }
    Constant [ int XML_HTML_DOCUMENT_NODE ] { 13 }
    Constant [ int XML_DTD_NODE ] { 14 }
    Constant [ int XML_ELEMENT_DECL_NODE ] { 15 }
    Constant [ int XML_ATTRIBUTE_DECL_NODE ] { 16 }
    Constant [ int XML_ENTITY_DECL_NODE ] { 17 }
    Constant [ int XML_NAMESPACE_DECL_NODE ] { 18 }
    Constant [ int XML_LOCAL_NAMESPACE ] { 18 }
    Constant [ int XML_ATTRIBUTE_CDATA ] { 1 }
    Constant [ int XML_ATTRIBUTE_ID ] { 2 }
    Constant [ int XML_ATTRIBUTE_IDREF ] { 3 }
    Constant [ int XML_ATTRIBUTE_IDREFS ] { 4 }
    Constant [ int XML_ATTRIBUTE_ENTITY ] { 6 }
    Constant [ int XML_ATTRIBUTE_NMTOKEN ] { 7 }
    Constant [ int XML_ATTRIBUTE_NMTOKENS ] { 8 }
    Constant [ int XML_ATTRIBUTE_ENUMERATION ] { 9 }
    Constant [ int XML_ATTRIBUTE_NOTATION ] { 10 }
    Constant [ int DOM_PHP_ERR ] { 0 }
    Constant [ int DOM_INDEX_SIZE_ERR ] { 1 }
    Constant [ int DOMSTRING_SIZE_ERR ] { 2 }
    Constant [ int DOM_HIERARCHY_REQUEST_ERR ] { 3 }
    Constant [ int DOM_WRONG_DOCUMENT_ERR ] { 4 }
    Constant [ int DOM_INVALID_CHARACTER_ERR ] { 5 }
    Constant [ int DOM_NO_DATA_ALLOWED_ERR ] { 6 }
    Constant [ int DOM_NO_MODIFICATION_ALLOWED_ERR ] { 7 }
    Constant [ int DOM_NOT_FOUND_ERR ] { 8 }
    Constant [ int DOM_NOT_SUPPORTED_ERR ] { 9 }
    Constant [ int DOM_INUSE_ATTRIBUTE_ERR ] { 10 }
    Constant [ int DOM_INVALID_STATE_ERR ] { 11 }
    Constant [ int DOM_SYNTAX_ERR ] { 12 }
    Constant [ int DOM_INVALID_MODIFICATION_ERR ] { 13 }
    Constant [ int DOM_NAMESPACE_ERR ] { 14 }
    Constant [ int DOM_INVALID_ACCESS_ERR ] { 15 }
    Constant [ int DOM_VALIDATION_ERR ] { 16 }
  }

  - Functions {
    Function [ <internal:dom> function dom_import_simplexml ] {

      - Parameters [1] {
        Parameter #0 [ <required> object $node ]
      }
      - Return [ DOMElement ]
    }
  }

  - Classes [22] {
    Class [ <internal:dom> final class DOMException extends Exception implements Throwable, Stringable ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [4] {
        Property [ protected $message = '' ]
        Property [ protected string $file = '' ]
        Property [ protected int $line = 0 ]
        Property [ public $code = 0 ]
      }

      - Methods [10] {
        Method [ <internal:Core, inherits Exception, ctor> public method __construct ] {

          - Parameters [3] {
            Parameter #0 [ <optional> string $message = "" ]
            Parameter #1 [ <optional> int $code = 0 ]
            Parameter #2 [ <optional> ?Throwable $previous = null ]
          }
        }

        Method [ <internal:Core, inherits Exception> public method __wakeup ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getMessage ] {

          - Parameters [0] {
          }
          - Return [ string ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getCode ] {

          - Parameters [0] {
          }
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getFile ] {

          - Parameters [0] {
          }
          - Return [ string ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getLine ] {

          - Parameters [0] {
          }
          - Return [ int ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getTrace ] {

          - Parameters [0] {
          }
          - Return [ array ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getPrevious ] {

          - Parameters [0] {
          }
          - Return [ ?Throwable ]
        }

        Method [ <internal:Core, inherits Exception, prototype Throwable> final public method getTraceAsString ] {

          - Parameters [0] {
          }
          - Return [ string ]
        }

        Method [ <internal:Core, inherits Exception, prototype Stringable> public method __toString ] {

          - Parameters [0] {
          }
          - Return [ string ]
        }
      }
    }

    Interface [ <internal:dom> interface DOMParentNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [0] {
      }

      - Methods [2] {
        Method [ <internal:dom> abstract public method append ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom> abstract public method prepend ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }
      }
    }

    Interface [ <internal:dom> interface DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [0] {
      }

      - Methods [4] {
        Method [ <internal:dom> abstract public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom> abstract public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom> abstract public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom> abstract public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }
      }
    }

    Class [ <internal:dom> class DOMImplementation ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [0] {
      }

      - Methods [4] {
        Method [ <internal:dom> public method getFeature ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ never ]
        }

        Method [ <internal:dom> public method hasFeature ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method createDocumentType ] {

          - Parameters [3] {
            Parameter #0 [ <required> string $qualifiedName ]
            Parameter #1 [ <optional> string $publicId = "" ]
            Parameter #2 [ <optional> string $systemId = "" ]
          }
        }

        Method [ <internal:dom> public method createDocument ] {

          - Parameters [3] {
            Parameter #0 [ <optional> ?string $namespace = null ]
            Parameter #1 [ <optional> string $qualifiedName = "" ]
            Parameter #2 [ <optional> ?DOMDocumentType $doctype = null ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [16] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
      }

      - Methods [17] {
        Method [ <internal:dom> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMNameSpaceNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [8] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $namespaceURI ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?DOMNode $parentNode ]
      }

      - Methods [0] {
      }
    }

    Class [ <internal:dom> class DOMDocumentFragment extends DOMNode implements DOMParentNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [19] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public ?DOMElement $firstElementChild ]
        Property [ public ?DOMElement $lastElementChild ]
        Property [ public int $childElementCount ]
      }

      - Methods [21] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [0] {
          }
        }

        Method [ <internal:dom> public method appendXML ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, prototype DOMParentNode> public method append ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMParentNode> public method prepend ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMDocument extends DOMNode implements DOMParentNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [38] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public ?DOMDocumentType $doctype ]
        Property [ public DOMImplementation $implementation ]
        Property [ public ?DOMElement $documentElement ]
        Property [ public ?string $actualEncoding ]
        Property [ public ?string $encoding ]
        Property [ public ?string $xmlEncoding ]
        Property [ public bool $standalone ]
        Property [ public bool $xmlStandalone ]
        Property [ public ?string $version ]
        Property [ public ?string $xmlVersion ]
        Property [ public bool $strictErrorChecking ]
        Property [ public ?string $documentURI ]
        Property [ public mixed $config = NULL ]
        Property [ public bool $formatOutput ]
        Property [ public bool $validateOnParse ]
        Property [ public bool $resolveExternals ]
        Property [ public bool $preserveWhiteSpace ]
        Property [ public bool $recover ]
        Property [ public bool $substituteEntities ]
        Property [ public ?DOMElement $firstElementChild ]
        Property [ public ?DOMElement $lastElementChild ]
        Property [ public int $childElementCount ]
      }

      - Methods [51] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [2] {
            Parameter #0 [ <optional> string $version = "1.0" ]
            Parameter #1 [ <optional> string $encoding = "" ]
          }
        }

        Method [ <internal:dom> public method createAttribute ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $localName ]
          }
        }

        Method [ <internal:dom> public method createAttributeNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $qualifiedName ]
          }
        }

        Method [ <internal:dom> public method createCDATASection ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
        }

        Method [ <internal:dom> public method createComment ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ DOMComment ]
        }

        Method [ <internal:dom> public method createDocumentFragment ] {

          - Parameters [0] {
          }
          - Tentative return [ DOMDocumentFragment ]
        }

        Method [ <internal:dom> public method createElement ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $localName ]
            Parameter #1 [ <optional> string $value = "" ]
          }
        }

        Method [ <internal:dom> public method createElementNS ] {

          - Parameters [3] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $qualifiedName ]
            Parameter #2 [ <optional> string $value = "" ]
          }
        }

        Method [ <internal:dom> public method createEntityReference ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $name ]
          }
        }

        Method [ <internal:dom> public method createProcessingInstruction ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $target ]
            Parameter #1 [ <optional> string $data = "" ]
          }
        }

        Method [ <internal:dom> public method createTextNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ DOMText ]
        }

        Method [ <internal:dom> public method getElementById ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $elementId ]
          }
          - Tentative return [ ?DOMElement ]
        }

        Method [ <internal:dom> public method getElementsByTagName ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ DOMNodeList ]
        }

        Method [ <internal:dom> public method getElementsByTagNameNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ DOMNodeList ]
        }

        Method [ <internal:dom> public method importNode ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom> public method load ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $filename ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
        }

        Method [ <internal:dom> public method loadXML ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $source ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
        }

        Method [ <internal:dom> public method normalizeDocument ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method registerNodeClass ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $baseClass ]
            Parameter #1 [ <required> ?string $extendedClass ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method save ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $filename ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom> public method loadHTML ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $source ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
        }

        Method [ <internal:dom> public method loadHTMLFile ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $filename ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
        }

        Method [ <internal:dom> public method saveHTML ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ?DOMNode $node = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom> public method saveHTMLFile ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $filename ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom> public method saveXML ] {

          - Parameters [2] {
            Parameter #0 [ <optional> ?DOMNode $node = null ]
            Parameter #1 [ <optional> int $options = 0 ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom> public method schemaValidate ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $filename ]
            Parameter #1 [ <optional> int $flags = 0 ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method schemaValidateSource ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $source ]
            Parameter #1 [ <optional> int $flags = 0 ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method relaxNGValidate ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $filename ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method relaxNGValidateSource ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $source ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method validate ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method xinclude ] {

          - Parameters [1] {
            Parameter #0 [ <optional> int $options = 0 ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom> public method adoptNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, prototype DOMParentNode> public method append ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMParentNode> public method prepend ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> <iterateable> class DOMNodeList implements IteratorAggregate, Traversable, Countable ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [1] {
        Property [ public int $length ]
      }

      - Methods [3] {
        Method [ <internal:dom, prototype Countable> public method count ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, prototype IteratorAggregate> public method getIterator ] {

          - Parameters [0] {
          }
          - Return [ Iterator ]
        }

        Method [ <internal:dom> public method item ] {

          - Parameters [1] {
            Parameter #0 [ <required> int $index ]
          }
        }
      }
    }

    Class [ <internal:dom> <iterateable> class DOMNamedNodeMap implements IteratorAggregate, Traversable, Countable ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [1] {
        Property [ public int $length ]
      }

      - Methods [5] {
        Method [ <internal:dom> public method getNamedItem ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ ?DOMNode ]
        }

        Method [ <internal:dom> public method getNamedItemNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ ?DOMNode ]
        }

        Method [ <internal:dom> public method item ] {

          - Parameters [1] {
            Parameter #0 [ <required> int $index ]
          }
          - Tentative return [ ?DOMNode ]
        }

        Method [ <internal:dom, prototype Countable> public method count ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, prototype IteratorAggregate> public method getIterator ] {

          - Parameters [0] {
          }
          - Return [ Iterator ]
        }
      }
    }

    Class [ <internal:dom> class DOMCharacterData extends DOMNode implements DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [20] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $data ]
        Property [ public int $length ]
        Property [ public ?DOMElement $previousElementSibling ]
        Property [ public ?DOMElement $nextElementSibling ]
      }

      - Methods [26] {
        Method [ <internal:dom> public method appendData ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method substringData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
        }

        Method [ <internal:dom> public method insertData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method deleteData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method replaceData ] {

          - Parameters [3] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
            Parameter #2 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMAttr extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [21] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $name ]
        Property [ public bool $specified = true ]
        Property [ public string $value ]
        Property [ public ?DOMElement $ownerElement ]
        Property [ public mixed $schemaTypeInfo = NULL ]
      }

      - Methods [19] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $name ]
            Parameter #1 [ <optional> string $value = "" ]
          }
        }

        Method [ <internal:dom> public method isId ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMElement extends DOMNode implements DOMParentNode, DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [23] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $tagName ]
        Property [ public mixed $schemaTypeInfo = NULL ]
        Property [ public ?DOMElement $firstElementChild ]
        Property [ public ?DOMElement $lastElementChild ]
        Property [ public int $childElementCount ]
        Property [ public ?DOMElement $previousElementSibling ]
        Property [ public ?DOMElement $nextElementSibling ]
      }

      - Methods [42] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [3] {
            Parameter #0 [ <required> string $qualifiedName ]
            Parameter #1 [ <optional> ?string $value = null ]
            Parameter #2 [ <optional> string $namespace = "" ]
          }
        }

        Method [ <internal:dom> public method getAttribute ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ string ]
        }

        Method [ <internal:dom> public method getAttributeNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ string ]
        }

        Method [ <internal:dom> public method getAttributeNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
        }

        Method [ <internal:dom> public method getAttributeNodeNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
        }

        Method [ <internal:dom> public method getElementsByTagName ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ DOMNodeList ]
        }

        Method [ <internal:dom> public method getElementsByTagNameNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ DOMNodeList ]
        }

        Method [ <internal:dom> public method hasAttribute ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method hasAttributeNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method removeAttribute ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $qualifiedName ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method removeAttributeNS ] {

          - Parameters [2] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $localName ]
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method removeAttributeNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMAttr $attr ]
          }
        }

        Method [ <internal:dom> public method setAttribute ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $qualifiedName ]
            Parameter #1 [ <required> string $value ]
          }
        }

        Method [ <internal:dom> public method setAttributeNS ] {

          - Parameters [3] {
            Parameter #0 [ <required> ?string $namespace ]
            Parameter #1 [ <required> string $qualifiedName ]
            Parameter #2 [ <required> string $value ]
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method setAttributeNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMAttr $attr ]
          }
        }

        Method [ <internal:dom> public method setAttributeNodeNS ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMAttr $attr ]
          }
        }

        Method [ <internal:dom> public method setIdAttribute ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $qualifiedName ]
            Parameter #1 [ <required> bool $isId ]
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method setIdAttributeNS ] {

          - Parameters [3] {
            Parameter #0 [ <required> string $namespace ]
            Parameter #1 [ <required> string $qualifiedName ]
            Parameter #2 [ <required> bool $isId ]
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom> public method setIdAttributeNode ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMAttr $attr ]
            Parameter #1 [ <required> bool $isId ]
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMChildNode> public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMParentNode> public method append ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, prototype DOMParentNode> public method prepend ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMText extends DOMCharacterData implements DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [21] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $data ]
        Property [ public int $length ]
        Property [ public ?DOMElement $previousElementSibling ]
        Property [ public ?DOMElement $nextElementSibling ]
        Property [ public string $wholeText ]
      }

      - Methods [30] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [1] {
            Parameter #0 [ <optional> string $data = "" ]
          }
        }

        Method [ <internal:dom> public method isWhitespaceInElementContent ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method isElementContentWhitespace ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method splitText ] {

          - Parameters [1] {
            Parameter #0 [ <required> int $offset ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method appendData ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method substringData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method insertData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method deleteData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method replaceData ] {

          - Parameters [3] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
            Parameter #2 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMComment extends DOMCharacterData implements DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [20] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $data ]
        Property [ public int $length ]
        Property [ public ?DOMElement $previousElementSibling ]
        Property [ public ?DOMElement $nextElementSibling ]
      }

      - Methods [27] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [1] {
            Parameter #0 [ <optional> string $data = "" ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method appendData ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method substringData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method insertData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method deleteData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method replaceData ] {

          - Parameters [3] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
            Parameter #2 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMCdataSection extends DOMText implements DOMChildNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [21] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $data ]
        Property [ public int $length ]
        Property [ public ?DOMElement $previousElementSibling ]
        Property [ public ?DOMElement $nextElementSibling ]
        Property [ public string $wholeText ]
      }

      - Methods [30] {
        Method [ <internal:dom, overwrites DOMText, ctor> public method __construct ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
        }

        Method [ <internal:dom, inherits DOMText> public method isWhitespaceInElementContent ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMText> public method isElementContentWhitespace ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMText> public method splitText ] {

          - Parameters [1] {
            Parameter #0 [ <required> int $offset ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method appendData ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method substringData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method insertData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method deleteData ] {

          - Parameters [2] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData> public method replaceData ] {

          - Parameters [3] {
            Parameter #0 [ <required> int $offset ]
            Parameter #1 [ <required> int $count ]
            Parameter #2 [ <required> string $data ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method replaceWith ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method remove ] {

          - Parameters [0] {
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method before ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMCharacterData, prototype DOMChildNode> public method after ] {

          - Parameters [1] {
            Parameter #0 [ <optional> ...$nodes ]
          }
          - Return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMDocumentType extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [22] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $name ]
        Property [ public DOMNamedNodeMap $entities ]
        Property [ public DOMNamedNodeMap $notations ]
        Property [ public string $publicId ]
        Property [ public string $systemId ]
        Property [ public ?string $internalSubset ]
      }

      - Methods [17] {
        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMNotation extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [18] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $publicId ]
        Property [ public string $systemId ]
      }

      - Methods [17] {
        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMEntity extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [22] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public ?string $publicId ]
        Property [ public ?string $systemId ]
        Property [ public ?string $notationName ]
        Property [ public ?string $actualEncoding = NULL ]
        Property [ public ?string $encoding = NULL ]
        Property [ public ?string $version = NULL ]
      }

      - Methods [17] {
        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMEntityReference extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [16] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
      }

      - Methods [18] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $name ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMProcessingInstruction extends DOMNode ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [18] {
        Property [ public string $nodeName ]
        Property [ public ?string $nodeValue ]
        Property [ public int $nodeType ]
        Property [ public ?DOMNode $parentNode ]
        Property [ public DOMNodeList $childNodes ]
        Property [ public ?DOMNode $firstChild ]
        Property [ public ?DOMNode $lastChild ]
        Property [ public ?DOMNode $previousSibling ]
        Property [ public ?DOMNode $nextSibling ]
        Property [ public ?DOMNamedNodeMap $attributes ]
        Property [ public ?DOMDocument $ownerDocument ]
        Property [ public ?string $namespaceURI ]
        Property [ public string $prefix ]
        Property [ public ?string $localName ]
        Property [ public ?string $baseURI ]
        Property [ public string $textContent ]
        Property [ public string $target ]
        Property [ public string $data ]
      }

      - Methods [18] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $name ]
            Parameter #1 [ <optional> string $value = "" ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method appendChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $node ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method C14N ] {

          - Parameters [4] {
            Parameter #0 [ <optional> bool $exclusive = false ]
            Parameter #1 [ <optional> bool $withComments = false ]
            Parameter #2 [ <optional> ?array $xpath = null ]
            Parameter #3 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ string|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method C14NFile ] {

          - Parameters [5] {
            Parameter #0 [ <required> string $uri ]
            Parameter #1 [ <optional> bool $exclusive = false ]
            Parameter #2 [ <optional> bool $withComments = false ]
            Parameter #3 [ <optional> ?array $xpath = null ]
            Parameter #4 [ <optional> ?array $nsPrefixes = null ]
          }
          - Tentative return [ int|false ]
        }

        Method [ <internal:dom, inherits DOMNode> public method cloneNode ] {

          - Parameters [1] {
            Parameter #0 [ <optional> bool $deep = false ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method getLineNo ] {

          - Parameters [0] {
          }
          - Tentative return [ int ]
        }

        Method [ <internal:dom, inherits DOMNode> public method getNodePath ] {

          - Parameters [0] {
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasAttributes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method hasChildNodes ] {

          - Parameters [0] {
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method insertBefore ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <optional> ?DOMNode $child = null ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method isDefaultNamespace ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSameNode ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $otherNode ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method isSupported ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $feature ]
            Parameter #1 [ <required> string $version ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupNamespaceURI ] {

          - Parameters [1] {
            Parameter #0 [ <required> ?string $prefix ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method lookupPrefix ] {

          - Parameters [1] {
            Parameter #0 [ <required> string $namespace ]
          }
          - Tentative return [ ?string ]
        }

        Method [ <internal:dom, inherits DOMNode> public method normalize ] {

          - Parameters [0] {
          }
          - Tentative return [ void ]
        }

        Method [ <internal:dom, inherits DOMNode> public method removeChild ] {

          - Parameters [1] {
            Parameter #0 [ <required> DOMNode $child ]
          }
        }

        Method [ <internal:dom, inherits DOMNode> public method replaceChild ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMNode $node ]
            Parameter #1 [ <required> DOMNode $child ]
          }
        }
      }
    }

    Class [ <internal:dom> class DOMXPath ] {

      - Constants [0] {
      }

      - Static properties [0] {
      }

      - Static methods [0] {
      }

      - Properties [2] {
        Property [ public DOMDocument $document ]
        Property [ public bool $registerNodeNamespaces ]
      }

      - Methods [5] {
        Method [ <internal:dom, ctor> public method __construct ] {

          - Parameters [2] {
            Parameter #0 [ <required> DOMDocument $document ]
            Parameter #1 [ <optional> bool $registerNodeNS = true ]
          }
        }

        Method [ <internal:dom> public method evaluate ] {

          - Parameters [3] {
            Parameter #0 [ <required> string $expression ]
            Parameter #1 [ <optional> ?DOMNode $contextNode = null ]
            Parameter #2 [ <optional> bool $registerNodeNS = true ]
          }
          - Tentative return [ mixed ]
        }

        Method [ <internal:dom> public method query ] {

          - Parameters [3] {
            Parameter #0 [ <required> string $expression ]
            Parameter #1 [ <optional> ?DOMNode $contextNode = null ]
            Parameter #2 [ <optional> bool $registerNodeNS = true ]
          }
          - Tentative return [ mixed ]
        }

        Method [ <internal:dom> public method registerNamespace ] {

          - Parameters [2] {
            Parameter #0 [ <required> string $prefix ]
            Parameter #1 [ <required> string $namespace ]
          }
          - Tentative return [ bool ]
        }

        Method [ <internal:dom> public method registerPhpFunctions ] {

          - Parameters [1] {
            Parameter #0 [ <optional> array|string|null $restrict = null ]
          }
          - Tentative return [ void ]
        }
      }
    }
  }
}

