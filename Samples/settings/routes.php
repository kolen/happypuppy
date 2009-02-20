<?php

// add custom routes here
// Remember, /:controller/:action/:argument1/:argument2/.../:argumentn is implicit, so you don't need to define it

// Home page
R('','doc','index','GET');

R('(?P<year>[-\w]+)/(?P<month>[-\w]+)/(?P<day>[-\w]+)/blog/(?P<title>[-\w]+)', 'test', 'blog', 'GET');

?>
