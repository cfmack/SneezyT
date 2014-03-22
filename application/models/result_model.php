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


class Result_model extends CI_Model {

    const NO_FILTER = 'no-filter';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();

        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->model('Person_model');
	}

	public function timeline_data($start=false, $end=false)
	{
		$types = array('Reaction', 'Food', 'Treatment', 'Environment');

        $person = $this->Person_model->get_active_person();
        $person_id = $person['person_id'];

		$sql = array();
		foreach ($types as $type)
		{
            $date_where = '';
            if ($start && $end)
            {
                $date_where = " AND ( {$type}Date BETWEEN '" . date('Y-m-d h:m:s', $start) . "' AND '" . date('Y-m-d h:m:s', $end) . "' ) ";
            }

			$first = substr($type, 0, 1);
			$subselect = <<<SQL
select {$type}Id as Id, {$type}Date as Date, {$type}Name as Name, {$type}Note as Note, '{$type}' as Type
from $type as $first
join {$type}Type {$first}t on {$first}.{$type}TypeId = {$first}t.{$type}TypeId
WHERE {$first}.IsDeleted = 0
AND {$first}.PersonId = {$person_id}
{$date_where}
SQL;
			$sql[] = $subselect;
		}

        $query = $this->db->query(implode(' UNION ', $sql));

		return $query->result_array();
	}
	
	function hours_from_reaction($index, $page_size, $num_of_gaps, $scale, $sort, $start_date, $end_date, $reaction_id, $min_eaten, $initial_hour, $food_filter)
	{
        $person = $this->Person_model->get_active_person();
        $person_id = intval($person['person_id']);

        //($index, $page_size, $sort_str)
		$hour_gaps = array();
        $hour = $initial_hour;
		for($i = 1; $i <= $num_of_gaps; $i++)
		{
			if ($scale == 'quadratic')
			{
				$hour_gaps[$i] = pow($hour, 2);
			}
			else if ($scale == 'exponential')
			{
				$hour_gaps[$i] = pow(2, $hour);
			}
			else //if ($scale == 'linear')
			{
				$hour_gaps[$i] = $hour;
			}

            $hour += 1;
		}
		
		// build the subselects
		$subs = array();
		for($i = 0; $i <= $num_of_gaps; $i++)
		{
			// build columns
			$columns = array();
			
			// handle num of food count
			if ($i==0) 
			{
				$columns[] = 'COUNT( 1 ) AS NumOfFood';
			}
			else 
			{
				$columns [] = 'MAX( 0 ) AS NumOfFood';
			}
			
			// handle time based number of reactions
			for($j = 1; $j <= $num_of_gaps; $j++)
			{
				if ($j == $i)
				{
					$columns[] = 'COUNT( 1 ) AS NumOf' . $hour_gaps[$j] . 'Reactions';
				}
				else
				{
					$columns[] = 'MAX( 0 ) AS NumOf' . $hour_gaps[$j] . 'Reactions';
				}
			}
			
			$column_str = implode($columns, " , ");
			
			if ($i == 0)
			{
				$sub  = "SELECT ft.FoodName, {$column_str} ";
				$sub .= " FROM Food AS f JOIN FoodType ft ON ft.FoodTypeId = f.FoodTypeId  ";
				$sub .= " WHERE FoodDate >= '$start_date' ";
				$sub .= " AND FoodDate <= '$end_date' ";
                $sub .= " AND PersonId = $person_id ";
                $sub .= " AND f.IsDeleted = 0 ";
                $sub .= " AND ft.IsDeleted = 0 ";
				$sub .= " GROUP BY ft.FoodName ";
				$subs[] = $sub;
			}
			else 
			{
				$sub  = "SELECT ft.FoodName, {$column_str} ";
				$sub .= " FROM Food AS f JOIN Reaction AS r ON TIMESTAMPDIFF( HOUR , r.ReactionDate, f.FoodDate ) ";
				$sub .= " BETWEEN -" . $hour_gaps[$i] . " AND 0 ";
				$sub .= " JOIN FoodType ft ON ft.FoodTypeId = f.FoodTypeId ";
				$sub .= " WHERE r.ReactionTypeId = $reaction_id ";
				$sub .= " AND FoodDate >= '$start_date' ";
				$sub .= " AND FoodDate <= '$end_date' ";
                $sub .= " AND f.PersonId = $person_id ";
                $sub .= " AND r.PersonId = $person_id ";
                $sub .= " AND f.IsDeleted = 0 ";
                $sub .= " AND r.IsDeleted = 0 ";
                $sub .= " AND ft.IsDeleted = 0 ";
                $sub .= " GROUP BY ft.FoodName ";
				$subs[] = $sub;
			}
		}
		
		// build outer select
		$columns = array();
		$columns[] = 'FoodName';
		$columns[] = "SUM(NumOfFood) AS NumOfFood";
		for($i = 1; $i <= $num_of_gaps; $i++)
		{
			$columns[] = "SUM(NumOf" . $hour_gaps[$i] . "Reactions) as NumOf" . $hour_gaps[$i] . "Reactions";
            $columns[] = "SUM(NumOf" . $hour_gaps[$i] . "Reactions)/SUM(NumOfFood) as PercentOf" . $hour_gaps[$i] . "Reactions";
		}
		
		$select  = "SELECT " . implode($columns, " , ") . " FROM ( ";
		$select .= implode($subs, " UNION ALL ");
		$select .= " ) AS FoodCounts ";

        if ($food_filter != self::NO_FILTER)
        {
            $select .= " WHERE FoodName LIKE '$food_filter' ";
        }

        $select .= " GROUP BY FoodName ";
        $select .= " HAVING SUM(NumOfFood) >= $min_eaten ";

        $sort = explode(' ', $sort);


		
		if (trim($sort[0]) == "FoodName")
		{
			$select .= " ORDER BY " . trim($sort[0]). " " . trim($sort[1]);
		}
        else if (stripos($sort[0], "Percent") !== false)
        {
            $sort[0] = str_replace("Percent","Num", $sort[0]);
            $select .= " ORDER BY SUM(" . trim($sort[0]). ") / SUM(NumOfFood) " . trim($sort[1]); // only works because of the naming convention
        }
		else
		{
			$select .= " ORDER BY SUM(" . trim($sort[0]). ") " . trim($sort[1]); // only works because of the naming convention
		}
		
		$select .= " LIMIT $index, $page_size"; 

		$query = $this->db->query($select);
		
		return $query->result_array();
	}

    /**
     * Query for the total number of records that you are analyzing.  This is used for pagination.
     *
     * @param $start_date
     * @param $end_date
     * @param $food_filter
     * @param $min_eaten
     * @return int
     */
    public function hours_from_reaction_count($start_date, $end_date, $food_filter, $min_eaten)
    {
        $person = $this->Person_model->get_active_person();
        $person_id = intval($person['person_id']);

        $sub  = "SELECT COUNT(FoodId)";
        $sub .= " FROM Food AS f JOIN FoodType ft ON ft.FoodTypeId = f.FoodTypeId  ";
        $sub .= " WHERE FoodDate >= '$start_date' ";
        $sub .= " AND FoodDate <= '$end_date' ";
        $sub .= " AND PersonId = $person_id ";
        $sub .= " AND f.IsDeleted = 0 ";
        $sub .= " AND ft.IsDeleted = 0 ";

        if ($food_filter != self::NO_FILTER)
        {
            $sub .= " AND FoodName LIKE '$food_filter' ";
        }

        $sub .= " GROUP BY FoodName ";
        $sub .= " HAVING COUNT(FoodId) >= $min_eaten ";

        $select = "SELECT COUNT( * ) AS cnt FROM ( ";
        $select .= $sub;
        $select .= ") AS GroupSelect ";

        $query = $this->db->query($select);
        $row = $query->first_row();

        return $row->cnt;
    }
	
}
