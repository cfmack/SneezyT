<?php
/*
Copyright (C) 2013-2014 Charles Mack

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

$toJSON = new stdClass();

$date = new stdClass();
$date->title	= 'Date';
$date->create = false;
$date->edit 	= true;

$date_name = $type . 'Date';
$toJSON->$date_name = $date;

$name = new stdClass();
$name->title	= 'Event';
$name->create = false;
$name->edit 	= false;

$name_name = $type . 'Name';
$toJSON->$name_name = $name;

$amount = new stdClass();
$amount->title	= 'Amount'; // insufficient for reaction
$amount->create 	= false;
$amount->edit 	= true;

$amount_name = $type . 'Amount';
$toJSON->$amount_name = $amount;


$note = new stdClass();
$note->title	= 'Note';
$note->create 	= false;
$note->edit 	= true;

$note_name = $type . 'Note';
$toJSON->$note_name = $note;

$id = new stdClass();
$id->key 	= true;
$id->title	= 'Id';
$id->create = false;
$id->edit 	= false;
$id->visibility = 'hidden';

$id_name = $type . 'Id';
$toJSON->$id_name = $id;

echo json_encode($toJSON);
?>