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
 * Admin setting for auto configuration.
 * @author    Guy Thomas <gthomas@moodlerooms.com>
 * @copyright Copyright (c) 2017 Blackboard Inc.
 * @package   tool_ally
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ally;

defined('MOODLE_INTERNAL') || die();

/**
 * No setting - just heading and text.
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class admin_setting_ally_config extends \admin_setting_heading {

    /**
     * Returns an HTML string
     * @return string Returns an HTML string
     */
    public function output_html($data, $query='') {
        global $OUTPUT, $CFG;
        $context = (object) ['href' => $CFG->wwwroot.'/admin/tool/ally/autoconfigws.php'];
        return $OUTPUT->render_from_template('tool_ally/setting_ally_config', $context);
    }
}
