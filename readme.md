# php-node-bootstrap

PHP Node.js Bootstrap is an experiment released pre-maturely. The result is an easily deployable (drag and drop) JavaScript application by use of PHP. Essentially, we can leverage PHP process and socket functions to spawn a Node.js process that runs your main script. First, we check if your Node.js daemon is running, and if it is not, then spawn one. Then, we send the request to your Node.j script, and feed the content back through PHP. This has obvious downsides, primarily that you've increased your request overhead dramatically by use of an additional service, and PHP to boot (pun intended).

## Disclaimer

I'm not entirely sure this will work on all environments. I know for certain it won't work on most shared hosting providers due to security and therefore limited function availability. I've included binaries for Linux, Windows, and Mac OS X. However, there is no working NPM implementation. I'm not sure I'd use this, and haven't warranted any time towards that.

I'm releasing it because I have no use for it and it may save someone who had a similar idea some time :D