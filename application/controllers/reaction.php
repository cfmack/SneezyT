<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reaction extends MY_Controller 
{
	public function define() 
	{
		$this->name = 'reaction';
        $this->icon = 'fa-frown-o';
	}
}
?>