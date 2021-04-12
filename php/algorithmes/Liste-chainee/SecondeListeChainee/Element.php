<?php
declare(strict_types=1);

namespace ElementList;

/**
 * Version PHP 8.0.3
 * But implémenter une liste chainée une peu complexe et faire quelques opérations dessus
 *
 * Lancement des Tests : Lancement des Tests : phpunit --verbose --coverage-html CodeCoverage
 *
 * @author PascalL7 <https://github.com/PascalL7>
 * @license <https://creativecommons.org/licenses/by-nc-sa/4.0/> CC BY-NC-SA
 * @link https://www.php.net/manual/fr/index.php
 * @version 0.1
 */

/**
 * Class Element
 */
class Element
{
    /**
     * @var int
     */
    protected int $value;

    /**
     * @var Element|null
     */
    protected Element|null $next;

    /**
     * Element constructor.
     */
    public function __construct()
    {
        $getArguments = func_get_args();
        $numberOfArguments = func_num_args();

        if(method_exists($this, $methodName = '__construct' . $numberOfArguments))
        {
            call_user_func([$this, $methodName], $getArguments);
        }
    }

    /**
     * Crée un élément de liste sans successeur.
     * @param int $value
     */
    public function __construct1(int $value)
    {
        $this->value = $value;
        $this->next = null;
    }

    /**
     * Crée un élément de liste avec un successeur.
     * @param int $value
     * @param Element $next
     */
    public function __construct2(int $value, Element $next)
    {
        $this->value = $value;
        $this->next = $next;
    }


    /**
     * @return Element
     */
    public function getNext() : Element
    {
        return $this->next;
    }

    /**
     * @param Element $next
     * @return $this
     */
    public function setNextElement(Element $next) : Element
    {
        $this->next = $next;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param Element $next
     * @return Element
     */
    public function setNext(Element $next): Element
    {
        $this->next = $next;
        return $this;
    }


}
