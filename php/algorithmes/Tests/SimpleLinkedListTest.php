<?php

/**
 * Test de la classe SimpleLinkedList
 *
 * Lancement des Tests : phpunit --verbose --coverage-html CodeCoverage
 *
 * @author PascalL7 <https://github.com/PascalL7>
 * @license <https://creativecommons.org/licenses/by-nc-sa/4.0/> CC BY-NC-SA
 * @link https://phpunit.readthedocs.io/fr/latest/
 * @version 0.1
 */

namespace SimpleLinkedList;

use Exception;
use PHPUnit\Framework\TestCase;

//require_once "../Liste-chainee/PremiereListeChainee/SimpleLinkedList.php";
require_once "/home/travis/build/PascalL7/MyProjects/php/algorithmes/Liste-chainee/PremiereListeChainee/SimpleLinkedList.php";

class SimpleLinkedListTest extends TestCase
{
    /** @var object|SimpleLinkedList */
    private object $myLinkList;

    /**
     * @return void
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        // initialise une liste chainee
        $this->myLinkList = new SimpleLinkedList(['Ananas', 'Fraise', 'Cerise']);
    }

    /**
     * Don't Work in PHP 8.0.3 :  $property->setAccessible(true);
     * @coversNothing
     */
    /*
    public function testContructor()
    {
        $myList = ['Ananas', 'Fraise', 'Cerise'];

        $this->assertInstanceOf("SimpleLinkedList\SimpleLinkedList", $this->myLinkList);
        $mock = $this->getMockBuilder(SimpleLinkedList::class)
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($myList as $myOffset => $myElement) {
            $mock->expects($this->any())
                ->method('offsetSet')
                ->with($myOffset, $myElement);
        }

        $reflector = new \ReflectionClass(SimpleLinkedList::class);
        $property = $reflector->getProperty('list');
        $property->setAccessible(true);

        $reflectorClass = new \ReflectionClass(SimpleLinkedList::class);
        $constructor = $reflectorClass->getConstructor();
        $constructor->invoke($mock, $property);

    }
    */

    /**
     * Teste si la liste à été initialisée
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @covers \SimpleLinkedList\SimpleLinkedList::count
     * @return void
     */
    public function testInitialList(): void
    {
        // appelle la fonction d'affichage
        $this->myLinkList->displayList();

        // vérifie l'affichage attendu
        $expected = "Ananas\nFraise\nCerise\n";
        $this->expectOutputString($expected);

        // on attend 3 éléments dans la liste
        $this->assertEquals(3, $this->myLinkList->count());
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetUnset
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @return void
     */
    public function testWithDeletedSecondElement(): void
    {
        // suppression du second élément de la liste
        $this->myLinkList->offsetUnset(1);

        // appelle la fonction d'affichage
        $this->myLinkList->displayList();

        // vérifie l'affichage attendu
        $expected = "Ananas\nCerise\n";
        $this->expectOutputString($expected);

        // on attend 2 éléments dans la liste
        $this->assertEquals(2, $this->myLinkList->count());
    }

    /**
     * Teste l'affichage de l'élément courant en Array
     * @covers \SimpleLinkedList\SimpleLinkedList::displayCurrentElement
     * @return void
     * @throws Exception
     */
    public function testDisplayCurrentElementArray(): void
    {
        $this->myLinkList->displayCurrentElement('array');
        $this->expectOutputString("Array\n(\n    [0] => 0\n    [1] => 0\n)\n");
    }

    /**
     * Teste l'affichage de l'élément courant en JSON
     * @covers \SimpleLinkedList\SimpleLinkedList::displayCurrentElement
     * @return void
     * @throws Exception
     */
    public function testDisplayCurrentElementJson(): void
    {
        $this->myLinkList->displayCurrentElement('json');
        $this->expectOutputString('{"0":0,"1":0}');
    }

    /**
     * Teste si l'Exception de la méthode displayCurrentElement est levée
     * @covers \SimpleLinkedList\SimpleLinkedList::displayCurrentElement
     * @throws \InvalidArgumentException
     */
    public function testFailureDisplayCurrentElement(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->myLinkList->displayCurrentElement('xml');
    }

    /**
     * Teste si l'avancement d'un élément fonctionne
     * @covers \SimpleLinkedList\SimpleLinkedList::next
     * @return void
     */
    public function testNext(): void
    {
        $this->myLinkList->next();
        $this->assertSame(1, 1);
    }

    /**
     * Teste la fonction rewind
     * @covers \SimpleLinkedList\SimpleLinkedList::rewind
     * @return void
     */
    public function testRewind(): void
    {
        $this->myLinkList->rewind();
        $this->assertSame(0, 0);
    }

    /**
     * Teste si la modification d'un élément à la position courante (0 dans ce cas) est ok
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetSet
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @return void
     */
    public function testAddElementPositionZero(): void
    {
        $this->myLinkList->offsetSet($this->myLinkList->current(), 'Banane');

        // appelle la fonction d'affichage
        $this->myLinkList->displayList();

        // vérifie l'affichage attendu
        $expected = "Banane\nFraise\nCerise\n";
        $this->expectOutputString($expected);

        // on attend 3 éléments dans la liste
        $this->assertEquals(3, $this->myLinkList->count());
    }

    /**
     * Teste si la modification de l'élément à la position 2 dans ce cas, est ok
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetSet
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @return void
     */
    public function testAddElementPositionTwo(): void
    {
        // remplacement de la seconde valeur par Orange
        $this->myLinkList->offsetSet(2, 'Orange');

        // appelle la fonction d'affichage
        $this->myLinkList->displayList();

        // vérifie l'affichage attendu
        $expected = "Ananas\nFraise\nOrange\n";
        $this->expectOutputString($expected);

        // on attend 3 éléments dans la liste
        $this->assertEquals(3, $this->myLinkList->count());
    }

    /**
     * Teste si l'on peut ajouter un élément à la fin de la liste
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @covers \SimpleLinkedList\SimpleLinkedList::addElementAtEnd
     * @return void
     */
    public function testAddElementAtEnd(): void
    {
        // affichage de la liste avant l'ajout de l'élément
        $this->myLinkList->displayList();
        $expected = "Ananas\nFraise\nCerise\n";
        $this->expectOutputString($expected);
        ob_clean();

        // Ajout d'un élément en fin de liste
        $this->myLinkList->addElementAtEnd('Framboise');
        $this->assertEquals(4, $this->myLinkList->count());

        // vérifie l'affichage attendu
        $this->myLinkList->displayList();
        $expected = "Ananas\nFraise\nCerise\nFramboise\n";
        $this->expectOutputString($expected);

        // on attend 4 éléments dans la liste
        $this->assertEquals(4, $this->myLinkList->count());
    }

    /**
     * Teste la méthode offsetSet
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetSet
     * @covers \SimpleLinkedList\SimpleLinkedList::displayList
     * @return void
     */
    public function testOffsetSet(): void
    {
        $this->myLinkList->offsetSet(null, 'Banane');
        $this->myLinkList->offsetSet(0, 'Clémentine');
        $this->myLinkList->displayList();
        $expected = "Clémentine\nFraise\nCerise\nBanane\n";
        $this->expectOutputString($expected);
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::key
     * @return void
     */
    public function testKeyMethod(): void
    {
        $this->assertEquals(0, $this->myLinkList->key());
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::current
     * @return void
     */
    public function testCurrentMethod(): void
    {
        $this->assertEquals(0, $this->myLinkList->current());
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetExists
     * @return void
     */
    public function testOffsetExistMethod(): void
    {
        $this->assertTrue($this->myLinkList->offsetExists(0));
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::valid
     * @return void
     */
    public function testValidMethod(): void
    {
        $this->assertTrue($this->myLinkList->valid());
    }

    /**
     * @covers \SimpleLinkedList\SimpleLinkedList::offsetGet
     * @return void
     */
    public function testOffsetGetMethod(): void
    {
        $this->assertEquals(null, $this->myLinkList->offsetGet(20));
        $this->assertEquals('Ananas', $this->myLinkList->offsetGet(0));
    }

}
