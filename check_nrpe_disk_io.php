<?php
# Dan Fayette - 20150127

# Define 2 Graphs
$opt[1] = "--vertical-label \"R/W Wait Time\" -l0  --title \"IO Wait for $hostname / $servicedesc\" ";
$opt[2] = "--vertical-label \"Service Wait Time\" -l0  --title \"Service Wait for $hostname / $servicedesc\" ";

# Define Variables for Graph #1
$def[1]  = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[2], $DS[2], "AVERAGE");
$def[1] .= rrd::def("var3", $RRDFILE[3], $DS[3], "AVERAGE");

# Define Variables for Graph #2
$def[2] = rrd::def("var4", $RRDFILE[4], $DS[4], "AVERAGE");


# Define Horizontal ruler for Warning and Critical Threasholds
if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";
}

if ($WARN[2] != "") {
    $def[2] .= "HRULE:$WARN[2]#FFFF00 ";
}
if ($CRIT[2] != "") {
    $def[2] .= "HRULE:$CRIT[2]#FF0000 ";
}


# Append Data for Graph #1
$def[1] .= rrd::area("var1", "#EACC00", "Avg IO Wait ") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var2", "#EA8F00", "Avg Read Wait ") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var3", "#00FF00", "Avg Write Wait ") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");


# Append Data for Graph #1
$def[2] .= rrd::area("var4", "#005CFF", "Avg Service Wait ") ;
$def[2] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
?>
