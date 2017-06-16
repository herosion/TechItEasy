#!/bin/bash

#$ sh deploy.sh // commande à écrire pour cmder script bash
#Permet de supprimer tout et de tout réainstaller: utile en cas d'erreur sql que l'on ne trouve
#pas
mysql --user root --password= < ./install.sql

php artisan migrate