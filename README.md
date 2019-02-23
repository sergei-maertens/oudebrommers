# Oudebrommers.nl infrastructure

This project contains the deployment tooling and infrastructure used to host
https://oudebrommers.nl and related domains.

## Ansible

Ansible is used to automate server/app deployment. It should take care of:

* Setup basic security profile of server
* Manage application user
* Manage volumes to be mounted into containers
* Install Docker runtime
* Manage SSL (letsencrypt)
* Manage nginx virtual hosts
* Manage MySQL database(s)
* Setting up the backups

## Wordpress

We're running wordpress in Docker containers to have an isolated environment
based on PHP 7.x

Requirements:

* Image should contain all the necessary packages to run the plugins used
* Uploaded files should persist (i.e. -> use a volume)
* Plugins should be installable from the UI
* Plugins/code should also persist (volume for plugins?)
* Use database from host

**Plugins needed**

* Cleverwise phpBB statistics
* Contact Form 7
* Wordfence security
* WordPress w3all phpBB integration
* BackUpWordPress
* Contact Form 7 Captcha
* Flamingo
* Google Analytics Dashboard for WP (GADWP)
* Google XML Sitemaps
* Limit Login Attempts Reloaded
* MetaSlider
* NextGEN gallery
* WP Facebook comments


## SSL

Domains need to be protected with SSL, we want to set up certbot to renew
letsencrypt certificates automatically.
