
check_iostat.sh

Origin:             Nagios Exchange
Original Source:    http://exchange.nagios.org/directory/Plugins/Operating-Systems/Linux/check_iostat--2D-I-2FO-statistics/details


This script in conjuction with the pnp4nagios templates can graph:
    - CPU Utilization by disk
    - Average Wait times per disk:
        - Total Wait
        - Read Wait
        - Write Wait
    - Average Service Wait per disk


Installation
1. Add command to nrpe.cfg (Must specify Disk (-d) and one mode [-i|-q|-W] -p is required if you want to generate graphs.
    - command[check_sda_io]=/usr/lib64/nagios/plugins/check_iostat -d /dev/sda -W -p

2. Place the check_iostat.sh script in $NAGIOS_PLUGINS_HOME/
    (e.g. /usr/lib64/nagios/plugins/)

3. Place the pnp4nagios templates in $PNP4NAGIOS_HOME/share/templates
    (e.g. /usr/local/pnp4nagios/share/templates)

4. Configure Nagios to use new check-iostat script.
    a. Define a uniqe "command" (This allows the correct pnp4nagios template to be used.

        define command{
            command_name check_nrpe_disk_io
            command_line $USER1$/check_nrpe -H $HOSTADDRESS$ -t 20 -c $ARG1$
        }

        define command{
            command_name check_nrpe_disk_cpu_util
            command_line $USER1$/check_nrpe -H $HOSTADDRESS$ -t 20 -c $ARG1$
        }


    b. Define a service for your host

        define service {
            service_description     Internals - HDD-CPU_Util - SDA
            check_command           check_nrpe_disk_cpu_util!check_sda_io
            use                     generic-service
            hosts                   your_host_name
        }

