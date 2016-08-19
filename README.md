# Pontoon

Pontoon is a simple and straightforward tool for running deploy scripts from a web service.

![Logo](assets/logo.png)

When it comes to getting my latest changes online, I yearn for something simple. One button click should be all it takes or I
start laughing like a maniac and talking to my cup of coffee.

## Aaahhhhh! F**k!

If that's how you sound at the moment when a client asks you to make a minor, 5-second content change that's gonna end
up taking you half an hour by the time you've found your SSH keys, loaded them into your client, connected and run all
your deployment stuff then do yourself a favour and grab Pontoon.

## Troubleshooting

Here are a few things to bear in mind before flaming the sweet ever-loving heck out of me for producing software that
doesn't work:

* This has been tested on LAMP on Ubuntu 14.04 and nothing else.
* At its core, all this thing really does is execute a script associated with a project when a button is clicked.
* You need to make sure that whatever your script contains, your user has permission to do.
* For the love of heck, make sure you don't forget that your script will execute as www-user on Apache.
