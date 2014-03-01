<?php 

$filters = get_categories('taxonomy=dslc_projects_cats');

echo '<ul class="filter"><li><a class="active" href="#" data-filter="*">All</a></li>';
	foreach( $filters as $filter ){
		echo '<li><a href="#" data-filter=".'.$filter->slug.'">' . $filter->name . '</a></li>';
	}
echo '</ul>';