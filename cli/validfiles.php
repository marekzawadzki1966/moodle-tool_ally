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
 * CLI script for getting the valid files list within a time range.
 *
 * @package    tool_ally
 * @author     David Castro
 * @copyright  Copyright (c) 2018 Blackboard Inc. (http://www.blackboard.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

use tool_ally\local_file;

require(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir.'/clilib.php');

list($options, $unrecognized) = cli_get_params(
    [
        'help'    => false,
        'since'   => 0
    ],
    [
        'h' => 'help',
        's' => 'since'
    ]
);

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}


if (!empty($options['help'])) {
    echo "Ally valid files.

Outputs a json array with:
* entity_id
* context_id

For files which are valid for Ally usage.

Options:
-h, --help  Print out this help
-s, --since Start timestamp for file modification filtering

Example:
$ sudo -u www-data /usr/bin/php admin/tool/ally/cli/validfiles.php -s=1000000000 > /tmp/allyvalidfiles.json" . PHP_EOL;

    die;
}

$files = local_file::iterator()->since($options['since'])->sort_by('timemodified');
$files->rewind();

// JSON is written line by line to avoid having to buffer output.
cli_write('[' . PHP_EOL);
while ($files->valid()) {
    $file = $files->current();
    cli_write('  { "entity_id": "' . $file->get_pathnamehash() . '", ');
    cli_write('"context_id": ' . local_file::courseid($file) . ' }');

    $files->next();
    if ($files->valid()) {
        cli_write(', ');
    }
    cli_write(PHP_EOL);
}
cli_write(']' . PHP_EOL);
