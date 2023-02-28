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
 * Block for displaying earned local badges to users
 *
 * @package    block_aspiredu
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */
global $CFG;

//require_once($CFG->dirroot . '/local/aspiredu/lti.php');

class block_aspiredu extends block_base {

    public function init() {
        global $CFG;

        require_once($CFG->dirroot.'/mod/lti/lib.php');
        require_once($CFG->dirroot.'/mod/lti/locallib.php');

        $this->title = get_string('pluginname', 'block_aspiredu');
    }

    public function instance_allow_multiple() {
        return true;
    }

    public function has_config() {
        return false;
    }

    public function instance_allow_config() {
        return true;
    }

    public function applicable_formats() {
        return array(
                'admin' => false,
                'site-index' => true,
                'course-view' => true,
                'mod' => false,
                'my' => true
        );
    }

    public function specialization() {
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname', 'block_aspiredu');
        } else {
            $this->title = $this->config->title;
        }
    }

    /**
     * @throws coding_exception
     * @throws moodle_exception
     * @throws dml_exception
     */
    public function get_content() {
        global $USER, $CFG;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->config)) {
            $this->config = new stdClass();
        }

        // Create empty content.
        $this->content = new stdClass();
        $this->content->text = '';

        $courseid = $this->page->course->id;
        if ($courseid == SITEID) {
            $courseid = null;
        }

        if ($instanceid = get_config('local_aspiredu', 'instance')) {
            $links = [];
            $instructorinsighturl = new moodle_url('/local/aspiredu/aspiredu.php',['id' => $instanceid, 'product' => 'ii']);
            $dropoutdetectiveurl = new moodle_url('/local/aspiredu/aspiredu.php',['id' => $instanceid, 'product' => 'dd']);
            $links[] = html_writer::link($instructorinsighturl, get_string('instructorinsight', 'local_aspiredu'));
            $links[] = html_writer::link($dropoutdetectiveurl, get_string('dropoutdetective', 'local_aspiredu'));
            $this->content->text = html_writer::alist($links, array('class'=>'list'));
        } else {
            $this->content->text .= get_string('nothingtodisplay', 'block_aspiredu');
        }

        return $this->content;
    }

    /**
     * This block shouldn't be added to a page if the badges advanced feature is disabled.
     *
     * @param moodle_page $page
     * @return bool
     */
    public function can_block_be_added(moodle_page $page): bool {
        global $CFG;

        return true;
    }
}
