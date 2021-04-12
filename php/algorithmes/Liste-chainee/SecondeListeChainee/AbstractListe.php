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

abstract class AbstractListe
{
    /**
     * @return bool
     */
    public function isNull() : bool { return false;}

    /**
     * @return Element
     */
    public function getFirst() : Element { return Element;}

    /**
     * @param int $value
     */
    public function addAtFirst(int $value) : void {}

    /**
     * @return int
     */
    public function getLength() : int { return 0;}

    /**
     * @param int $value
     * @return bool
     */
    public function contain(int $value) : bool { return false;}

    /**
     * @param int $value
     */
    public function deleteFirstElement(int $value) : void {}

    /**
     * @param Liste $list
     */
    public function concat(Liste $list) : void {}
}