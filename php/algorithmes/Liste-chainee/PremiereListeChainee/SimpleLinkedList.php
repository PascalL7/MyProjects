<?php

declare(strict_types=1);

namespace SimpleLinkedList;

use Iterator;
use Countable;
use ArrayAccess;
use Exception;
use InvalidArgumentException;

    /**
     * Version PHP 8.0.3
     * But implémenter une liste chainée simple et faire quelques opérations dessus
     *
     * Lancement des Tests : Lancement des Tests : phpunit --verbose --coverage-html CodeCoverage
     *
     * @author  PascalL7 <https://github.com/PascalL7>
     * @license <https://creativecommons.org/licenses/by-nc-sa/4.0/> CC BY-NC-SA
     * @link    https://www.php.net/manual/fr/index.php
     * @version 0.1
     */


    /**
     * Class SimpleLinkedList
     */
class SimpleLinkedList implements Iterator, Countable, ArrayAccess
{
    /** @var array */
    protected array $list = [];

    /** @var int */
    protected int $count;

    /** @var mixed */
    protected mixed $offset;

    /**
     * SimpleLinkedList constructor.
     *
     * @param array $myList
     *
     * @throws Exception
     */
    public function __construct($myList = [])
    {
        if (!is_array($myList)) {
            throw new Exception('Veuillez donner un tableau en entrée.');
        }

        foreach ($myList as $myOffset => $myElement) {
            $this->offsetSet($myOffset, $myElement);
        }

        $this->count = 0;
        $this->offset = 0;
    }

    /**
     * ArrayAccess
     * Assigne une valeur à une position donnée
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->list[] = $value;
        } else {
            $this->list[$offset] = $value;
        }
    }

    /**
     * ArrayAccess
     * Supprime un élément à une position donnée
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->list[$offset]);
    }

    /**
     * Affiche la liste
     * @return SimpleLinkedList
     */
    public function displayList(): SimpleLinkedList
    {
        foreach ($this->list as $element) {
            echo $element . "\n";
        }

        return $this;
    }

    /**
     * Affiche l'élément courant, clé et position au format array ou json
     *
     * @param string $format
     *
     * @return SimpleLinkedList
     * @throws InvalidArgumentException
     */
    public function displayCurrentElement(string $format = 'array'): SimpleLinkedList
    {
        if ($format !== 'array' && $format !== 'json') {
            throw new InvalidArgumentException("Format attendu = array ou json");
        }

        $returnValue = [$this->key(), $this->current()];

        if ($format === 'array') {
            print_r($returnValue);
        }

        if ($format === 'json') {
            echo json_encode($returnValue, JSON_FORCE_OBJECT);
        }

        return $this;
    }

    /**
     * Iterator
     * Retourne la clé de l'élément courant
     * @return mixed
     */
    public function key(): mixed
    {
        return $this->offset;
    }

    /**
     * Iterator
     * Retourne l'élément courant
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->offset;
    }

    /**
     * Iterator
     * Se déplace sur l'élément suivant
     * @return void
     */
    public function next(): void
    {
        ++$this->offset;
    }

    /**
     * Iterator
     * Vérifie si la position courante est valide
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->list[$this->offset]);
    }

    /**
     * ArrayAccess
     * Position à lire
     *
     * @param mixed $offset
     *
     * @return mixed $offset|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset) ? $this->list[$offset] : null;
    }

    /**
     * ArrayAccess
     * Indique si une position existe dans un tableau
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->list[$offset]);
    }

    /**
     * Iterator
     * Replace l'itérateur sur le premier élément
     * @return void
     */
    public function rewind(): void
    {
        $this->offset = 0;
    }

    /**
     * Ajoute un élément à la fin de la liste
     *
     * @param string $value
     *
     * @return SimpleLinkedList
     */
    public function addElementAtEnd(string $value): SimpleLinkedList
    {
        $this->offsetSet($this->count() + 1, $value);
        return $this;
    }

    /**
     * Countable
     * Compte le nombre d'éléments d'un objet
     * @return int
     */
    public function count(): int
    {
        return count($this->list);
    }
}
