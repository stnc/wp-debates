<?php

$paged = get_query_var('property_id');
if ($paged) {
 echo 'The current page number is: ' . $paged;
} else {
 echo 'Page number not found';
}