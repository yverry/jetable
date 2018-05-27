<?php

$stats = new Stats();
$sql = new Sql();

$sql_table = 'jetable_dailystats';
$query = "SELECT forwarded,rejected FROM $sql_table WHERE date = CURDATE()";
$result = $sql->fetch($query);



$o_stats = '
<div id="content">
<h1>'._("Stats").'</h1>

  <div id="about">
  <p>'._("Statistics").'

    <ul>
        <li>'.sprintf(_("We have %d active aliases!"),$stats->active_alias()).'</li>
	<li>'.sprintf(_("Today %d aliases were created"),$stats->daily_alias()).'</li>
	<li>'.sprintf(_("Today %d aliases were forwarded"),$result['forwarded']).'</li>
	<li>'.sprintf(_("Today we rejected %d emails !!"),$result['rejected']).'</li>
    </ul>
    <p>
    </p>
  </div>
</div>
';

$output->add($o_stats);

// Now build chart
/*

$o_stats = '<table >
	<caption>Stats</caption>
	<thead>
		<tr>
			<td></td>
			<th scope="col">20</th>
			<th scope="col">21</th>
			<th scope="col">22</th>
			<th scope="col">23</th>
			<th scope="col">24</th>
			<th scope="col">25</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Active alias</th>
			<td>190</td>
			<td>160</td>
			<td>40</td>
			<td>120</td>
			<td>30</td>
			<td>70</td>
		</tr>
		<tr>
			<th scope="row">New alias</th>
			<td>3</td>
			<td>40</td>
			<td>30</td>
			<td>45</td>
			<td>35</td>
			<td>49</td>
		</tr>
		<tr>
			<th scope="row">Forwarded</th>
			<td>10</td>
			<td>180</td>
			<td>10</td>
			<td>85</td>
			<td>25</td>
			<td>79</td>
		</tr>
		<tr>
			<th scope="row">Rejected</th>
			<td>40</td>
			<td>80</td>
			<td>90</td>
			<td>25</td>
			<td>15</td>
			<td>119</td>
		</tr>		
	</tbody>
</table>';


$output->add($o_stats);
*/

?>
