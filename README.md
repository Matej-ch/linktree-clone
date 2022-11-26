# Linkify (Simple Linktree clone)

### Created with Symfony 6.0

#### Demo (not ready yet)

## Features


- Landing page
- Signup new users
- Login existing users
- Every user has ability to enable 2factor authentication with Authy or Google
- Application is using [@hotwired/turbo](https://github.com/hotwired/turbo) for SPA feel
- User can create list of links for others to see
    - user links for public are available at `<page_name>/<username>`
    - Links can have background and text color (or gradient) set globally or per link basis
- User can create list of their favourite colors (or gradients) with text for others to see
    - user colors for public are available at `<page_name>/<username>/colors`
    - Colors cycle with user defined interval

## Requirements


- PHP >= 8.0.2
- Symfony >= 6
- Tested on apache server and mysql
- But any server supporting PHP 8 and higher should be fine

## TODO