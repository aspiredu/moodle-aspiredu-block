<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Latest badges block capabilities.
 *
 * @package    block_aspiredu
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */

$capabilities = array(
        'block/aspiredu:addinstance' => array(
                'captype'      => 'read',
                'contextlevel' => CONTEXT_BLOCK,
                'archetypes' => array(
                    'editingteacher' => CAP_ALLOW,
                    'manager' => CAP_ALLOW
                ),
                'clonepermissionsfrom' => 'moodle/site:manageblocks'
        ),
        'block/aspiredu:myaddinstance' => array(
                'riskbitmask'  => RISK_PERSONAL,
                'captype'      => 'read',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes'   => array(
                    'user' => CAP_ALLOW,
                ),
                'clonepermissionsfrom' => 'moodle/my:manageblocks'
        ),
        'block/aspiredu:viewddlink' => array(
                'captype'      => 'read',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes'   => array(
                    'student' => CAP_PROHIBIT,
                    'user' => CAP_PROHIBIT,

                ),
                'clonepermissionsfrom' => 'moodle/my:manageblocks'
        ),
        'block/aspiredu:viewiilink' => array(
                'captype'      => 'read',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes'   => array(
                    'student' => CAP_PROHIBIT,
                    'user' => CAP_PROHIBIT,

                ),
                'clonepermissionsfrom' => 'moodle/my:manageblocks'
        ),
);