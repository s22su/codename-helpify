<?php

// all our helpific related conf vars go here

function pre($a) {
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}