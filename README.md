# Real Estate Administration

[![codecov](https://codecov.io/gh/bibou6/greco_administraciones/branch/develop/graph/badge.svg?token=KHRSRWOH84)](https://codecov.io/gh/bibou6/greco_administraciones)
## Description

This website is used to manage buildings and reports of a real estate agency. 

## Administrations
	* Flats
	* Building with Rooms
	* Real Estate Honoraries
	* Contracts
	* Clients
	* Payments 
	* Debts
	* Monthly Reports
	* Mails to Owner
	* Pdf Generation
	* Budgets
	* Cleanings
	* Transfers and banking "virtual" management
	
## Mail: 
	* Send mails
	* View sents mails
	* Add Attachment*
	* Templating
	


## Setting up the website
### Pre-configuration
	* Composer
### Installation
	* First copy this project into your project folder.
	* Then, in a command line shell
		* CD to /your/project/repository
		* CMD : php composer install
		* CMD : php bin/console doctrine:schema:update -f
		* CMD : php bin/console asset:install --symlink
	
