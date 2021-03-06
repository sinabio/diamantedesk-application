<?php
/*
 * Copyright (c) 2014 Eltrino LLC (http://eltrino.com)
 *
 * Licensed under the Open Software License (OSL 3.0).
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://opensource.org/licenses/osl-3.0.php
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@eltrino.com so we can send you a copy immediately.
 */
namespace Diamante\DeskBundle\Tests\Model\Branch;

use Diamante\DeskBundle\Model\Branch\Branch;
use Diamante\DeskBundle\Model\Branch\Logo;
use Oro\Bundle\UserBundle\Entity\User;

class BranchTest extends \PHPUnit_Framework_TestCase
{
    const BRANCH_NAME         = 'Name';
    const BRANCH_DESCRIPTION  = 'Description';
    const BRANCH_IMAGE        = 'Image';

    /**
     * @test
     */
    public function thatCreate()
    {
        $defaultAssignee = new User();
        $logo = new Logo('file.dummy');
        $branch = new Branch('DUMM', 'DUMMY_NAME', 'DUMMY_DESC', $defaultAssignee, $logo);

        $this->assertEquals('DUMM', $branch->getKey());
        $this->assertEquals('DUMMY_NAME', $branch->getName());
        $this->assertEquals('DUMMY_DESC', $branch->getDescription());
        $this->assertEquals($defaultAssignee, $branch->getDefaultAssignee());
        $this->assertEquals($logo, $branch->getLogo());
    }

    public function testThatBranchKeyConvertsToUpperCase()
    {
        $branch = new Branch('dumm', 'DUMMY_NAME', 'DUMMY_DESC');

        $this->assertEquals('DUMM', $branch->getKey());
    }

    /**
     * @test
     */
    public function thatUpdate()
    {
        $defaultAssignee = new User();
        $logo = new Logo('file.dummy');
        $branch = new Branch('DUMM', 'DUMMY_NAME', 'DUMMY_DESC', $defaultAssignee, $logo);

        $newDefaultAssignee = new User();
        $newLogo = new Logo('new_file.dummy');
        $branch->update('New Name', 'New Description', $newDefaultAssignee, $newLogo);

        $this->assertEquals('New Name', $branch->getName());
        $this->assertEquals('New Description', $branch->getDescription());
        $this->assertEquals($newDefaultAssignee, $branch->getDefaultAssignee());
        $this->assertEquals($newLogo, $branch->getLogo());
    }

    /**
     * @test
     */
    public function thatUpdateProperty()
    {
        $branch = new Branch('DUMM', 'DUMMY_NAME', 'DUMMY_DESC');
        $branch->updateProperty('name', self::BRANCH_NAME);
        $this->assertEquals(self::BRANCH_NAME, $branch->getName());
    }

    /**
     * @test
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Branch does not have "invalid_property" property.
     */
    public function thatDoesNotUpdateInvalidProperty()
    {
        $branch = new Branch('DUMM', 'DUMMY_NAME', 'DUMMY_DESC');
        $branch->updateProperty('invalid_property', 'value');
    }
}
