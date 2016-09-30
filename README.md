# Pontoon

Pontoon is a simple and straightforward tool for running deploy scripts from a web service.

![Logo](assets/logo.png)

## Prerequisites
You'll need to have a web server installed and configured with PHP for this to work. I really recommend [XAMPP](https://www.apachefriends.org/), especially for Windows users. Once you've done that you can proceed.

You'll also need [Node.js](https://nodejs.org/en/) and [npm](https://www.npmjs.com/) installed and working.

## Building
Clone the project down and open the folder in your favourite editor. It's a JetBrains PhpStorm project but you can use whichever paid/free software takes your fancy.

Before anything else, note that this project uses the [Composer](https://getcomposer.org/) package manager. Install composer (see their website) and run:

```
composer install
```

Or alternatively, if you're using the PHAR (make sure the `php.exe` executable is in your PATH):

```
php composer.phar install
```

Then, install the npm packages necessary to build and run the website. Run the following in your terminal in the project root directory:

```
npm install
```

This will install [Bower](https://bower.io/) which will allow you to install the assets the website requires (Bootstrap, jQuery etc.) using the command:

```
bower install
```

Gulp will also have been installed. This will compile the [Less](http://lesscss.org/) into CSS ready for production. Do this using the command:

```
gulp
```

This command will need running again every time you make a change to a Less file. If you're working on them, run `gulp watch` in a terminal to watch for file changes and compile accordingly.

## Installation
Pontoon comes with a set of default credentials in `security.yml.dist`:

```
Email: me@example.com
Password: demo
```

These *must* be changed before you go into production, so sort these out first:

* Copy `security.yml.dist` and rename the copy to `security.yml`
* Follow the installation guide for [Minim](https://github.com/lambdacasserole/minim) which Pontoon uses as its authentication system.

After you've done that, set up the Pontoon configuration file:

* Copy `config.yml.dist` and rename the copy to `config.yml`.
* Open up `config.yml` in your favorite text editor.
* Change `root_path` to the path of the directory containing all your websites.
* Change `api_key` to a random string at least 12 characters long and keep it secret.

Next, you should make sure your `www-data` user can run `git` and has an SSH key configured on your server and GitHub account. An excellent tutorial for this can be found [here](http://technotes.tumblr.com/post/33867325150/php-hook-script-that-can-git-pull).

## Configuring Your Websites
Note that all your website directories must be under one single root directory, and each must contain a `pontoon.yml` file at its root level to be deployable. A `pontoon.yml` file has the following structure:

```yaml
project_name: My Website
description: My first website deployed with Pontoon!
deploy_enabled: true
deploy_script: deploy.sh
scripting_exe: bash
```

The Pontoon web application will list directories containing files like this as deployable applications, allowing you to deploy them using your Pontoon installation.

For example, you might put the following into your deploy.sh file:

```bash
cd /var/www/html
echo git pull
```

Now, when you click 'deploy' on the Pontoon web interface, a command will be executed of the form:

```
<scripting_exe> <deploy_script>
```

Which in this instance, looks like:

```
bash deploy.sh
```

So a `git pull` will be executed on your web directory, deploying the site from your Git repository to your live server.

## Automatic Deployments
To deploy automatically from a Git repository, configure your repository management system to send a request to the following URL on push:

```
https://your-pontoon-installation.com/go.php?project=project_id&key=api_key
```

Where `api_key` is the key specified in your `config.yml` file and `project_id` is the deploy ID you can find by logging in to the web app.

## Limitations

This system is designed to be quite dumb and extremely simple. It won't replace any of your CI tools.
