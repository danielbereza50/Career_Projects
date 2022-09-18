#!/usr/bin/env python
# https://stackoverflow.com/questions/33446347/no-module-named-pymysql/48180232
# pip3 install http://cdn.mysql.com/Downloads/Connector-Python/mysql-connector-python-2.0.4.zip
# https://www.w3schools.com/python/default.asp

# coding: utf-8

# Connect to the database mysql -u root -p

# pip3 install mysql-python or pip3 install mysqlclient
# pip3 install mysql-connector-python

from sys import argv
import mymodule
# import mysql.connector

script, what_he_said = argv, 1

print ("This is what you submitted: %s \n \n Isn't that amazing, man? " % what_he_said)
mymodule.greeting("Jonathan")
