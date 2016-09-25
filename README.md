# Pontoon

Pontoon is a simple and straightforward tool for running deploy scripts from a web service.

![Logo](assets/logo.png)

## Installation
Pontoon comes with a set of default credentials.

```
Email: me@example.com
Password: demo
Secret: V8c6pxjBeoCd
```

These *must* be changed before you go into production, so sort these out first:

* Copy `config.yml.template` and rename the copy to `config.yml`.
* Open up `config.yml` in your favorite text editor.
* Change the `admin_email` field to your email address
* Change the `admin_password_hash` field to the SHA-256 hash of a password of
  your choice. Never use online services to create your hashes, but hashes
  created using [this service](http://www.xorbin.com/tools/sha256-hash-calculator)
  will work.
* It's vital that you also change the `secret_key` field to a randomly-generated
  string at least 12 characters long.
* Change `root_path` to the path of the directory containing all your websites.

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
