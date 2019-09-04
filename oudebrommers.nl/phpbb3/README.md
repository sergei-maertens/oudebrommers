# phpBB 3.0 Docker image for Oudebrommers.nl

## Caveats

* volume (writable) for `cache/`
* volume (writable) for `files/` (transfer backup)
* volume (writable) for `images/` (transfer backup)
* `config.php` must pull config from ENV
