<?php
# Dan Fayette - 20150127


# Define 1 graph
$opt[1] = "--vertical-label \"Disk CPU Utilization\" -l0  --title \"DISK CPU Util for $hostname / $servicedesc\" ";


# Define Variables for Graph #1
$def[1] = rrd::def("var5", $RRDFILE[5], $DS[5], "AVERAGE");

# Define Horizontal ruler for Warning and Critical Threasholds
if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";
}

# Append Data for Graph #1
$def[1] .= rrd::gradient("var5", "00FF00", "FF0000", "Avg CPU Util", 50) ;
$def[1] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
?>
