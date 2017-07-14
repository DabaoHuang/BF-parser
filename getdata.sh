#!/bin/bash
num=0
until [ "$num" -eq 1 ]
do
./php_getdata.php
case $? in
	0)
	sleep 1	
	;;
	2)
	;;
	*)
	break
	;;
esac
done
